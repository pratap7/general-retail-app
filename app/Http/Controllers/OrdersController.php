<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builder;
use App\Plant;
use App\Order;
use App\Payment;
use PDF;
use Mail;

class OrdersController extends Controller {

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
        $orders = Order::orderBy('created_at','desc')->with('builder','plant')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $plants = Plant::get();
        $builders = Builder::get();
        return view('orders.create',compact('plants','builders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            "builder_id" => "required",
            "cement_brand" => "required",
            "plant_id" => "required",
            "packing_type" => "required",
            "bag_price" => "required",
            "quantity_type_kg" => "required",
            "cement_type" => "required"
        ]);

        $order = new Order([
            'builder_id'=> $request->get('builder_id'),
            'cement_brand'=> $request->get('cement_brand'),
            'plant_id'=> $request->get('plant_id'),
            'packing_type'=> $request->get('packing_type'),
            'cement_type'=> $request->get('cement_type'),
            'bag_price'=> $request->get('bag_price'),
            'quantity_type_kg'=> $request->get('quantity_type_kg'),
            'payment_detail'=> $request->get('payment_detail'),
            'cheque_no'=> $request->get('cheque_no'),
            'bank'=> $request->get('bank'),
            'order_no'=> $request->get('order_no'),
            'order_schedule'=> $request->get('order_schedule'),
            'billing_address'=>$request->get('billing_address'),
            'delivery_address'=>$request->get('delivery_address'),
            'cheque_date'=> $request->get('cheque_date'),
            'site_address'=>$request->get('site_address'),
            'site_contact'=>$request->get('site_contact'),
            'rate_per_mt'=>$request->get('rate_per_mt'),
            'site_taluka'=>$request->get('taluka'),
            'site_district'=>$request->get('district')
        ]);
        $order->save();
        return redirect('/order/review/'.$order->id)->with('success', 'Order placed!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order = Order::find($id);
        $plants = Plant::get();
        $builders = Builder::get();
        $currentSiteDestinations = unserialize($order->Builder->site_destinations);
        return view('orders.edit', compact('order','plants','builders','currentSiteDestinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            "cement_brand" => "required",
            "plant_id" => "required",
            "packing_type" => "required",
            "bag_price" => "required",
            "quantity_type_kg" => "required",
            "cement_type" => "required"
        ]);

        $order = Order::find($id);
        $order->cement_brand = $request->get('cement_brand');
        $order->plant_id = $request->get('plant_id');
        $order->packing_type = $request->get('packing_type');
        $order->bag_price = $request->get('bag_price');
        $order->quantity_type_kg = $request->get('quantity_type_kg');
        $order->cement_type = $request->get('cement_type');
        $order->payment_detail = $request->get('payment_detail');
        $order->cheque_no = $request->get('cheque_no');
        $order->cheque_date = $request->get('cheque_date');
        $order->bank = $request->get('bank');
        $order->order_no = $request->get('order_no');
        $order->order_schedule = $request->get('order_schedule');
        $order->billing_address = $request->get('billing_address');
        $order->delivery_address = $request->get('delivery_address');
        $order->site_address = $request->get('site_address');
        $order->site_contact = $request->get('site_contact');
        $order->rate_per_mt = $request->get('rate_per_mt');
        $order->site_taluka = $request->get('taluka');
        $order->site_district = $request->get('district');
        $order->save();
        return redirect('/orders')->with('success', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $paymentCount = Payment::where('order_id', $id)->count();
        if($paymentCount > 0 ){
            return redirect('/orders')->with('error', 'You can not delete this Order! There are existing payments for this Order!');
        }
        $order = Order::find($id);
        $order->delete();
        return redirect('/orders')->with('success', 'Order deleted successfully!');
    }

    public function generatePDF($id){
        $order = Order::find($id);
        if($order->cement_brand == 'ambuja'){
            $pdf = PDF::loadView('orders.ambuja_pdf', compact('order'));
            return $pdf->stream('ambuja-order.pdf');
        } else {
            $customPaper = array(0,0,920,1500);
            $category_of_project = unserialize($order->Builder->project_category);
            $pdf = PDF::loadView('orders.tmg_pdf', compact('order','category_of_project'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('tmg-order.pdf');
        }
        
    }

    /**
     * Show the form for review the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id) {
        $order = Order::with('builder','plant')->find($id);
        return view('orders.review', compact('order'));
    }

    /**
     * Show the form for review the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request) {
        $id = $request->get('order_id');
        $order = Order::with('builder','plant')->find($id);
        if($order->cement_brand == 'ambuja'){
            $pdf = PDF::loadView('orders.ambuja_pdf', compact('order'));
        } else {
            $customPaper = array(0,0,920,1500);
            $category_of_project = unserialize($order->Builder->project_category);
            $pdf = PDF::loadView('orders.tmg_pdf', compact('order','category_of_project'))->setPaper($customPaper, 'portrait');
        }
        
        $subject = "Order Confirmation";
        $msg = "Hi,\n\n We have placed your order. \nPlease find attachment regarding order details. \n\nThanks";
        
        $emails = array();
        $emails[] = $request->get('receiver_1');
        if(!empty($request->get('receiver_2'))) {
            $emails[] = $request->get('receiver_2');
        } 
        if(!empty($request->get('receiver_3'))) {
            $emails[] = $request->get('receiver_3');
        }
        $to = implode(",", $emails);
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
    )
    {
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
}