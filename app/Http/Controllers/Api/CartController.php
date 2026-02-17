<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\Cart;
use App\Models\City;
use App\Models\Customers;
use App\Models\Feedback;
use App\Models\Otp;
use App\Models\PartnerServices;
use App\Models\ServicePartner;
use App\Models\State;
use App\Models\SubOrder;
use App\Models\UnverifiedCustomer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{


 public function addtocart(Request $request)
{
    $customer = Auth::guard('customer_api')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $request->validate([
        'service_id' => 'required',
        'category_id' => 'required',
        'availability_id' => 'required',
        'quantity' => 'required|integer|min:1',
    ]);

    $PartnerServices = PartnerServices::where('service_id', $request->service_id)->exists();
    if(!$PartnerServices){
        return response()->json([
            'status' => 404,
            'message' => 'Service Curently Unavailable'
        ], 404);
    }

    $existingCart = Cart::where('customers_id', $customer->id)
        ->where('service_id', $request->service_id)
        ->where('category_id', $request->category_id)
        ->where('availability_id', $request->availability_id)
        ->where('status', 1)
        ->first();

    if ($existingCart) {

        $existingCart->quantity = $request->quantity;
        $existingCart->save();

        return response()->json([
            'status' => 200,
            'message' => 'Item already in cart, quantity updated',
            'cart' => $existingCart
        ]);
    }

    $cart = new Cart();
    $cart->customers_id = $customer->id;
    $cart->service_id = $request->service_id;
    $cart->category_id = $request->category_id;
    $cart->availability_id = $request->availability_id;
    $cart->quantity = $request->quantity;
    $cart->ip = $request->ip();
    $cart->status = 1;
    $cart->save();

    return response()->json([
        'status' => 201,
        'message' => 'Item added to cart successfully',
        'cart' => $cart
    ]);
}

 public function getcart(Request $request)
{
    $customer = Auth::guard('customer_api')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $cartItems = Cart::with(['service','ServicesSe','availability'])
        ->where('customers_id', $customer->id)
        ->where('status', 1)
        ->get()
        ->map(function ($item) {

            // Service Images Full URL
            $images = [];

            if (!empty($item->service->image) && is_array($item->service->image)) {
                $images = array_map(function ($img) {
                    return url($img);
                }, $item->service->image);
            }

            return [
                'cart_id' => $item->id,
                'quantity' => $item->quantity,
                'service_id' => $item->service_id,
                'category_id' => $item->category_id,
                'availability_id' => $item->availability_id,

                'service' => [
                    'id' => $item->service->id ?? null,
                    'name' => $item->service->name ?? null,
                    'price' => $item->service->price ?? null,
                    'images' => $images,
                ],

                'service_category' => [
                    'id' => $item->ServicesSe->id ?? null,
                    'name' => $item->ServicesSe->name ?? null,
                ],

                'availability' => [
                    'day' => $item->availability->day ?? null,
                    'start_time' => $item->availability->start_time ?? null,
                    'end_time' => $item->availability->end_time ?? null,
                    'description' => isset($item->availability->description) 
                        ? strip_tags($item->availability->description) 
                        : null,
                ]
            ];
        });

    return response()->json([
        'status' => 200,
        'message' => 'Cart items retrieved successfully',
        'cart_items' => $cartItems
    ]);
}


public function updateCart(Request $request)
{
    $customer = Auth::guard('customer_api')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $request->validate([
        'cart_id' => 'required|exists:tbl_cart,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = Cart::where('id', $request->cart_id)
        ->where('customers_id', $customer->id)
        ->where('status', 1)
        ->first();

    if (!$cart) {
        return response()->json([
            'status' => 404,
            'message' => 'Cart item not found'
        ], 404);
    }

    $cart->quantity = $request->quantity;
    $cart->save();

    return response()->json([
        'status' => 200,
        'message' => 'Cart updated successfully',
        'cart' => $cart
    ]);
}



public function calculate(Request $request)
{
    $customer = Auth::guard('customer_api')->user();

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

    $grandTotal = 0;
    $items = [];

    foreach ($cartItems as $item) {

        if (!$item->service) {
            continue;
        }

        $price = $item->service->price;
        $quantity = $item->quantity;
        $total = $price * $quantity;

        $grandTotal += $total;

        $items[] = [
            'cart_id' => $item->id,
            'service_id' => $item->service_id,
            'availability_id' => $item->availability_id,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ];
    }

    return response()->json([
        'status' => 200,
        'message' => 'Cart calculated successfully',
        'data' => [
            'items' => $items,
            'grand_total' => $grandTotal
        ]
    ]);
}


public function storeFeedback(Request $request)
{
    $customer = Auth::guard('customer_api')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $request->validate([
        'description' => 'required|string|max:1000',
    ]);

    $feedback = Feedback::create([
        'user_id' => $customer->id,
        'description' => $request->description,
        'star' => $request->star,
        'status' => 1, // active
    ]);

    return response()->json([
        'status' => 201,
        'message' => 'Feedback submitted successfully',
        'data' => $feedback
    ]);
}

    
}
