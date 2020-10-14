<?php 
namespace Htech\Dragonpay;

use Htech\Dragonpay\DP_Services;

class DP_Payment extends DP_Services
{   
    protected $parameters = [];

    private function validateParameters($parameters){
        if (
            (! array_key_exists(static::REQUEST_PARAM_TXNID, $parameters) && ! array_key_exists(static::REQUEST_TOKEN_PARAM_MERCHANT_TXNID, $parameters))
            || (! array_key_exists(static::REQUEST_PARAM_AMOUNT, $parameters) && ! array_key_exists(static::REQUEST_TOKEN_PARAM_AMOUNT, $parameters))
            || (! array_key_exists(static::REQUEST_PARAM_EMAIL, $parameters) && ! array_key_exists(static::REQUEST_TOKEN_PARAM_EMAIL, $parameters) ) 
        ) {
                throw new \Exception('Invalid Parameter/s. Check the parameters then try again.');
        }
    }

    private function getSHA1Digest($params){
        $params[static::REQUEST_PARAM_PASSWORD] = $this->password;
        return sha1(implode(':', $params));
    }

    public function setPaymentDetails(array $parameters){
        $this->parameters = array_merge($this->parameters,array_filter($parameters));

        $this->validateParameters($this->parameters);
        $_parameters[static::REQUEST_PARAM_MERCHANT_ID] = $this->merchantId;
        $_parameters[static::REQUEST_PARAM_TXNID] = $parameters[static::REQUEST_PARAM_TXNID];
        $_parameters[static::REQUEST_PARAM_AMOUNT] = number_format($parameters[static::REQUEST_PARAM_AMOUNT], 2, '.', '');
        $_parameters[static::REQUEST_PARAM_CCY] = $parameters[static::REQUEST_PARAM_CCY] ?? config(static::CONFIG_CURRENCY);
        $_parameters[static::REQUEST_PARAM_DESCRIPTION] = $parameters[static::REQUEST_PARAM_DESCRIPTION] ?? $parameters[static::REQUEST_PARAM_TXNID];
        $_parameters[static::REQUEST_PARAM_EMAIL] = $parameters[static::REQUEST_PARAM_EMAIL];
        
        $_parameters[static::REQUEST_PARAM_DIGEST] = $this->getSHA1Digest($_parameters);

        $_parameters[static::REQUEST_PARAM_PARAM1] = isset($parameters[static::REQUEST_PARAM_PARAM1]) ? $parameters[static::REQUEST_PARAM_PARAM1] : '';
        $_parameters[static::REQUEST_PARAM_PARAM2] = isset($parameters[static::REQUEST_PARAM_PARAM2]) ? $parameters[static::REQUEST_PARAM_PARAM2] : '';
        if(isset($parameters[static::PAYMENT_MODE]))$_parameters[static::PAYMENT_MODE] = $parameters[static::PAYMENT_MODE];
        if(isset($parameters[static::PROCESSOR])) $_parameters[static::PROCESSOR] = $parameters[static::PROCESSOR];

        $this->parameters = array_filter( $_parameters );
        // dd($this->parameters);
        $this->query = $this->buildQuery($this->parameters);
        $this->paymentSwitchURL = $this->baseURL . static::DP_PAYMENT_SWITCH . "?$this->query";
        return $this;
    }

    public function setRequestTokenDetails(array $parameters){
        $this->parameters = array_merge($this->parameters,array_filter($parameters));

        $this->validateParameters($parameters);

        $_parameters[static::REQUEST_TOKEN_PARAM_MERCHANT_ID] =  $this->merchantId;
        $_parameters[static::REQUEST_TOKEN_PARAM_PASSWORD] = $this->password;
        $_parameters[static::REQUEST_TOKEN_PARAM_MERCHANT_TXNID] = $parameters[static::REQUEST_TOKEN_PARAM_MERCHANT_TXNID];
        $_parameters[static::REQUEST_TOKEN_PARAM_AMOUNT] = number_format($parameters[static::REQUEST_TOKEN_PARAM_AMOUNT], 2, '.', '');
        $_parameters[static::REQUEST_TOKEN_PARAM_CCY] = $parameters[static::REQUEST_TOKEN_PARAM_CCY] ?? config(static::CONFIG_CURRENCY);
        $_parameters[static::REQUEST_TOKEN_PARAM_DESCRIPTION] = $parameters[static::REQUEST_TOKEN_PARAM_DESCRIPTION];
        $_parameters[static::REQUEST_TOKEN_PARAM_EMAIL] = $parameters[static::REQUEST_TOKEN_PARAM_EMAIL];
        $_parameters[static::REQUEST_TOKEN_PARAM_PARAM1] = isset($parameters[static::REQUEST_TOKEN_PARAM_PARAM1]) ? $parameters[static::REQUEST_TOKEN_PARAM_PARAM1] : '';
        $_parameters[static::REQUEST_TOKEN_PARAM_PARAM2] = isset($parameters[static::REQUEST_TOKEN_PARAM_PARAM2]) ? $parameters[static::REQUEST_TOKEN_PARAM_PARAM2] : '';


        if(isset($parameters[static::PAYMENT_MODE]))$_parameters[static::PAYMENT_MODE] = $parameters[static::PAYMENT_MODE];
        if(isset($parameters[static::PROCESSOR])) $_parameters[static::PROCESSOR] = $parameters[static::PROCESSOR];
        
        $this->parameters = array_filter( $_parameters );
        
        $clientURL =  $this->webSerivceURL . static::DP_MERCHANT_SERVICE;
        $this->setClient($clientURL);
        
        
        // $getTransactionToken = $this->client->GetTxnToken($this->paymentRequest);
        $getTransactionToken = $this->client->__soapCall(static::GET_TRANSACTION_TOKEN, ["parameters" => $this->parameters]);
        
        $this->token = $getTransactionToken->GetTxnTokenResult ?? null;
        
        $this->paymentSwitchURL =  $this->baseURL . static::DP_PAYMENT_SWITCH . "?".static::GET_TOKEN_QUERY_PARAM."=".$this->token;
        // dd($this->token,$clientURL,$this->paymentRequest,$this->paymentSwitchURL);

        return $this;
    }

    public function getToken(){
        return $this->token;
    }

    public function getPaymentRequest(){
        return $this->paymentRequest;
    }

    public function getPaymentSwitchURL(){
        return $this->paymentSwitchURL;
    }

    public function getGeneratedQuery(){
        return $this->query;
    }

    public function buildQuery($params){
        return http_build_query($params, '', '&');
    }

    public function redirect(){
        return redirect()->to($this->paymentSwitchURL);
    }
}
