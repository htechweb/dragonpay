<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Htech\Dragonpay\DP_Payment;
use Htech\Dragonpay\DP_Services;
use Htech\Dragonpay\DP_Constants;


class DragonpayController extends Controller
{
    public function processPayment(Request $request,$transaction_no = null){
    	try{
    		$genTrans = $this->createTransaction($request,$transaction_no);

    		$dpPaymentData = [
    			DP_Constants::REQUEST_PARAM_TXNID => $genTrans->transaction_id,
    			DP_Constants::REQUEST_PARAM_DESCRIPTION => $genTrans->transaction_id,
    			DP_Constants::REQUEST_PARAM_AMOUNT => round($genTrans->amount,2),
    			DP_Constants::REQUEST_PARAM_EMAIL => $request->email
    		];
            if($request->has('procId')){
                $dpPaymentData[DP_Constants::PROCESSOR] = $request->procId;
            }

            if($request->has('mode')){
                $dpPaymentData[DP_Constants::PAYMENT_MODE] = $request->mode;
            }
            
    		$dragonpay = new DP_Payment;
    		return $dragonpay->setPaymentDetails($dpPaymentData)
    			->redirect();

    	} catch(\Exception $e){
			if(config('app.debug')) dd($e);
    		session()->flash('msg',$e->getMessage());
    		session()->flash('msgClass','danger');
    		return redirect()->back();
    	}	
    }

    public function paymentUsingWSModel(Request $request,$transaction_no = null){
        try{
            $genTrans = $this->createTransaction($request,$transaction_no);

            $dpPaymentData = [
                DP_Constants::REQUEST_TOKEN_PARAM_MERCHANT_TXNID => $genTrans->transaction_id,
                DP_Constants::REQUEST_TOKEN_PARAM_DESCRIPTION => $genTrans->transaction_id,
                DP_Constants::REQUEST_TOKEN_PARAM_AMOUNT => round($genTrans->amount,2),
                DP_Constants::REQUEST_TOKEN_PARAM_EMAIL => $request->email,
            ];

            $dragonpay = new DP_Payment;
            return $dragonpay->setRequestTokenDetails($dpPaymentData)
                ->redirect();

        } catch(\Exception $e){
            if(config('app.debug')) dd($e);
            session()->flash('msg',$e->getMessage());
            session()->flash('msgClass','danger');
            return redirect()->back();
        }   
    }

 
    private function generateReferenceNumber($id){
      // $reference_code = ReferenceCode::get()->first();
      // $reference_code = ReferenceCode::inRandomOrder()->whereNull('booking_id')->first(); //From pool
      $reference_code = hash('crc32', $id, FALSE); // https://www.php.net/manual/en/function.crc32.php
      if($id === null) throw new \Exception("Invalid booking id");
      
      $reference_number = 'HTECH'. strtoupper($reference_code);
      \DB::table('dp_sample_transactions')->where('id',$id)->update(['transaction_id' => $reference_number]);
      return $reference_number;
    }

    private function createTransaction($request,$transaction_no = null){
        $transaction = null;
        if($transaction_no == null){

            $transaction = \DB::table('dp_sample_transactions')->insertGetId([
                'amount' => $request->credit,
                'email' => $request->email,
                'details' => json_encode($request->only(['credit','email'])),
                'transaction_id' => 'HTECH-'. uniqid(),
                'created_at' => \Carbon\Carbon::now()
            ]);
            $genRefNo = $this->generateReferenceNumber($transaction);
        }

        $genTrans = \DB::table('dp_sample_transactions')->when($transaction_no,function($query,$transaction_no){
            return $query->where('transaction_id',$transaction_no);
        },function($query) use ($transaction){
            return $query->where('id',$transaction);
        })->first();

        return $genTrans;
    }

    public function handlePostback(Request $request){
        //TODO:
        // Handle databse updates and transaction validation
        \DB::table('dp_sample_transactions')->insert([
            'transaction_no'    => $request->txnid, 
            'dp_reference_no'  => $request->refno, 
            'ps_status'        => $request->status, 
            'message'          => $request->message, 
            'digest'           => $request->digest, 
        ]);
        // Not sure if this  is working
        // return view('htech.dragonpay.examples.postback');
    }

    public function handleReturnURL(Request $request){
        try{
            $resData = $request->all();
            $transaction = \DB::table('dp_sample_transactions')->where('transaction_id',$request->txnid)->first();
           
            if($transaction === null) throw new \Exception("Invalid Transaction.");
            return view('htech.dragonpay.examples.return-page',compact('transaction','resData'));
        } catch( \Exception $e){
            if(config('app.debug')) dd($e);
            session()->flash('msg',$e->getMessage());
            session()->flash('msgClass','danger');
            return redirect()->back();
        }

    }

    public function additionalSupportFunctions(){
        $recentTransactions = \DB::table('dp_sample_transactions')->orderByDesc('created_at')->take(10)->get();

        return view('htech.dragonpay.examples.additional-support-functions',compact('recentTransactions'));
    }

    public function getTransactionStatus($transaction_id){
        
        $transaction = \DB::table('dp_sample_transactions')->where('transaction_id',$transaction_id)->first();
        $dragonPayServices = new DP_Services;
        $transactionStatus = $dragonPayServices->getTransactionStatus($transaction_id);
        
        return view('htech.dragonpay.examples.status-page',compact('transaction','transactionStatus'));
    }

    public function cancelTransaction($transaction_id){
        
        $transaction = \DB::table('dp_sample_transactions')->where('transaction_id',$transaction_id)->first();
        $dragonPayServices = new DP_Services;
        $cancellationStatus = $dragonPayServices->cancelTransaction($transaction_id);
        
        return view('htech.dragonpay.examples.status-page',compact('transaction','cancellationStatus'));
    }

    public function getDPReferenceNo($transaction_id){
        $transaction = \DB::table('dp_sample_transactions')->where('transaction_id',$transaction_id)->first();
        $dragonPayServices = new DP_Services;
        $referenceNo = $dragonPayServices->getDPReferenceNo($transaction_id);
        $referenceNo = $referenceNo ?? "No Assigned Reference No.";
        return view('htech.dragonpay.examples.status-page',compact('transaction','referenceNo'));
    }
}
