<?php 
namespace Htech\Dragonpay;

use SoapClient;
use GuzzleHttp\Client;
use Htech\Dragonpay\DP_Constants;


class DP_Services extends DP_Constants
{
    public $baseURL;
    public $client;

    protected $merchantId;
    protected $password;


    public function __construct(array $merchantCredentials = [])
    {
        $this->baseURL = config(static::CONFIG_ENV) === static::PRODUCTION ?  static::DP_PRODUCTION_URL:  static::DP_TEST_URL;
        $this->webSerivceURL = $this->baseURL . static::DP_WEB_SERVICE;
        $this->merchantId = $merchantCredentials[static::MERCHANT_ID] ?? config(static::CONFIG_MERCHANT_ID);
        $this->password = $merchantCredentials[static::PASSWORD] ?? config(static::CONFIG_PASSWORD);
    }

    public function setClient($clientURL){
        $opts = [
            'trace' => config(static::CONFIG_ENV) === static::PRODUCTION ? 0 : 1
        ];

        $this->client = new SoapClient($clientURL.'?wsdl',$opts);
    }

    public function curlClient($url = null){
        return new Client(['base_uri' => $url ?? $this->baseURL]);
    }

    public function getTransactionStatus($transaction_id){
        return static::STATUS[$this->operationRequest($transaction_id,static::GET_TRANSACTION_STATUS)];
    }

    public function cancelTransaction($transaction_id){
        return $this->operationRequest($transaction_id,static::CANCEL_TRANSACTION) == 0 ? static::CANCELLATION_STATUS_SUCCESS : static::CANCELLATION_STATUS_FAILED;
    }

    private function operationRequest($transaction_id,$op){
        if($transaction_id === null) throw new \Exception("Missing transaction id");
        
        $client = $this->curlClient();
        $response = $client->request('GET',static::DP_MERCHANT_REQUEST,[
            'query' => [
                static::CURL_SERVICE_PARAM_OPERATION    => $op,
                static::CURL_SERVICE_PARAM_MERCHANT_ID  => $this->merchantId,
                static::CURL_SERVICE_PARAM_PASSWORD     => $this->password,
                static::CURL_SERVICE_PARAM_TXNID        => $transaction_id
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            return $response->getBody()->getContents();
        }
        
        throw new \Exception($response->getReasonPhrase());
    }

    public function getDPReferenceNo($transaction_id){
        if($transaction_id === null) throw new \Exception("Missing transaction id");

        $data = [
            static::SOAP_SERVICE_PARAM_MERCHANT_ID  => $this->merchantId,
            static::SOAP_SERVICE_PARAM_PASSWORD     => $this->password,
            static::SOAP_SERVICE_PARAM_TXNID        => $transaction_id
        ];

        $clientURL =  $this->webSerivceURL . static::DP_MERCHANT_SERVICE;
        
        $this->setClient($clientURL);
        $referenceNo = $this->client->__soapCall(static::GET_REFERENCE_NO, ["parameters" => $data]);
        
        if($referenceNo->GetTxnRefNoResult){
            return $referenceNo->GetTxnRefNoResult;
        }

        return null;
        
    }
}
