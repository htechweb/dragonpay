<!DOCTYPE html>
<html>
<head>
    <title>Dragonpay Sample</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('dragonpay/css/style.css')}}">

</head>
<body>
    <h1 class="text-center">HTECH - DRAGPONPAY </h1>
    
	@if(session()->has('msg'))
		<div class="row clearfix">
			<div class="col-lg-12">
				<div class="alert alert-{{Session::get('msgClass')}} alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				    <strong>{{Session::get('msg')}}</strong>
				</div>
			</div>
		</div>
	@endif
    <div class="container">
    	<div class="card ">
    		<div class="card-header">
		    	Recent Transactions
		 	</div>
			 <div class="card-body">
			 	<div class="row">
			 		<div class="col">
					  	<table class="table w-100">
					  		<thead>
						  		<tr>
						  			<th>Transaction Id</th>
						  			<th class="text-center">Customer</th>
						  			<th class="text-right">Amount</th>
						  			<th class="text-center">Date Created</th>
						  			<th class="text-center">Functions</th>
						  		</tr>
						  	</thead>
						  	<tbody>
						  		@forelse($recentTransactions as $transaction)
						  		<tr>
						  			<td class="text-center">{{$transaction->transaction_id ?? ''}}</td>
						  			<td class="text-center">{{$transaction->email ?? ''}}</td>
						  			<td class="text-right">{{$transaction->amount !== null ? number_format($transaction->amount,2) : ''}}</td>
						  			<td class="text-center">{{$transaction->created_at ?? ''}}</td>
						  			<td class="text-right">
						  				<a class="text-success" href="{{url('dragonpay/example/get-transaction-status/' . $transaction->transaction_id)}}" title="dragonpay transaction status">status</a>
						  				<a class="text-danger" href="{{url('dragonpay/example/cancel-transaction/' . $transaction->transaction_id)}}"  title="cancel dragonpay transaction">cancel</a>
						  				<a class="text-info" href="{{url('dragonpay/example/get-dp-refno/' . $transaction->transaction_id)}}" title="get reference no from dragonpay">ref_no</a>
						  			</td>
						  		</tr>
						  		@empty
						  		<tr>
						  			<td colspan="4">No recent transactions</td>
						  		</tr>
						  		@endforelse
						  	</tbody>
					  	</table>
				  	</div>

			  	</div>
			 </div>
			<div class="card-footer">
				<div class="row">
		    		<div class="col text-right">
		    		   	<a href="{{url('dragonpay/example')}}" class="btn btn-primary">Back</a>		    	
		    		</div>
	    		</div>
 			</div>
    	</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

				