<?php 
namespace Htech\Dragonpay;

class DP_Constants
{
    //TERMS
    protected const MERCHANT_ID                   = 'merchant_id';
    protected const PASSWORD                      = 'password';
    protected const PRODUCTION                    = 'production';
    protected const SANDBOX                       = 'sandbox';

    //CONFIG
    protected const CONFIG_ENV                    = 'dragonpay.env';    
    protected const CONFIG_MERCHANT_ID            = 'dragonpay.' . self::MERCHANT_ID;
    protected const CONFIG_PASSWORD               = 'dragonpay.' . self::PASSWORD;    
    protected const CONFIG_CURRENCY               = 'dragonpay.currency';    
    //BASE URLS
    protected const DP_PRODUCTION_URL             = "https://gw.dragonpay.ph/";
    protected const DP_TEST_URL                   = "https://test.dragonpay.ph/";
    //SERVICE ROUTES
    protected const DP_WEB_SERVICE                = 'DragonPayWebService/';

    //ENDPOINTS
    protected const DP_MERCHANT_SERVICE           = 'MerchantService.asmx';
    protected const DP_PAYMENT_SWITCH             = 'Pay.aspx';
    protected const DP_MERCHANT_REQUEST           = 'MerchantRequest.aspx';
    
    //WSDL METHODS
    protected const AVAILABLE_PROCESSORS          = "GetAvailableProcessors";
    protected const GET_TRANSACTION_TOKEN         = "GetTxnToken";
    

    //ADDTIONAL SUPORT FUNCTIONS OP 
    protected const GET_TRANSACTION_STATUS        = "GETSTATUS";
    protected const CANCEL_TRANSACTION            = "VOID";
    //ADDTIONAL SUPORT WSDL METHODS
    protected const GET_REFERENCE_NO              = "GetTxnRefNo";


    protected const SHOW_ALL_AVAILABLE_PROCESSORS = "-1000";

    //Cancellation Status
    protected const CANCELLATION_STATUS_SUCCESS   = 'SUCCESS';
    protected const CANCELLATION_STATUS_FAILED    = 'FAILED';
      
    //MODE VALUES
    const DP_MODE_VALUES = [
        1       => 'Online Banking',
        2       => 'Over-the-Counter Banking and ATM',
        4       => 'Over-the-Counter non-Bank',
        8       => 'E-Wallets (inc. Bitcoins)',
        16      => '(reserved internally)',
        32      => 'PayPal',
        64      => 'Credit Cards',
        128     => 'Mobile (Gcash)',
        256     => 'International OTC',
        512     => 'Bancnet',
        1024    => 'Auto Debit Arrangement (ADA)',
        2048    => 'Cash on Delivery (COD)',
    ];

    // Payment Request Params
    const REQUEST_PARAM_MERCHANT_ID = 'merchantid';
    const REQUEST_PARAM_TXNID       = 'txnid';
    const REQUEST_PARAM_AMOUNT      = 'amount';
    const REQUEST_PARAM_CCY         = 'ccy';
    const REQUEST_PARAM_DESCRIPTION = 'description';
    const REQUEST_PARAM_EMAIL       = 'email';
    const REQUEST_PARAM_PASSWORD    = 'password';
    const REQUEST_PARAM_DIGEST      = 'digest';
    const REQUEST_PARAM_PARAM1      = 'param1';
    const REQUEST_PARAM_PARAM2      = 'param2';
    const PAYMENT_MODE              = 'mode';
    const PROCESSOR                 = 'procid';

    // Token Request Params
    const REQUEST_TOKEN_PARAM_MERCHANT_ID       = 'merchantId';
    const REQUEST_TOKEN_PARAM_PASSWORD          = 'password';
    const REQUEST_TOKEN_PARAM_MERCHANT_TXNID    = 'merchantTxnId';
    const REQUEST_TOKEN_PARAM_AMOUNT            = 'amount';
    const REQUEST_TOKEN_PARAM_CCY               = 'ccy';
    const REQUEST_TOKEN_PARAM_DESCRIPTION       = 'description';
    const REQUEST_TOKEN_PARAM_EMAIL             = 'email';
    const REQUEST_TOKEN_PARAM_PARAM1            = 'param1';
    const REQUEST_TOKEN_PARAM_PARAM2            = 'param2';
    const REQUEST_TOKEN_PARAM_PAYMENT_MODE      = 'mode';
    const REQUEST_TOKEN_PARAM_PROCESSOR         = 'procid';

    const GET_TOKEN_QUERY_PARAM                 = 'tokenid';

    //Transaction statuses
    const SUCCESS       = 'S';
    const FAILED        = 'F';
    const PENDING       = 'P';
    const UKNOWN        = 'U';
    const REFUND        = 'R';
    const CHARGEBACK    = 'K';
    const VOID          = 'V';
    const AUTHORIZED    = 'A';

    const STATUS = [
        self::SUCCESS       => 'Success',
        self::FAILED        => 'Failure',
        self::PENDING       => 'Pending',
        self::UKNOWN        => 'Unknown',
        self::REFUND        => 'Refund',
        self::CHARGEBACK    => 'Chargeback',
        self::VOID          => 'Void',
        self::AUTHORIZED    => 'Authorized',
    ]; 

    const GCASH                         = 'GCSH';
    const CREDIT_CARD                   = 'CC';
    const PAYPAL                        = 'PYPL';
    const BAYADCENTER                   = 'BAYD';
    const BITCOIN                       = 'BITC';
    const CEBUANA_LHUILLIER             = 'CEBL';
    const CHINA_UNIONPAY                = 'CUP';
    const DRAGONPAY_PREPARED_CREDITS    = 'DPAY';
    const ECPAY                         = 'ECPY';
    const LBC                           = 'LBC';
    const MLHUILLIER                    = 'MLH';
    const ROBINSONS_DEPT_STORE          = 'RDS';
    const SM_PAYMENT_COUNTERS           = 'SMR';

    const PROC_LIST = [
        self::GCASH                         => 'Globe Gcash',
        self::CREDIT_CARD                   => 'Credit Cards',
        self::PAYPAL                        => 'PayPal',
        self::BAYADCENTER                   => 'Bayad Center',
        self::BITCOIN                       => 'Bitcoins',
        self::CEBUANA_LHUILLIER             => 'Cebuana Lhuillier',
        self::CHINA_UNIONPAY                => 'China UnionPay',
        self::DRAGONPAY_PREPARED_CREDITS    => 'Dragonpay Prepaid Credits',
        self::ECPAY                         => 'ECPay',
        self::LBC                           => 'LBC',
        self::MLHUILLIER                    => 'M. Lhuillier',
        self::ROBINSONS_DEPT_STORE          => 'Robinsons Dept Store',
        self::SM_PAYMENT_COUNTERS           => 'SM Payment Counters',
    ];

    const CURL_SERVICE_PARAM_MERCHANT_ID       = 'merchantid';
    const CURL_SERVICE_PARAM_PASSWORD          = 'merchantpwd';
    const CURL_SERVICE_PARAM_OPERATION         = 'op';
    const CURL_SERVICE_PARAM_TXNID             = 'txnid';

    const SOAP_SERVICE_PARAM_MERCHANT_ID       = 'merchantId';
    const SOAP_SERVICE_PARAM_PASSWORD          = 'merchantPwd';
    const SOAP_SERVICE_PARAM_TXNID             = 'txnId';
}
