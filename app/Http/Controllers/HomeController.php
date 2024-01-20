<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Builder;
use App\Plant;
use App\Payment;
use App\DispatchReport;
use Carbon\Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $ordersCount = Order::count();
        $buildersCount = Builder::count();
        $pendingPayment = Payment::where('utilize',0)->sum('amount');
        $recievedPayment = Payment::sum('amount');
        $builders = Builder::orderBy('id', 'desc')->take(10)->get();
        $orders = Order::orderBy('id','desc')->take(10)->get();
        $reports = DispatchReport::orderBy('id','desc')->take(10)->get();
        $payments = Payment::orderBy('id','desc')->take(10)->get();
        return view('home',compact('ordersCount','buildersCount','pendingPayment','recievedPayment','builders','orders','reports','payments'));
    }

    /**
     * Profile the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile() {
        return view('profile_edit');
    }

    /**
     * Update the User Profile
     */

     public function updateProfile(Request $request){

        $request->validate([
            'name'=>'required', 
        ]);
        $id = 1;
        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->save();
        return redirect('/')->with('success', 'Profile updated!');
     }
}
