<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\CustomerAddresses;
use App\Models\Customers;
use App\Models\Otp;
use App\Models\ServicePartner;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function addcustomeraddress(Request $request)
    {
        $customer = Auth::guard('customer_api')->user();

            if (!$customer) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Unauthorized'
                ], 401);
            }

        $request->validate([
            'type' => 'required|in:home,office,other',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'city_id' => 'required|string|max:100',
            'state_id' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'required|string|max:10',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'is_default' => 'nullable|boolean'
        ]);

        if ($request->is_default == 1) {
            CustomerAddresses::where('customer_id', $customer->id)
                ->update(['is_default' => 0]);
        }

        $address = CustomerAddresses::create([
            'customer_id' => $customer->id,
            'type' => $request->type,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'landmark' => $request->landmark,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'pincode' => $request->pincode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_default' => $request->is_default ?? 0,
            'status' => 1
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Address added successfully',
            'data' => $address
        ]);
    }


  public function getcustomeraddress(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 401,
                'message' => 'Token not provided'
            ], 401);
        }

        // Find customer by auth token
        $customer = Customers::where('auth', $token)
            ->where('status', 1)
            ->first();

        if (!$customer) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Get addresses
        $addresses = CustomerAddresses::where('customer_id', $customer->id)
            ->where('status', 1)
            ->orderByDesc('is_default')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Customer address retrieved successfully',
            'data' => $addresses
        ]);
    }


    public function editcustomeraddress(Request $request)
    {
        $customer = Auth::guard('customer_api')->user();

        if (!$customer) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $address = CustomerAddresses::where('id', $request->address_id)
            ->where('customer_id', $customer->id)
            ->first();

        if (!$address) {
            return response()->json([
                'status' => 404,
                'message' => 'Address not found'
            ], 404);
        }

        $request->validate([
            'type' => 'required|in:home,office,other',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'city_id' => 'required|string|max:100',
            'state_id' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'is_default' => 'nullable|boolean'
        ]);

        if ($request->is_default == 1) {
            CustomerAddresses::where('customer_id', $customer->id)
                ->update(['is_default' => 0]);
        }

        $address->update([
            'type' => $request->type,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'landmark' => $request->landmark,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'pincode' => $request->pincode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_default' => $request->is_default ?? 0,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Address updated successfully',
            'data' => $address
        ]);
    }



}
