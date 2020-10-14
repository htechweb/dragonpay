<?php

Route::namespace('App\Http\Controllers')->group(function(){

	Route::view('dragonpay/example', 'htech.dragonpay.examples.table-of-contents');
	Route::view('dragonpay/example/payment-switch', 'htech.dragonpay.examples.dp-payment-switch');
	Route::view('dragonpay/example/all-payment-processors', 'htech.dragonpay.examples.all-payment-processors');
	Route::view('dragonpay/example/soap-ws-model', 'htech.dragonpay.examples.soap-ws-model');
	Route::view('dragonpay/example/filtered-payment-channels', 'htech.dragonpay.examples.filtered-payment-channels');
	Route::get('dragonpay/example/additional-support-functions', 'DragonpayController@additionalSupportFunctions');
	Route::get('dragonpay/example/get-transaction-status/{transaction_id}', 'DragonpayController@getTransactionStatus');
	Route::get('dragonpay/example/cancel-transaction/{transaction_id}', 'DragonpayController@cancelTransaction');
	Route::get('dragonpay/example/get-dp-refno/{transaction_id}', 'DragonpayController@getDPReferenceNo');

	//Payment
	Route::any('dragonpay/example/payment/{transaction_no?}', 'DragonpayController@processPayment');
	Route::any('dragonpay/example/ws-payment/{transaction_no?}', 'DragonpayController@paymentUsingWSModel');


	//Post backs
	Route::any('dragonpay/example/postback', 'DragonpayController@handlePostback');
	Route::get('dragonpay/example/return-url', 'DragonpayController@handleReturnURL');
});