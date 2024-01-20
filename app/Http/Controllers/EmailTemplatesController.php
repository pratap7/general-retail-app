<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\EmailTemplate;

class EmailTemplatesController extends Controller {

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
        $email_templates = EmailTemplate::all();
        return view('email_templates.index', compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('email_templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'subject'=>'required',
            'content' => 'required',
        ]);

        $plant = new EmailTemplate([
            'subject'=> $request->get('subject'),
            'content'=> $request->get('content'),
            'slug'=> Str::slug($request->get('subject'), '-'),
            ]);
        $plant->save();
        return redirect('/email-templates')->with('success', 'Template saved successfully!');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illumintae\Http\Response
     */
    public function display($id){
        $template = EmailTemplate::find($id);
        return view('email_templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $template = EmailTemplate::find($id);
        return view('email_templates.edit', compact('template'));
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
            'subject'=>'required',
            'content' => 'required',
        ]);

        $template = EmailTemplate::find($id);
        $template->subject =  $request->get('subject');
        $template->content = $request->get('content');
        $template->save();
        return redirect('/email-templates')->with('success', 'Email Template updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $template = EmailTemplate::find($id);
        $template->delete();
        return redirect('/email-templates')->with('success', 'Template deleted successfully!');
    }
}