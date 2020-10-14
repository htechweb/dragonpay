<?php 
namespace Htech\Dragonpay;

use Htech\Dragonpay\DP_Services;

class DP_Processors extends DP_Services
{   
    public function getAvailableProcessors($amount = null){
        $clientURL =  $this->webSerivceURL . static::DP_MERCHANT_SERVICE;
        $this->setClient($clientURL);

        $data = [
            'merchantId' => $this->merchantId,
            'password' => $this->password,
            'amount' => $amount ?? static::SHOW_ALL_AVAILABLE_PROCESSORS,
        ];
        
        $getAvailableProcessors = $this->client->__soapCall(static::AVAILABLE_PROCESSORS, ["parameters" => $data]);
        if($getAvailableProcessors->GetAvailableProcessorsResult->ProcessorInfo){
            return $getAvailableProcessors->GetAvailableProcessorsResult->ProcessorInfo;
        }

        return [];
    }

    public function getMerchantProcessors(){
        $processors = $this->getAvailableProcessors();
        if(config('dragonpay.show_all_processors') == false){
            // TODO 
            // 1. create table for processors management
            // 2. Show only processors that is allowed
            dd($processors);
        }
        return $processors;
    }

    public function getModeValues(array $channels = []){
        if(empty($channels)) return static::DP_MODE_VALUES;

        return array_intersect_key(static::DP_MODE_VALUES,array_flip($channels));
    }
}
