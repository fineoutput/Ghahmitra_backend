<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
     
        return view('frontend/index')->withTitle('home');
    }
    public function services(Request $req)
    {
     
        return view('frontend/services')->withTitle('services');
    }
    public function cart(Request $req)
    {
     
        return view('frontend/cart')->withTitle('cart');
    }
    public function my_requests(Request $req)
    {
     
        return view('frontend/my_requests')->withTitle('my_requests');
    }
  
    public function profile(Request $req)
    {
     
        return view('frontend/profile')->withTitle('profile');
    }
    public function payment_history(Request $req)
    {
     
        return view('frontend/payment_history')->withTitle('payment_history');
    }
    public function wallet(Request $req)
    {
     
        return view('frontend/wallet')->withTitle('wallet');
    }
    
}
