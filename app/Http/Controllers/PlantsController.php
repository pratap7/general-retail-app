<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plant;

class PlantsController extends Controller {

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
        $plants = Plant::all();
        return view('plants.index', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('plants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'plant_name'=>'required',
            'plant_email' => 'required',
        ]);

        $plant = new Plant([
            'plant_name'=> $request->get('plant_name'),
            'plant_email'=> $request->get('plant_email'),
            'plant_contact'=> $request->get('plant_contact'),
            ]);
        $plant->save();
        return redirect('/plants')->with('success', 'Plant detail saved!');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illumintae\Http\Response
     */
    public function display($id){
        $plant = Plant::find($id);
        return view('plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $plant = Plant::find($id);
        return view('plants.edit', compact('plant'));
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
            'plant_name'=>'required',
            'plant_email' => 'required',
            'plant_contact'=>'required', 
        ]);

        $plant = Plant::find($id);
        $plant->plant_name =  $request->get('plant_name');
        $plant->plant_email = $request->get('plant_email');
        $plant->plant_contact = $request->get('plant_contact');
        $plant->save();
        return redirect('/plants')->with('success', 'Plant updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $plant = Plant::find($id);
        $plant->delete();
        return redirect('/plants')->with('success', 'Plant deleted successfully!');
    }
}