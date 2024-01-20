<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Builder;
use App\State;
use App\Order;
use PDF;

class BuildersController extends Controller {

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
        $builders = Builder::orderBy('created_at','desc')->get();

        return view('builders.index', compact('builders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $states = State::get();
        return view('builders.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'party_name'=>'required',
            'direct_customer_email' => 'required',
            'postal_address'=>'required', 
            'owner_name'=>'required',
            'village'=>'required',
            'taluka'=>'required',
            'district'=>'required',
            'state'=>'required',
            'pincode'=>'required',
            'owner_mobile'=>'required',
            'project_status'=>'required',
            'monthly_consumption'=>'required',
            'order_procured'=>'required',
            'sales_rep_code'=>'required',
            'gst_no'=>'required',
            'pan_no'=>'required',
            'letterhead_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'pancard_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'cancel_cheque_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'gst_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
        ]);
        $is_builder = ($request->get('is_builder') == 'YES') ? 'YES' : 'NO';
        $is_govt_contractor = ($request->get('is_govt_contractor') == 'YES') ? 'YES' : 'NO';
        $is_contractor = ($request->get('is_contractor') == 'YES') ? 'YES' : 'NO';
        $is_institutional = ($request->get('is_institutional') == 'YES') ? 'YES' : 'NO';
        $is_industry = ($request->get('is_industry') == 'YES') ? 'YES' : 'NO';
        $is_developer = ($request->get('is_developer') == 'YES') ? 'YES' : 'NO';
        $project_category_ar = array(
            'is_builder' => $is_builder ,
            'is_govt_contractor' => $is_govt_contractor,
            'is_contractor'=> $is_contractor, 
            'is_institutional'=> $is_institutional, 
            'is_industry'=> $is_industry, 
            'is_developer'=> $is_developer, 
        );

        $project_category_str = serialize($project_category_ar);

        $fright_debit_note = ($request->get('fright_debit_note') == 'YES') ? 'YES' : 'NO';
        $gross_billing = ($request->get('gross_billing') == 'YES') ? 'YES' : 'NO';
        $tax_invoice = ($request->get('tax_invoice') == 'YES') ? 'YES' : 'NO';
        $retail = ($request->get('retail') == 'YES') ? 'YES' : 'NO';

        $non_trade_ar = array(
            'fright_debit_note'=> $fright_debit_note,
            'gross_billing'=> $gross_billing,
            'tax_invoice'=> $tax_invoice,
            'retail'=> $retail,
        );
        $non_trade_str = serialize($non_trade_ar);

        $advance = ($request->get('advance') == 'YES') ? 'YES' : 'NO';
        $against_delivery = ($request->get('against_delivery') == 'YES') ? 'YES' : 'NO';
        $bg_lc = ($request->get('bg_lc') == 'YES') ? 'YES' : 'NO';
        $parent_mapping = ($request->get('parent_mapping') == 'YES') ? 'YES' : 'NO';


        $credit_terms_ar = array(
            'advance'=> $advance,
            'against_delivery'=> $against_delivery,
            'bg_lc'=> $bg_lc,
            'parent_mapping'=> $parent_mapping,            
        );
        $credit_terms_str = serialize($credit_terms_ar);

        // Upload Files
        $letterhead_file = $pancard_file = $cancel_cheque_file = $gst_file = "";
        $destinationPath = 'public/uploads/';
        if ($request->hasFile('letterhead_file')) {
            $files1 = $request->file('letterhead_file');
            $letterhead_file = "LETTERHEAD_" . time() . "." . $files1->getClientOriginalExtension();
            $files1->move($destinationPath, $letterhead_file);
        }
        if ($request->hasFile('pancard_file')) {
            $files2 = $request->file('pancard_file');
            $pancard_file = "PANCARD_" . time() . "." . $files2->getClientOriginalExtension();
            $files2->move($destinationPath, $pancard_file);
        }
        if ($request->hasFile('cancel_cheque_file')) {
            $files3 = $request->file('cancel_cheque_file');
            $cancel_cheque_file = "CANCELCHEQUE_" . time() . "." . $files3->getClientOriginalExtension();
            $files3->move($destinationPath, $cancel_cheque_file);
        }
        if ($request->hasFile('gst_file')) {
            $files4 = $request->file('gst_file');
            $gst_file = "GST_" . time() . "." . $files4->getClientOriginalExtension();
            $files4->move($destinationPath, $gst_file);
        }

        $is_dealing_other_firm = ($request->get('is_dealing_other_firm')  == 1) ? 1 : 0;

        $site_destination = array();
        foreach($request->get('site_destination') as $key=>$sd){
            if(!empty($sd)){
                $site_destination[$key]['destination'] = $sd;
                $site_destination[$key]['qty'] = 0;//$request->get('site_qty')[$key];
                $site_destination[$key]['contact'] = $request->get('site_cntct')[$key];
                $site_destination[$key]['taluka'] = $request->get('site_taluka')[$key];
                $site_destination[$key]['district'] = $request->get('site_district')[$key];
            }
        }
        $site_destination = serialize($site_destination);

        $builder = new Builder([
            'party_name'=> $request->get('party_name'),
            'postal_address'=> $request->get('postal_address'),
            'village'=> $request->get('village'),
            'taluka'=> $request->get('taluka'),
            'district'=> $request->get('district'),
            'state'=> $request->get('state'),
            'pincode'=> $request->get('pincode'),
            'owner_name'=> $request->get('owner_name'),
            'owner_landline'=> $request->get('owner_landline'),
            'owner_mobile'=> $request->get('owner_mobile'),
            'contact_person_landline'=> $request->get('contact_person_landline'),
            'contact_person_mobile'=> $request->get('contact_person_mobile'),
            'project_category'=> $project_category_str,
            'project_status'=> $request->get('project_status'),
            'total_consumption'=> $request->get('total_consumption'),
            'monthly_consumption'=> $request->get('monthly_consumption'),
            'site_destinations'=> $site_destination,
            'order_procured'=> $request->get('order_procured'),
            'sales_rep_code'=> $request->get('sales_rep_code'),
            'non_trade' => $non_trade_str,
            'credit_terms'=> $credit_terms_str,
            'credit_limit_period'=> $request->get('credit_limit_period'),
            'is_dealing_other_firm'=> $is_dealing_other_firm,
            'other_firm_details'=> ($request->has('other_firm_details') ? $request->get('other_firm_details') : ""), 
            'gst_no'=> $request->get('gst_no'),
            'pancard_no'=> $request->get('pan_no'),
            'branch_head'=> $request->get('branch_head'),
            'party_code'=> $request->get('party_code'),
            'factory_code'=> $request->get('factory_code'),
            'dist_code'=> $request->get('dist_code'),
            'frieght_code'=> $request->get('frieght_code'),
            'ac_ahmdbd'=> $request->get('ac_ahmdbd'),
            'letterhead_file'=> $letterhead_file,
            'pancard_file'=> $pancard_file,
            'cancel_cheque_file'=> $cancel_cheque_file,
            'gst_file'=> $gst_file, 
            'direct_customer_email' => $request->get('direct_customer_email'),
            'cement_brand'=> $request->get('cement_brand')
        ]);
        $builder->save();
        return redirect('/builder/review/'.$builder->id)->with('success', 'Builder saved!');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illumintae\Http\Response
     */
    public function display($id){
        $builder = Builder::find($id);
        return view('builders.show', compact('builder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $builder = Builder::find($id);
        $states = State::get();
        $category_of_project = unserialize($builder->project_category);
        $non_trade = unserialize($builder->non_trade);
        $credit_terms = unserialize($builder->credit_terms);
        $site_destinations = (!empty($builder->site_destinations)) ? unserialize($builder->site_destinations) : array();
        return view('builders.edit', compact('builder','states','category_of_project','non_trade','credit_terms','site_destinations'));
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
            'party_name'=>'required',
            'direct_customer_email' => 'required',
            'postal_address'=>'required', 
            'owner_name'=>'required',
            'village'=>'required',
            'taluka'=>'required',
            'district'=>'required',
            'state'=>'required',
            'pincode'=>'required',
            'owner_mobile'=>'required',
            'project_status'=>'required',
            'monthly_consumption'=>'required',
            'order_procured'=>'required',
            'sales_rep_code'=>'required',
            'gst_no'=>'required',
            'pan_no'=>'required',
            'letterhead_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'pancard_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'cancel_cheque_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
            'gst_file'=>'mimes:jpg,jpeg,gif,png|max:2400',
        ]);
        $is_builder = ($request->get('is_builder') == 'YES') ? 'YES' : 'NO';
        $is_govt_contractor = ($request->get('is_govt_contractor') == 'YES') ? 'YES' : 'NO';
        $is_contractor = ($request->get('is_contractor') == 'YES') ? 'YES' : 'NO';
        $is_institutional = ($request->get('is_institutional') == 'YES') ? 'YES' : 'NO';
        $is_industry = ($request->get('is_industry') == 'YES') ? 'YES' : 'NO';
        $is_developer = ($request->get('is_developer') == 'YES') ? 'YES' : 'NO';
        $project_category_ar = array(
            'is_builder' => $is_builder ,
            'is_govt_contractor' => $is_govt_contractor,
            'is_contractor'=> $is_contractor, 
            'is_institutional'=> $is_institutional, 
            'is_industry'=> $is_industry, 
            'is_developer'=> $is_developer, 
        );

        $project_category_str = serialize($project_category_ar);

        $fright_debit_note = ($request->get('fright_debit_note') == 'YES') ? 'YES' : 'NO';
        $gross_billing = ($request->get('gross_billing') == 'YES') ? 'YES' : 'NO';
        $tax_invoice = ($request->get('tax_invoice') == 'YES') ? 'YES' : 'NO';
        $retail = ($request->get('retail') == 'YES') ? 'YES' : 'NO';

        $non_trade_ar = array(
            'fright_debit_note'=> $fright_debit_note,
            'gross_billing'=> $gross_billing,
            'tax_invoice'=> $tax_invoice,
            'retail'=> $retail,
        );
        $non_trade_str = serialize($non_trade_ar);

        $advance = ($request->get('advance') == 'YES') ? 'YES' : 'NO';
        $against_delivery = ($request->get('against_delivery') == 'YES') ? 'YES' : 'NO';
        $bg_lc = ($request->get('bg_lc') == 'YES') ? 'YES' : 'NO';
        $parent_mapping = ($request->get('parent_mapping') == 'YES') ? 'YES' : 'NO';

        $credit_terms_ar = array(
            'advance'=> $advance,
            'against_delivery'=> $against_delivery,
            'bg_lc'=> $bg_lc,
            'parent_mapping'=> $parent_mapping,            
        );
        $credit_terms_str = serialize($credit_terms_ar);

        $site_destination = array();
        foreach($request->get('site_destination') as $key=>$sd){
            if(!empty($sd)){
                $site_destination[$key]['destination'] = $sd;
                $site_destination[$key]['qty'] = 0;//$request->get('site_qty')[$key];
                $site_destination[$key]['contact'] = $request->get('site_cntct')[$key];
                $site_destination[$key]['taluka'] = $request->get('site_taluka')[$key];
                $site_destination[$key]['district'] = $request->get('site_district')[$key];
            }
        }
        $site_destination = serialize($site_destination);

        $builder = Builder::find($id);
        $builder->party_name =  $request->get('party_name');
        $builder->direct_customer_email = $request->get('direct_customer_email');
        $builder->postal_address = $request->get('postal_address');
        $builder->owner_name = $request->get('owner_name');
        $builder->village = $request->get('village');
        $builder->taluka = $request->get('taluka');
        $builder->district = $request->get('district');
        $builder->state = $request->get('state');
        $builder->pincode = $request->get('pincode');
        $builder->owner_name = $request->get('owner_name');
        $builder->owner_landline = $request->get('owner_landline');
        $builder->owner_mobile = $request->get('owner_mobile');
        $builder->contact_person_landline = $request->get('contact_person_landline');
        $builder->contact_person_mobile = $request->get('contact_person_mobile');
        $builder->project_category = $project_category_str;
        $builder->project_status = $request->get('project_status');
        $builder->total_consumption = $request->get('total_consumption');
        $builder->monthly_consumption = $request->get('monthly_consumption');
        $builder->site_destinations = $site_destination;
        $builder->order_procured = $request->get('order_procured');
        $builder->sales_rep_code = $request->get('sales_rep_code');
        $builder->non_trade  > $non_trade_str;
        $builder->credit_terms = $credit_terms_str;
        $builder->credit_limit_period = $request->get('credit_limit_period');
        $builder->is_dealing_other_firm = ($request->get('is_dealing_other_firm') == 1) ? $request->get('is_dealing_other_firm') : 0;
        $builder->other_firm_details = ($request->has('other_firm_details')) ? $request->get('other_firm_details') : ""; 
        $builder->gst_no = $request->get('gst_no');
        $builder->pancard_no = $request->get('pan_no');
        $builder->branch_head = $request->get('branch_head');
        $builder->party_code = $request->get('party_code');
        $builder->factory_code = $request->get('factory_code');
        $builder->dist_code = $request->get('dist_code');
        $builder->frieght_code = $request->get('frieght_code');
        $builder->ac_ahmdbd = $request->get('ac_ahmdbd');
        $builder->cement_brand = $request->get('cement_brand');

        // Upload Files
        $destinationPath = 'public/uploads/';
        if ($request->hasFile('letterhead_file')) {
            $files1 = $request->file('letterhead_file');
            $letterhead_file = "LETTERHEAD_" . time() . "." . $files1->getClientOriginalExtension();
            $files1->move($destinationPath, $letterhead_file);
            $builder->letterhead_file = $letterhead_file;
        }
        if ($request->hasFile('pancard_file')) {
            $files2 = $request->file('pancard_file');
            $pancard_file = "PANCARD_" . time() . "." . $files2->getClientOriginalExtension();
            $files2->move($destinationPath, $pancard_file);
            $builder->pancard_file = $pancard_file;
        }
        if ($request->hasFile('cancel_cheque_file')) {
            $files3 = $request->file('cancel_cheque_file');
            $cancel_cheque_file = "CANCELCHEQUE_" . time() . "." . $files3->getClientOriginalExtension();
            $files3->move($destinationPath, $cancel_cheque_file);
            $builder->cancel_cheque_file = $cancel_cheque_file;
        }
        if ($request->hasFile('gst_file')) {
            $files4 = $request->file('gst_file');
            $gst_file = "GST_" . time() . "." . $files4->getClientOriginalExtension();
            $files4->move($destinationPath, $gst_file);
            $builder->gst_file = $gst_file;
        }  
        $builder->save();
        return redirect('/builders')->with('success', 'Builder updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // CHECK ENTRIES
        $ordersCount = Order::where('builder_id', $id)->count();
        if($ordersCount > 0 ){
            return redirect('/builders')->with('error', 'You can not delete this Builder! There are existing order for this Builder!');
        }
        $builder = Builder::find($id);
        if($builder->delete()){
            return redirect('/builders')->with('success', 'Builder deleted successfully!');
        }
        return redirect('/builders')->with('error', 'Some error occured!');
    }

    public function generatePDF($id){
        $builder = Builder::find($id);
        $states = State::get();
        $category_of_project = unserialize($builder->project_category);
        $non_trade = unserialize($builder->non_trade);
        $credit_terms = unserialize($builder->credit_terms);
        $site_destinations = (!empty($builder->site_destinations)) ? unserialize($builder->site_destinations) : array();

        if($builder->cement_brand == 'ambuja'){
            $pdf = PDF::loadView('builders.ambuja_pdf', compact('builder','states','category_of_project','non_trade','credit_terms','site_destinations'));
            return $pdf->stream('ambuja-builder.pdf');
        } else {
            $customPaper = array(0,0,920,1500);
            $category_of_project = unserialize($builder->project_category);
            $pdf = PDF::loadView('builders.tmg_pdf', compact('builder','states','category_of_project','non_trade','credit_terms','site_destinations'))->setPaper($customPaper, 'portrait');
            return $pdf->stream('tmg-builder.pdf');
        }
    }

    /**
     * Show the form for review the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id) {
        $builder = Builder::find($id);
        $states = State::get();
        $category_of_project = unserialize($builder->project_category);
        $non_trade = unserialize($builder->non_trade);
        $credit_terms = unserialize($builder->credit_terms);
        $site_destinations = (!empty($builder->site_destinations)) ? unserialize($builder->site_destinations) : array();
        $builderData = config('global.builderData');
        return view('builders.review', compact('builder','states','category_of_project','non_trade','credit_terms','site_destinations','builderData'));
    }

    /**
     * Show the form for review the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request) {
        $id = $request->get('builder_id');
        $builder = Builder::find($id);
        $states = State::get();
        $category_of_project = unserialize($builder->project_category);
        $non_trade = unserialize($builder->non_trade);
        $credit_terms = unserialize($builder->credit_terms);
        $site_destinations = (!empty($builder->site_destinations)) ? unserialize($builder->site_destinations) : array();
        if($builder->cement_brand == 'ambuja'){
            $pdf = PDF::loadView('builders.ambuja_pdf', compact('builder'));
        } else {
            $customPaper = array(0,0,500,1800);
            $category_of_project = unserialize($builder->project_category);
            $pdf = PDF::loadView('builders.tmg_pdf', compact('builder','states','category_of_project','non_trade','credit_terms','site_destinations'))->setPaper($customPaper, 'portrait');
        }
        
        $subject = "Builder Creation Confirmation";
        $msg = "Hi,\n\n New Builder is added. \nPlease find attachment regarding order details. \n\nThanks";
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
        file_put_contents('public/pdf/builder.pdf', $output);
        $mail = $this->sendMail($to, $msg, $subject, $fromMail, $fromName, "no-reply", $output);
        
        if($mail == true){
            return redirect()->back()->with('success', "Bulder Added Confirmation mail has been sent successfully!");
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
    )    {
        $fromMail = config('mail.from.address');
        $uid = md5(uniqid(time()));
        $filePath = 'public/pdf/builder.pdf';
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

    public function sendMessage(){
        $builders = Builder::get();
        return view('builders.message', compact('builders'));
    }

    public function sendSMS(Request $request){

        $builders = Builder::where('owner_mobile',"!=", "")->pluck('owner_mobile')->toArray();
        $mobiles = array();
        foreach ($builders as $builder) {
            $mobiles[] = "+91" . $builder;
        }
        $MESSAGE = $request->get('title') . ': ' . $request->get('message');
        $data = array(
            'message'      => $MESSAGE,
            'to'           => $mobiles,
            'sender_id'    => "SHYAMCORP",
            'callback_url' => "https://example.com/callback/handler"
        );
        $data = json_encode($data);
        $curl = curl_init();
        $API_KEY = config('global.SMS_CONFIG.API_KEY');
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sms.to/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer {$API_KEY}"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);
        if(isset($response->success) && $response->success == true){
            return redirect()->back()->with('success', 'Message sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Some error occured!');
        }
    }
}