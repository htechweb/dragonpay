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
    		<div class="card-header text-center">
		    	Transaction Complete
		 	</div>
			 <div class="card-body">
			 	<div class="row">
			 		<div class="col">
					  	<table class="table w-100">
					  		<thead>
						  		<tr>
						  			<th>Name</th>
						  			<th class="text-center">Value</th>
						  			<th class="text-right">Description</th>
						  		</tr>
						  	</thead>
						  	<tbody>
						  		<tr>
						  			<td>Transaction Id</td>
						  			<td class="text-center">{{$resData['txnid'] ?? ''}}</td>
						  			<td class="text-right">Merchant's transaction id</td>
						  		</tr>
						  		<tr>
						  			<td>Dragonpay Ref. no.</td>
						  			<td class="text-center">{{$resData['refno'] ?? ''}}</td>
						  			<td class="text-right">Dragonpay's reference no</td>
						  		</tr>
						  		<tr>
						  			<td>Status</td>
						  			<td class="text-center">{{$resData['status'] ?? ''}}</td>
						  			<td class="text-right">Dragonpay's status of transaction</td>
						  		</tr>
						  		<tr>
						  			<td>Message</td>
						  			<td class="text-center">{{$resData['message'] ?? ''}}</td>
						  			<td class="text-right">Dragonpay's message</td>
						  		</tr>
						  		<tr>
						  			<td>Digest</td>
						  			<td class="text-center">{{$resData['digest'] ?? ''}}</td>
						  			<td class="text-right">Use to validate the transaction if not tampered</td>
						  		</tr>
						  		<tr>
						  			<td>Amount</td>
						  			<td class="text-center">₱{{number_format($transaction->amount,2) ?? ''}}</td>
						  			<td class="text-right"></td>
						  		</tr>
						  		<tr>
						  			<td>Customer</td>
						  			<td class="text-center">{{$transaction->email ?? ''}}</td>
						  			<td class="text-right"></td>
						  		</tr>
						  		<tr>
						  			<td>Details</td>
						  			<td class="text-center">Credit : ₱{{number_format($transaction->amount,2) ?? ''}}</td>
						  			<td class="text-right"></td>
						  		</tr>
						  	</tbody>
					  	</table>
				  	</div>
			  	</div>
			 </div>
			<div class="card-footer">
			<div class="row">
	    		<div class="col text-right">
	    		   	<a href="{{url('dragonpay/example')}}" class="btn btn-success">Ok</a>		    	
	    		</div>
 			</div>
    	</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

				