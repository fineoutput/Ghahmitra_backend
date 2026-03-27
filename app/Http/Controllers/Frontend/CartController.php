<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Services;
use App\Models\ServicesSe;
use App\Models\Th_Services;
use App\Models\Cart;
use App\Models\PartnerServices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use App\Models\City;
use App\Models\CustomerAddresses;
use App\Models\ManualCity;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ============================= START INDEX ============================ 
  public function addtocart(Request $request)
{

    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Login First'
        ], 401);
    }

    $request->validate([
        'service_id' => 'required',
        'category_id' => 'required',
        'availability_id' => 'nullable',
        'quantity' => 'required|integer|min:1',
    ]);

    $existingCart = Cart::where('customers_id',$customer->id)
        ->where('service_id',$request->service_id)
        ->where('category_id',$request->category_id)
        ->where('availability_id',$request->availability_id)
        ->where('status',1)
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

public function updatecart(Request $request)
{

    $customer = Auth::guard('customer')->user();

    if(!$customer){

        return response()->json([
            'status' => 401,
            'message' => 'Please login first'
        ]);

    }

    $cart = Cart::where('customers_id',$customer->id)
        ->where('service_id',$request->service_id)
        ->where('category_id',$request->category_id)
        ->where('status',1)
        ->first();

    if(!$cart){

        return response()->json([
            'status'=>404,
            'message'=>'Cart item not found'
        ]);

    }

    $cart->quantity = $request->quantity;
    $cart->save();

    return response()->json([
        'status'=>200,
        'message'=>'Cart updated successfully'
    ]);

}


public function removecart(Request $request){

        $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $request->validate([
        'cart_id' => 'required|exists:tbl_cart,id',
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

    $cart->delete();

    return redirect()->back()->with('success', 'Cart removed successfully');
}

public function selectslot(Request $request)
{
    $request->validate([
        'cart_item_id' => 'required',
        'availability_id' => 'required',
        'slot_id' => 'required'
    ]);

    $customer = Auth::guard('customer')->user();

    if(!$customer){
        return response()->json([
            'status' => 401,
            'message' => 'Please login first'
        ]);
    }

    $cartItems = Cart::where('customers_id', $customer->id)
        ->where('id', $request->cart_item_id)
        ->first();

    if(!$cartItems){
        return redirect()->back()->with('error','Cart item not found');
    }

    $cartItems->update([
        'availability_id' => $request->availability_id,
        'slot_id' => $request->slot_id
    ]);

    return redirect()->back()->with('success', 'Slot selected successfully');
}

public function getCities(Request $request)
{
    $city = ManualCity::where('id', $request->city_id)->first();

    if ($city && $city->pincode) {
        $pincodes = explode(',', $city->pincode); // split

        return response()->json($pincodes);
    }

    return response()->json([]);
}

  public function store(Request $request)
    {

      $request->validate([
        'type' => 'required|in:home,office,other',
        'name' => 'required|string|max:100',
        'mobile_no' => 'required|digits:10',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'landmark' => 'nullable|string|max:255',
        // 'state_id' => 'required',
        'city_id' => 'required',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'pincode' => 'required|digits:6',
    ]);


     $customer = Auth::guard('customer')->user();
        CustomerAddresses::create([

        'customer_id' => $customer->id,
        'type' => $request->type,
        'name' => $request->name,
        'mobile_no' => $request->mobile_no,
        'address_line1' => $request->address_line1,
        'address_line2' => $request->address_line2,
        'landmark' => $request->landmark,
        'city_id' => $request->city_id,
        // 'state_id' => $request->state_id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'pincode' => $request->pincode,

    ]);

      return redirect()->route('request_detail')->with('success','Address Added');

    }

public function deleteAddress($id)
{
    $customer = Auth::guard('customer')->user();
 
    if (!$customer) {
        return response()->json([
            'status' => 401,
            'message' => 'Login required'
        ], 401);
    }
 
    $address = CustomerAddresses::where('id', $id)
        ->where('customer_id', $customer->id) // security check
        ->first();
 
    if (!$address) {
        return response()->json([
            'status' => 404,
            'message' => 'Address not found'
        ]);
    }
 
    $address->delete();
 
    return redirect()->route('request_detail')->with('success','Address Added');
}
}
