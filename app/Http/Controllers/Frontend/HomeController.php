<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
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
       $data['services'] = Services::with('serviceDetails')
        ->where('status', 1)
        ->orderBy('id','desc')
        ->get();
        $data['exclusive_offers'] = ServicesSe::orderby('id','desc')->where('exclusive_offers', 1)->where('status', 1)->get();
        $data['cleaning'] = ServicesSe::orderby('id','desc')->where('cleaning', 1)->where('status', 1)->get();
        $data['most_booked'] = ServicesSe::orderby('id','desc')->where('most_booked', 1)->where('status', 1)->get();
        $data['banner'] = Banner::orderby('id','desc')->where('type', 'banner')->where('status', 1)->first();
        $data['offer'] = Banner::orderby('id','desc')->where('type', 'offer')->where('status', 1)->get();

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
