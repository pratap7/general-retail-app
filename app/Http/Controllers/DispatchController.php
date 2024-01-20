<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builder;
use App\Plant;
use App\Order;
use App\Payment;
use PDF;
use Mail;
use App\DispatchReport;

class DispatchController extends Controller {

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
    public function ambujaReports() {
        $all_reports = DispatchReport::orderBy('created_at','desc')->where('type','ambuja')->get();
        $builders = Builder::get();
        return view('dispatch.ambuja_reports', compact('all_reports','builders'));
    }

    public function mehtaReports() {
        $all_reports = DispatchReport::orderBy('created_at','desc')->where('type','mehta')->get();
        $builders = Builder::get();
        return view('dispatch.mehta_reports', compact('all_reports','builders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        $request->validate([
            "type" => "required",
        ]);
        $order_no = trim($request->get('order_no'));
        //CHECK ORDER EXISTENCE
        $order = Order::where('order_no', $order_no)->first();
        if ($order === null) {
            return redirect()->back()->withInput()->with('error', 'Order no does not exist!');
        }
        $report = new DispatchReport([
            'brand'=> $request->get('brand'), 
            'type'=> $request->get('type'), 
            'ref_doc_no'=> $request->get('ref_doc_no'),
            'del_date'=> $request->get('del_date'), 
            'quantity'=> $request->get('quantity'), 
            'invoice_no'=> $request->get('invoice_no'), 
            's_plan_no'=> $request->get('s_plan_no'), 
            'transport_name'=> $request->get('transport_name'), 
            'date_tmg'=> $request->get('date_tmg'), 
            'brand'=> $request->get('brand'), 
            'price'=> $request->get('price'), 
            'order_no'=> $order_no,
            'party_code'=> $request->get('party_code'), 
            'truck_no'=> $request->get('truck_no'), 
            'location'=> $request->get('location'), 
            'party_name'=> $request->get('party_name'), 
            'invoice_amount'=> $request->get('invoice_amount'),
            'company' => $request->get('company'),
            'tax_retail_inv' => $request->get('tax_retail_inv')
        ]);
        $report->save();
        $id = $report->id;
        $order = Order::where('order_no',$request->get('order_no'))->first();
        // SAVE PAYMENT
        if(!empty($order)){
            $payment = new Payment([
                'builder_id'=> $order->Builder->id,
                'order_id'=> $order->id,
                'amount'=> $request->get('invoice_amount'),
                'dispatch_id'=>$id,
            ]);
            $payment->save();
        }
        
        if($request->get('type') == 'mehta'){
            return redirect('/dispatch-mehta')->with('success', 'Report Saved Successfully!');
        }
        return redirect('/dispatch-ambuja')->with('success', 'Report Saved Successfully!');
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
            "type" => "required",
        ]);
        $order_no = trim($request->get('order_no'));
        //CHECK ORDER EXISTENCE
        $order = Order::where('order_no', $order_no)->first();
        if ($order === null) {
            return redirect()->back()->withInput()->with('error', 'Order no does not exist!');
        }
        $report = DispatchReport::find($request->get('report_id'));
        $report->brand = $request->get('brand'); 
        $report->type = $request->get('type');
        $report->ref_doc_no = $request->get('ref_doc_no');
        $report->del_date = $request->get('del_date'); 
        $report->quantity = $request->get('quantity'); 
        $report->invoice_no = $request->get('invoice_no'); 
        $report->s_plan_no = $request->get('s_plan_no'); 
        $report->transport_name = $request->get('transport_name'); 
        $report->date_tmg = $request->get('date_tmg'); 
        $report->brand = $request->get('brand'); 
        $report->price = $request->get('price'); 
        $report->order_no = $order_no;
        $report->party_code = $request->get('party_code'); 
        $report->truck_no = $request->get('truck_no'); 
        $report->location = $request->get('location'); 
        $report->party_name = $request->get('party_name'); 
        $report->invoice_amount = $request->get('invoice_amount');
        $report->company = $request->get('company');
        $report->tax_retail_inv = $request->get('tax_retail_inv');
        $report->save();
        if($request->get('type') == 'mehta'){
            return redirect('/dispatch-mehta')->with('success', 'Report updated Successfully!');
        }
        return redirect('/dispatch-ambuja')->with('success', 'Report updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyReport($id) {
        $dr = DispatchReport::find($id);
        $dr->delete();
        return redirect()->back()->with('success', 'Report deleted successfully!');
    }

    public function ambujaPDF(){
        $all_reports = DispatchReport::where('type','ambuja')->get();
        $customPaper = array(0,0,900,600);
        $pdf = PDF::loadView('dispatch.ambuja-pdf', compact('all_reports'))->setPaper($customPaper, 'portrait');
        return $pdf->stream('ambuja-dispatch-reports.pdf');
    }

    public function mehtaPDF(){
        $all_reports = DispatchReport::where('type','mehta')->get();
        $customPaper = array(0,0,900,600);
        $pdf = PDF::loadView('dispatch.tmg-pdf', compact('all_reports'))->setPaper($customPaper, 'portrait');
        return $pdf->stream('tmg-dispatch-reports.pdf');
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
        $fromMail = config('mail.from.address');
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

    public function sendMessage($id){
        $report = DispatchReport::find($id);
        // Get Builder Detail
        $builder = Builder::where('party_name',$report->party_name)->where('party_code',$report->party_code)->first();
        $order = Order::where('order_no',$report->order_no)->first();
        $plant_name = "N/A";
        if(!empty($order)){
            $plant_name = $order->Plant->plant_name ?? "N/A";
        }
        $MESSAGE = 'Plant Name - ' . $plant_name ." \nOrder Number - " .  $report->order_no . " \nDate - ". $report->created_at->format('d/m/yy') . "\nParty Name - ". $report->party_name . "\nParty Code - "  . $report->party_code . "\nQty - " . $report->quantity . "\nBrand - " . $report->brand .  "\nTruck No - " . $report->truck_no .  "\nDestination - ". $report->location . "\nInvoice No - " . $report->invoice_no;

        if(!isset($builder->owner_mobile) || empty($builder->owner_mobile)){
            return redirect()->back()->with('error', 'Mobile no is not valid!');
        }
        $API_KEY = config('global.SMS_CONFIG.API_KEY');
        $MOBILE_NO = "+91". $builder->owner_mobile;

        $data = array(
            'message'      => $MESSAGE,
            'to'           => $MOBILE_NO,
            'sender_id'    => "SHYAMCORP",
            'callback_url' => "https://example.com/callback/handler"
        );
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sms.to/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer {$API_KEY}"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        if(isset($response->success) && $response->success == true){
            return redirect()->back()->with('success', 'Message sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Some error occured!');
        } 
    }
}