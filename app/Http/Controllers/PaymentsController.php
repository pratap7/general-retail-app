<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builder;
use App\Plant;
use App\Order;
use App\Payment;
use PDF;
use Mail;

class PaymentsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $payments = Payment::orderBy('created_at','desc')->where('dispatch_id',0)->with('builder','order')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Display a listing of the specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentDetail($order_id) {
        $order = Order::find($order_id);
        $payments = Payment::orderBy('created_at','desc')->where('dispatch_id',0)->with('builder','order')->where('order_id',$order_id)->get();
        $utilizeStatus = $payments->where('utilize','==',0)->toArray();
        return view('payments.detail', compact('payments','order_id','order','utilizeStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        $request->validate([
            "builder_id" => "required",
            "order_id" => "required",
            "payment_mode" => "required",
        ]);
        
        $amount = $cheque_rtgs_no = $bank_name = $ifsc_code = $branch_name = $account_no = null;
        if($request->get('payment_mode') == 1){
            $amount = $request->get('cash_amount');
        } else {
            $amount = $request->get('cheque_amount');
            $cheque_rtgs_no = $request->get('cheque_rtgs_no');
            $account_no = $request->get('account_no');
            $bank_name = $request->get('bank_name');
            $ifsc_code = $request->get('ifsc_code');
            $branch_name = $request->get('branch_name');
        }

        $payment = new Payment([
            'builder_id'=> $request->get('builder_id'),
            'order_id'=> $request->get('order_id'),
            'payment_mode'=> $request->get('payment_mode'),
            'amount'=> $amount,
            'cheque_rtgs_no'=> $cheque_rtgs_no,
            'account_no'=> $account_no,
            'bank_name'=> $bank_name,
            'ifsc_code'=> $ifsc_code,
            'branch_name'=> $branch_name,
            'remarks' => $request->get('remarks'),
            'party_remarks' => $request->get('party_remarks'),
            'account_holder'=> $request->get('account_holder'),
            'invoice_reference'=>$request->get('invoice_reference'),
        ]);
        $payment->save();
        return redirect('/payment/detail/'.$request->get('order_id'))->with('success', 'Payment Saved Successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $request->validate([
            "order_id" => "required",
            "payment_mode" => "required",
        ]);

        $amount = $cheque_rtgs_no = $bank_name = $ifsc_code = $branch_name = $account_no = null;
        if($request->get('payment_mode') == 1){
            $amount = $request->get('cash_amount');
        } else {
            $amount = $request->get('cheque_amount');
            $cheque_rtgs_no = $request->get('cheque_rtgs_no');
            $account_no = $request->get('account_no');
            $bank_name = $request->get('bank_name');
            $ifsc_code = $request->get('ifsc_code');
            $branch_name = $request->get('branch_name');
        }

        $payment = Payment::find($request->get('payment_id'));
        $payment->builder_id = $request->get('builder_id');
        $payment->order_id = $request->get('order_id');
        $payment->payment_mode = $request->get('payment_mode');
        $payment->amount = $amount;
        $payment->cheque_rtgs_no = $cheque_rtgs_no;
        $payment->account_no = $account_no;
        $payment->bank_name = $bank_name;
        $payment->ifsc_code = $ifsc_code;
        $payment->branch_name = $branch_name;
        $payment->remarks = $request->get('remarks');
        $payment->party_remarks = $request->get('party_remarks');
        $payment->account_holder = $request->get('account_holder');
        $payment->invoice_reference = $request->get('invoice_reference');
        $payment->save();
        return redirect('/payment/detail/'.$request->get('order_id'))->with('success', 'Payment updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $order = Order::find($id);
        $order->delete();
        return redirect('/orders')->with('success', 'Order deleted successfully!');
    }

    public function generatePDF($id){
        $order = Order::find($id);
        $payments = Payment::with('builder','order')->where('dispatch_id',0)->where('order_id',$id)->get();
        if(isset($order->cement_brand) && $order->cement_brand == 'ambuja'){
            $customPaper = array(0,0,1000,600);
            $pdf = PDF::loadView('payments.ambuja_pdf', compact('order','payments'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('ambuja-payment.pdf');
        } else {
            $customPaper = array(0,0,900,600);
            $pdf = PDF::loadView('payments.tmg_pdf', compact('order','payments'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('tmg-payment.pdf');
        }   
    }

    /**
     * Show the form for review the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request) {
        $order_id = $request->get('order_id');
        $order = Order::find($order_id);
        $payments = Payment::with('builder','order')->where('order_id',$order_id)->get();
        if($order->cement_brand == 'ambuja'){
            $customPaper = array(0,0,1000,600);
            $pdf = PDF::loadView('payments.ambuja_pdf', compact('order','payments'))->setPaper($customPaper, 'portrait');
        } else {
            $customPaper = array(0,0,900,600);
            $pdf = PDF::loadView('payments.tmg_pdf', compact('order','payments'))->setPaper($customPaper, 'portrait');
        }

        $emails = array();
        $emails[] = $request->get('receiver_1');
        if(!empty($request->get('receiver_2'))) {
            $emails[] = $request->get('receiver_2');
        } 
        if(!empty($request->get('receiver_3'))) {
            $emails[] = $request->get('receiver_3');
        }
        $to = implode(",", $emails);
        $subject = "Order Confirmation";
        $msg = "Hi,\n\nPlease find attachment regarding payment details. \n\nThanks";
        $msg = wordwrap($msg,70);
        $fromMail = config('mail.from.address');
        $fromName = 'Gaurav Pratap';
        $output = $pdf->output();
        file_put_contents('public/pdf/order.pdf', $output);
        $mail = $this->sendMail($to, $msg, $subject, $fromMail, $fromName, "no-reply", $output);
        
        if($mail == true){
            return redirect()->back()->with('success', "Order Confirmation mail has been sent successfully!");
        }
        return redirect()->back()->with('error', "Some Error Occured in sending email!");
    }
    
    private function sendMail(
        $mailTo,
        $msg,
        $subject    = "Your Subject",
        $fromMail   = "",
        $fromName   = "from sender",
        $replyTo    = "no-reply"
    ) {
        $uid = md5(uniqid(time()));
        $filePath = 'public/pdf/order.pdf';
        $withAttachment = ($filePath !== NULL && file_exists($filePath));
    
        if($withAttachment){
            $fileName   = basename($filePath);
            $fileSize   = filesize($filePath);
            $handle     = fopen($filePath, "r");
            $content    = fread($handle, $fileSize);
            fclose($handle);
            $content = chunk_split(base64_encode($content));
        }
        
        $eol = PHP_EOL;
        
        // Basic headers
        $header = "From: ".$fromName." <".$fromMail.">".$eol;
        $header .= "Reply-To: ".$replyTo.$eol;
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
        
        // Put everything else in $message
        $message = "--".$uid.$eol;
        $message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
        $message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $message .= $msg.$eol;
        $message .= "--".$uid.$eol;
        $message .= "Content-Type: application/pdf; name=\"".$fileName."\"".$eol;
        $message .= "Content-Transfer-Encoding: base64".$eol;
        $message .= "Content-Disposition: attachment; filename=\"".$fileName."\"".$eol;
        $message .= $content.$eol;
        $message .= "--".$uid."--";
        
        return mail($mailTo, $subject, $message, $header);
    }

    public function utilize($id){
        Payment::where('order_id', $id)->where('dispatch_id',0)
          ->update(['utilize' => 1]);
        return redirect()->back()->with('success','All Payments has been utilized!');
    }

    public function utilizedPayments(){
        $payments = Payment::orderBy('created_at','desc')->where('dispatch_id',0)->where('utilize', 1)->with('builder','order')->get();
        return view('payments.utilized_payments', compact('payments'));
    }

    public function pendingPayments(){
        $payments = Payment::orderBy('created_at','desc')->where('dispatch_id',0)->where('utilize', 0)->with('builder','order')->get();
        return view('payments.pending_payments', compact('payments'));
    }
}