<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builder;
use App\Plant;
use App\Order;
use App\Payment;
use PDF;
use Mail;

use Illuminate\Support\Carbon;

class StatementsController extends Controller {

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
    public function index(Request $request) {
        $payments = array();
        if($request->has('builder') && $request->has('brand')){
            $orders = Order::where('builder_id',$request->get('builder'))->where('cement_brand',$request->get('brand'))->pluck('id')->toArray();
            $payments = Payment::whereIn('order_id',$orders)->with('builder','order','dispatch')->get();
        }
        $builders = Builder::get();
        return view('statements.index', compact('payments','builders'));
    }

    /**
     * Display a listing of the specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentDetail($order_id) {
        $order = Order::find($order_id);
        $payments = Payment::with('builder','order')->where('order_id',$order_id)->get();
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

    public function generatePDF($builder,$brand){
        $dateFilter = false;;
        $payments = array();
        if($builder && $brand){  

            /*
                ## IN CASE OF CURRENT DATE
                Opening Balance = Total Debit ~ Total Credit (BEFORE CURRENT DATE)
                Closing Balance = Total Debit ~ Total Credit (ONLY CURRENT DATE[15 May] ENTRIES )
            // WITH NO DATE FILTER
            */
            $orders = Order::where('builder_id',$builder)->where('cement_brand',$brand)->pluck('id')->toArray();
            $payments = Payment::whereIn('order_id',$orders)->with('builder','order','dispatch')->get();
            $debitTotal = $creditTotal = $debitTotal_closing = $creditTotal_closing = 0;
            $today_date = date_create();
            $todayDate = date_format($today_date,"Y-m-d");
            foreach($payments as $payment){
                if($payment->utilize == 0 && $payment->dispatch_id == 0){
                    continue;
                }
                $debit = $credit = 0;
                $doc_date = $payment->created_at->format('yy-m-d');
                if($payment->dispatch_id != 0){
                    $debit = $payment->dispatch->invoice_amount;
                    $doc_date = $payment->dispatch->del_date;
                }
      
                if($payment->utilize == 1 && $payment->dispatch_id == 0){
                    $credit = $payment->amount;
                }
                if($doc_date == $todayDate){
                    $debitTotal_closing += $debit;
                    $creditTotal_closing += $credit;
                    continue;
                }
                $debitTotal += $debit;
                $creditTotal += $credit;
            }

            $obType = $cbType = "CR";
            $openingBalance = $creditTotal - $debitTotal;
            if($debitTotal > $creditTotal){
                $obType = "DR";
                $openingBalance = $debitTotal - $creditTotal;
            }
            $openingBalance = $openingBalance . " " . $obType; 

            $closingBalance = $creditTotal_closing - $debitTotal_closing;
            if($debitTotal_closing > $creditTotal_closing){
                $cbType = "DR";
                $closingBalance = $debitTotal_closing - $creditTotal_closing;
            }
            $closingBalance = $closingBalance . " " . $cbType;

            // Extended Version
            if(isset($_GET['date_filter']) && !empty($_GET['date_filter'])){
                $date_filter = base64_decode($_GET['date_filter']);
                $date_filter = explode('-',$date_filter);
                $from_date = date_create($date_filter[0]);
                $to_date = date_create($date_filter[1]);
                //$start_date = date_format($from_date,"Y-m-d H:i:s");
                //$end_date = date_format($to_date,"Y-m-d H:i:s");

                /* ## IN CASE OF DATE FILTER
                 Start date - 10 May
                 End Date = 20 May
 
                 Opening Balance = Total Debit ~ Total Credit (BEFORE 10th MAY)
                 Closing Balance = Total Debit ~ Total Credit (AFTER 20th MAY)
                */
                //$payments = Payment::whereIn('order_id',$orders)->where('created_at', ">=", $start_date)->where('created_at',"<=",$end_date)->with('builder','order','dispatch')->get();
                $all_payments = Payment::whereIn('order_id',$orders)->with('builder','order','dispatch')->get();
                $debitTotal = $creditTotal = $debitTotal_closing = $creditTotal_closing = 0;
                $today_date = date_create();
                $todayDate = date_format($today_date,"Y-m-d");
                $sdate = date_format($from_date,"Y-m-d");
                $edate = date_format($to_date,"Y-m-d");
                foreach($all_payments as $payment){
                    $doc_date = $payment->created_at->format('yy-m-d');
                    if($payment->dispatch_id != 0){
                        $doc_date = $payment->dispatch->del_date;
                    }
                    if($doc_date >= $sdate && $doc_date <= $edate ){
                        continue;
                    }

                    if($payment->utilize == 0 && $payment->dispatch_id == 0){
                        continue;
                    }
                    $debit = $credit = 0;
                    $doc_date = $payment->created_at->format('yy-m-d');
                    if($payment->dispatch_id != 0){
                        $debit = $payment->dispatch->invoice_amount;
                        $doc_date = $payment->dispatch->del_date;
                    }
        
                    if($payment->utilize == 1 && $payment->dispatch_id == 0){
                        $credit = $payment->amount;
                    }
                    if($doc_date > $edate){
                        $debitTotal_closing += $debit;
                        $creditTotal_closing += $credit;
                        continue;
                    }
                    $debitTotal += $debit;
                    $creditTotal += $credit;
                }

                $obType = $cbType = "CR";
                $openingBalance = $creditTotal - $debitTotal;
                if($debitTotal > $creditTotal){
                    $obType = "DR";
                    $openingBalance = $debitTotal - $creditTotal;
                }
                $openingBalance = $openingBalance . " " . $obType; 

                $closingBalance = $creditTotal_closing - $debitTotal_closing;
                if($debitTotal_closing > $creditTotal_closing){
                    $cbType = "DR";
                    $closingBalance = $debitTotal_closing - $creditTotal_closing;
                }
                $closingBalance = $debitTotal_closing - $creditTotal_closing . " " . $cbType;
                $dateFilter = base64_decode($_GET['date_filter']);
            }
        }
        $builder = Builder::find($builder);
        if($brand == 'ambuja'){
            $customPaper = array(0,0,1000,600);
            $pdf = PDF::loadView('statements.ambuja_pdf', compact('payments','builder','openingBalance','closingBalance','dateFilter'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('ambuja-statement.pdf');
        } else {
            $customPaper = array(0,0,900,600);
            $pdf = PDF::loadView('statements.tmg_pdf', compact('payments','builder','openingBalance','closingBalance','dateFilter'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('tmg-statement.pdf');
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
        Payment::where('order_id', $id)
          ->update(['utilize' => 1]);
        return redirect()->back()->with('success','All Payments has been utilized!');
    }

    public function utilizedPayments(){
        $payments = Payment::where('utilize', 1)->with('builder','order')->get();
        return view('payments.utilized_payments', compact('payments'));
    }

    public function pendingPayments(){
        $payments = Payment::where('utilize', 0)->with('builder','order')->get();
        return view('payments.pending_payments', compact('payments'));
    }
}