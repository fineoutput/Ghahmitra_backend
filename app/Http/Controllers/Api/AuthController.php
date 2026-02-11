<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\Customers;
use App\Models\Otp;
use App\Models\ServicePartner;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  public function getstates()
    {
        $states = State::all()->map(function ($state) {
            return [
                'id' => $state->id,
                'state_name' => $state->state_name,
            ];
        });

        return response()->json([
            'status' => 200,
            'data' => $states
        ]);
    }


    public function getcityes(Request $request)
    {
        $stateId = $request->state_id;

        $cities = City::where('state_id', $stateId)
            ->get()
            ->map(function ($city) {
                return [
                    'id' => $city->id,
                    'city_name' => $city->city_name,
                ];
            });

        return response()->json([
            'status' => 200,
            'data' => $cities
        ]);
    }

    function register_partner(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:service_partner,email',
            'phone' => 'required|unique:service_partner,phone|regex:/^[0-9]{10}$/',
            'address' => 'required',
            'district' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        $partner = ServicePartner::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'status' => 0,
            'rank' => 1,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Partner registered successfully',
            'data' => $partner
        ]);
        
    }

    public function Partnerlogin(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|regex:/^[0-9]{10}$/'
        ]);

        $partner = ServicePartner::where('phone', $request->contact_no)->first();

        if (!$partner) {
            return response()->json([
                'status' => 404,
                'message' => 'Partner not registered'
            ], 404);
        }

        if ($partner->status != 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Account not approved'
            ], 403);
        }

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['contact_no' => $request->contact_no],
            [
                'name' => $partner->name,
                'email' => $partner->email,
                'otp' => $otp,
                'ip' => $request->ip(),
                'is_active' => 1,
                'date' => now()
            ]
        );


        return response()->json([
            'status' => 200,
            'message' => 'OTP sent successfully',
            'otp' => $otp 
        ]);
    }


   public function verifyPartnerOtp(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|regex:/^[0-9]{10}$/',
            'otp' => 'required|digits:6'
        ]);

        $otpRow = Otp::where('contact_no', $request->contact_no)
            ->where('otp', $request->otp)
            ->where('is_active', 1)
            ->first();

        if (!$otpRow) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        $partner = ServicePartner::where('phone', $request->contact_no)
            ->where('status', 1)
            ->first();

        if (!$partner) {
            return response()->json([
                'status' => 404,
                'message' => 'Partner not found'
            ], 404);
        }

        $authToken = Str::random(64);
        $partner->update(['auth' => $authToken]);
        $otpRow->update(['is_active' => 0]);


        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'data' => [
                'partner_id' => $partner->id,
                'name' => $partner->name,
                'phone' => $partner->phone,
                'token' => $authToken
            ]
        ]);
    }

   function logoutPartner(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();

        if ($partner) {
            $partner->update(['auth' => null]);

            return response()->json([
                'status' => 200,
                'message' => 'Logout successful'
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    public function register_customer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'mobile_no' => 'required|unique:customers,mobile_no|regex:/^[0-9]{10}$/',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle Image Upload
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('customer_images'), $imageName);
        }

        $customer = Customers::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'status' => 1,
            'image' => $imageName
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Customer registered successfully',
            'data' => $customer
        ]);
    }



        public function customerslogin(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|regex:/^[0-9]{10}$/'
        ]);

        $Customers = Customers::where('mobile_no', $request->contact_no)->first();

        if (!$Customers) {
            return response()->json([
                'status' => 404,
                'message' => 'Customers not registered'
            ], 404);
        }

        if ($Customers->status != 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Account not approved'
            ], 403);
        }

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['contact_no' => $request->contact_no],
            [
                'name' => $Customers->name,
                'email' => $Customers->email,
                'otp' => $otp,
                'ip' => $request->ip(),
                'is_active' => 1,
                'date' => now()
            ]
        );


        return response()->json([
            'status' => 200,
            'message' => 'OTP sent successfully',
            'otp' => $otp 
        ]);
    }


   public function verifycustomersOtp(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|regex:/^[0-9]{10}$/',
            'otp' => 'required|digits:6'
        ]);

        $otpRow = Otp::where('contact_no', $request->contact_no)
            ->where('otp', $request->otp)
            ->where('is_active', 1)
            ->first();

        if (!$otpRow) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        $Customers = Customers::where('mobile_no', $request->contact_no)
            ->where('status', 1)
            ->first();

        if (!$Customers) {
            return response()->json([
                'status' => 404,
                'message' => 'Customers not found'
            ], 404);
        }

        $authToken = Str::random(64);
        $Customers->update(['auth' => $authToken]);
        $otpRow->update(['is_active' => 0]);


        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'data' => [
                'partner_id' => $Customers->id,
                'name' => $Customers->name,
                'phone' => $Customers->phone,
                'token' => $authToken
            ]
        ]);
    }

    function logoutCustomer(Request $request)
     {
          $customer = Auth::guard('customer_api')->user();
    
          if ($customer) {
                $customer->update(['auth' => null]);
    
                return response()->json([
                 'status' => 200,
                 'message' => 'Logout successful'
                ]);
          } else {
                return response()->json([
                 'status' => 401,
                 'message' => 'Unauthorized'
                ], 401);
          }
     }

  public function customerProfile(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 401,
                'message' => 'Token not provided'
            ], 401);
        }

        $customer = Customers::where('auth', $token)
            ->where('status', 1)
            ->first();

        if (!$customer) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'status' => 200,
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'mobile_no' => $customer->mobile_no,
                'image' => $customer->image,
                'image_url' => $customer->image 
                    ? url('customer_images/' . $customer->image) 
                    : null,
                'status' => $customer->status,
            ]
        ]);
    }


    public function updateCustomerProfile(Request $request)
    {
        $customer = Auth::guard('customer_api')->user();

                if (!$customer) {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Unauthorized'
                    ], 401);
                }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'mobile_no' => 'required|regex:/^[0-9]{10}$/|unique:customers,mobile_no,' . $customer->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            if ($customer->image && file_exists(public_path('customer_images/' . $customer->image))) {
                unlink(public_path('customer_images/' . $customer->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('customer_images'), $imageName);

            $customer->image = $imageName;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'mobile_no' => $customer->mobile_no,
                'image' => $customer->image,
                'image_url' => $customer->image 
                    ? url('customer_images/' . $customer->image)
                    : null,
                'status' => $customer->status,
            ]
        ]);
    }



        public function deleteaccount(Request $request)
        {
            $customer = Auth::guard('customer_api')->user();
        
            if ($customer) {
                    $customer->delete();
                    return response()->json([
                    'status' => 200,
                    'message' => 'Account deleted successfully'
                    ]);
            } else {
                    return response()->json([
                    'status' => 401,
                    'message' => 'Unauthorized'
                    ], 401);
            }
        }


    
}
