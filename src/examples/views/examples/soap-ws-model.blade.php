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
    <form class="container" id="sample1-form" method="POST" action="{{url('dragonpay/example/ws-payment')}}">
    	@csrf
        
    	<div class="card ">
    		<div class="card-header">
		    	Step 1. Checkout.
		    	<br />
		    	<small>Note: After this you need to generate a transaction identifier</small>
		 	</div>
			 <div class="card-body">
			  	@include('htech.dragonpay.components.example-product')
			 </div>
			<div class="card-footer">
				<div class="row">
		    		<div class="col text-left">
		    		   	<a href="{{url('dragonpay/example')}}">Back</a>
		    		</div>
		    		<div class="col text-right">
		    		   	<button type="submit" class="btn btn-success">Payment</button>		    	
		    		</div>
	 			</div>
    	</div>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

				