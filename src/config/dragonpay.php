<?php

return [
	'env' => env('DP_ENV','sandbox'),
	'merchant_id' => env('DP_MERCHANT_ID',null),
	'password' => env('DP_PASSWORD',null),
	'currency' => env('DP_CURRENCY','PHP'),
	'show_all_processors' => env('DP_ALL_PROCESSORS',true),
];