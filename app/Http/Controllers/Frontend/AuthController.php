<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Otp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function sendOtp(Request $request)
{
    $request->validate([
        'mobile_no' => 'required|regex:/^[0-9]{10}$/'
    ]);

    // $otp = rand(100000, 999999);
    $otp = 123456;

    Otp::where('contact_no', $request->mobile_no)->delete();

    Otp::create([
        'contact_no' => $request->mobile_no,
        'name' => null,
        'email' => null,
        'otp' => $otp,
        'ip' => $request->ip(),
        'is_active' => 1,
        'date' => now()
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'OTP sent successfully'
    ]);
}

    // VERIFY OTP
    public function verifyRegisterOtp (Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|regex:/^[0-9]{10}$/',
            'otp' => 'required|digits:6'
        ]);

        $otpRow = Otp::where('contact_no', $request->mobile_no)
            ->where('otp', $request->otp)
            ->where('is_active', 1)
            ->first();

        if (!$otpRow) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid or expired OTP'
            ]);
        }

        $otpRow->update(['is_active' => 0]);

        // Check existing customer
        $customer = Customers::where('mobile_no', $request->mobile_no)->first();

        if (!$customer) {
            $customer = Customers::create([
                'name' => null,
                'email' => null,
                'mobile_no' => $request->mobile_no,
                'status' => 1,
                // 'auth' => Str::random(64)
            ]);
        } else {
            $customer->update([
                'auth' => Str::random(64)
            ]);
        }

        // ✅ Store Login Session (Web Login)
        Auth::guard('customer')->login($customer);

        return response()->json([
            'status' => 200,
            'message' => 'Login successful'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        // Optional: Clear session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ya JSON response
        return redirect()->back()->with('success', 'Logged out successfully');
    }

}
