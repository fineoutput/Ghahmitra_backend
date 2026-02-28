<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\ServicesSe;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
        $data['services'] = Services::with(['serviceDetails' => function($q){
        $q->where('status', 1);
        }])->where('status', 1)->get();
        $data['services_se'] = ServicesSe::where('status', 1)->get();

        return view('frontend/index', $data)->withTitle('home');
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
        $data['customer'] = Auth::guard('customer')->user();
        return view('frontend/profile')->withTitle('profile')->with($data);
    }
    
    public function payment_history(Request $req)
    {
     
        return view('frontend/payment_history')->withTitle('payment_history');
    }
    public function wallet(Request $req)
    {
     
        return view('frontend/wallet')->withTitle('wallet');
    }
    public function request_detail(Request $req)
    {
     
        return view('frontend/request_detail')->withTitle('request_detail');
    }
    
}
