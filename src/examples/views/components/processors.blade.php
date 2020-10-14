@php
	$DPProcessor = new \Htech\Dragonpay\DP_Processors;
	$processors = $DPProcessor->getMerchantProcessors(); //get eavailable payment processors. E-Wallets are nnot included i dont know why
	$modeValues = $DPProcessor->getModeValues(); // used to parse payment method types

	$procByMode = [];
	foreach ($processors as $processor) {
		$procByMode[$modeValues[$processor->type]][] = $processor;
	}
@endphp
@forelse($procByMode as $mode => $processors)
	<h4>{{$mode}}</h4>
	@forelse($processors as $processor)
		<label>
		  <input type="radio" class="processors" name="procId" value="{{$processor->procId}}" required>
		  <img class="img-thumbnail" src="{{$processor->logo}}" alt="{{$processor->shortName}}" title="{{$processor->longName}}">
		</label>
	@empty
	@endforelse
	<hr />
@empty
<h5>No Processors available</h5>
@endforelse

