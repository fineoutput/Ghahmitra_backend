<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\CustomerAddresses;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Services;
use App\Models\ServicesSe;
use App\Models\State;
use App\Models\Th_Services;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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



    public function servicesdetailes(Request $req, $id)
    {
            $data['services'] = ServicesSe::orderBy('id','desc')->where('id','!=', $id)->where('status', 1)->get();
            $data['services_details'] = Th_Services::orderBy('id','desc')->where('services_se_id', $id)->get();
            $user = Auth::guard('customer')->user();
            if ($user) {
                $data['cart_items'] = Cart::where('customers_id', $user->id)->where('status', 1)->get();
            } else {
                $data['cart_items'] = [];
            }
          return view('frontend/services',$data)->withTitle('services');
    }

    public function cart(Request $req)
    {
        $data['customer'] = Auth::guard('customer')->user();
        if (!$data['customer']) {
            return redirect()->route('/')->with('error', 'Please login to view your cart.');
        }
        $data['states'] = State::all();
        $data['CustomerAddresses'] = CustomerAddresses::where('customer_id',$data['customer']->id)->get();
        $data['cart_items'] = Cart::with('service', 'ServicesSe', 'availability')
            ->where('customers_id', $data['customer']->id)->where('status', 1)->get();

        $data['cart_total'] = $data['cart_items']->sum(function($item) {
                return ($item->service->price ?? 0) * $item->quantity;});

        return view('frontend/cart', $data)->withTitle('cart');
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
    $customer = Auth::guard('customer')->user();

    $cartItems = Cart::with('service')
        ->where('customers_id', $customer->id)
        ->where('status', 1)
        ->get();

    $items = [];
    $grandTotal = 0;

    foreach ($cartItems as $item) {
        if (!$item->service) continue;

        $price = $item->service->price;
        $quantity = $item->quantity;
        $total = $price * $quantity;

        $grandTotal += $total;

        $items[] = [
            'cart_id' => $item->id,
            'service_id' => $item->service_id,
            'service_name' => $item->service->name,
            'availability_id' => $item->availability_id,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ];
    }

    return view('frontend/request_detail', compact('customer', 'items', 'grandTotal'))
           ->withTitle('request_detail');
}


public function checkout(Request $request)
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $cartItems = Cart::with('service')
        ->where('customers_id', $customer->id)
        ->where('status', 1)
        ->get();

    if ($cartItems->isEmpty()) {
        return response()->json([
            'status' => 400,
            'message' => 'Cart is empty'
        ]);
    }

    DB::beginTransaction();

    try {

        $subtotal = 0;
        $tax = 0;
        $discount = 0;

        // 1️⃣ Calculate subtotal
        foreach ($cartItems as $item) {

            if (!$item->service) {
                continue;
            }

            $price = $item->service->price;
            $quantity = $item->quantity;
            $total = $price * $quantity;

            $subtotal += $total;
        }

        // 2️⃣ Example Tax (5%)
        $tax = 0;

        // 3️⃣ Example Discount (optional)
        $discount = 0;

        $grandTotal = $subtotal + $tax - $discount;

        // 4️⃣ Create Order
        $order = Order::create([
            'order_number'   => 'ORD-' . strtoupper(Str::random(8)),
            'customer_id'    => $customer->id,
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'discount'       => $discount,
            'grand_total'    => $grandTotal,
            'payment_method' => $request->payment_method ?? 'COD',
            'payment_status' => 'pending',
            'order_status'   => 1, // pending
            'address_id'     => $request->address_id,
            'notes'          => $request->notes ?? null,
            'status'          => 1,
        ]);

        // 5️⃣ Create Order Items
        foreach ($cartItems as $item) {

            if (!$item->service) {
                continue;
            }

            $price = $item->service->price;
            $quantity = $item->quantity;
            $total = $price * $quantity;

            OrderItems::create([
                'order_id'        => $order->id,
                'service_id'      => $item->service_id,
                'service_name'    => $item->service->name,
                'price'           => $price,
                'quantity'        => $quantity,
                'total'           => $total,
                'availability_id' => $item->availability_id,
            ]);
        }

        // 6️⃣ Clear Cart Completely (Delete)
        Cart::where('customers_id', $customer->id)
            ->where('status', 1)
            ->delete();

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Order placed successfully',
            'data' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'grand_total' => $grandTotal
            ]
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => 500,
            'message' => 'Checkout failed',
            'error' => $e->getMessage()
        ]);
    }
}
}
