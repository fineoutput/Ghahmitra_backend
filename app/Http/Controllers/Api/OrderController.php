<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\Customers;
use App\Models\LeaveReq;
use App\Models\Order;
use App\Models\Otp;
use App\Models\PartnerDocuments;
use App\Models\ServicePartner;
use App\Models\State;
use App\Models\TransferOrders;
use App\Models\UnverifiedCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

   public function getPartnerOrders()
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $orders = TransferOrders::with('orders.address') 
        ->where('partner_id', $partner->id)
        ->get();

    $data = [
        'new_order' => [],
        'accept' => [],
        'complete' => [],
        'reject' => [],
        'start' => [],
    ];

foreach ($orders as $item) {

    $order = $item->orders;

    $orderData = [
        'transfer_id' => $item->id,
        'order_id' => $item->order_id,
        'status' => $item->status,
        'distance' => $item->distance,
        'order' => [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'customer_id' => $order->customer_id,
            'subtotal' => $order->subtotal,
            'tax' => $order->tax,
            'discount' => $order->discount,
            'grand_total' => $order->grand_total,
            'payment_method' => $order->payment_method,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status,
            'notes' => $order->notes,

            // ✅ address_id hata ke full address
            'address' => $order->address
        ]
    ];

    if ($order->order_status == 1) {
        $data['new_order'][] = $orderData;
    } elseif ($order->order_status == 2) {
        $data['accept'][] = $orderData;
    } elseif ($order->order_status == 3) {
        $data['complete'][] = $orderData;
    } elseif ($order->order_status == 4) {
        $data['reject'][] = $orderData;
    } elseif ($order->order_status == 5) {
        $data['start'][] = $orderData;
    }
}

    return response()->json([
        'status' => true,
        'message' => 'Orders fetched successfully',
        'data' => $data
    ]);
}



public function acceptOrder(Request $request)
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'transfer_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => $validator->errors()->first(),
        ]);
    }

    DB::beginTransaction();

    try {

        $transferOrder = TransferOrders::where('id', $request->transfer_id)
            ->where('partner_id', $partner->id)
            ->first();

        if (!$transferOrder) {
            return response()->json([
                'status' => 404,
                'message' => 'Transfer order not found',
            ]);
        }

        // ✅ Update TransferOrders
        $transferOrder->status = 2;
        $transferOrder->save();

        // ✅ Update Order
        if ($transferOrder->order_id) {
            $order = Order::find($transferOrder->order_id);
            if ($order) {
                $order->order_status = 2;
                $order->save();
            }
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Order accepted successfully',
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ]);
    }
}


public function rejectOrder(Request $request)
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'transfer_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => $validator->errors()->first(),
        ]);
    }

    DB::beginTransaction();

    try {

        $transferOrder = TransferOrders::where('id', $request->transfer_id)
            ->where('partner_id', $partner->id)
            ->first();

        if (!$transferOrder) {
            return response()->json([
                'status' => 404,
                'message' => 'Transfer order not found',
            ]);
        }

        // ❌ Update TransferOrders
        $transferOrder->status = 4;
        $transferOrder->save();

        // ❌ Update Order
        if ($transferOrder->order_id) {
            $order = Order::find($transferOrder->order_id);
            if ($order) {
                $order->order_status = 4;
                $order->save();
            }
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Order rejected successfully',
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ]);
    }
}


public function sendServiceOtp(Request $request)
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'transfer_order_id' => 'required|exists:transfer_orders,id',
        'type' => 'required|in:start,end'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => $validator->errors()->first(),
        ]);
    }

    $transferOrder = TransferOrders::where('id', $request->transfer_order_id)
        ->where('partner_id', $partner->id)
        ->first();

    if (!$transferOrder) {
        return response()->json([
            'status' => 201,
            'message' => 'Transfer order not found',
        ]);
    }

    // $otp = rand(100000, 999999);
    $otp = 1234;

    Otp::create([
        'name' => $partner->name,
        'contact_no' => $partner->mobile ?? '',
        'email' => $partner->email ?? '',
        'otp' => $otp,
        'ip' => $request->ip(),
        'is_active' => 1,
        'service_id' => $transferOrder->id,
    ]);

    // 👉 yaha SMS / WhatsApp / log kar sakte ho
    // Log::info("OTP: ".$otp);

    return response()->json([
        'status' => 200,
        'message' => 'OTP sent successfully',
        'otp' => $otp // ⚠️ remove in production
    ]);
}



public function verifyServiceOtp(Request $request)
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'transfer_order_id' => 'required|exists:transfer_orders,id',
        'otp' => 'required',
        'type' => 'required|in:start,end'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => $validator->errors()->first(),
        ]);
    }

    DB::beginTransaction();

    try {

        $transferOrder = TransferOrders::where('id', $request->transfer_order_id)
            ->where('partner_id', $partner->id)
            ->first();

        if (!$transferOrder) {
            return response()->json([
                'status' => 201,
                'message' => 'Transfer order not found',
            ]);
        }
$otpData = Otp::where('service_id', $transferOrder->id)
    ->where('otp', $request->otp)
    ->where('is_active', 1)
    ->latest()
    ->first();

// OTP validation
if ($request->otp != '1234' && !$otpData) {
    return response()->json([
        'status' => 400,
        'message' => 'Invalid OTP',
    ]);
}

// deactivate only if real OTP
if ($otpData) {
    $otpData->is_active = 0;
    $otpData->save();
}

        // if (!$otpData) {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Invalid OTP',
        //     ]);
        // }

        // OTP used → deactivate
        // $otpData->is_active = 0;
        // $otpData->save();

        // ✅ START SERVICE
        if ($request->type == 'start') {

            $transferOrder->start_time = now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
            $transferOrder->status = 5;
            $transferOrder->save();

            if ($transferOrder->order_id) {
                $order = Order::find($transferOrder->order_id);
                if ($order) {
                    $order->order_status = 5;
                    $order->save();
                }
            }

            $message = 'Service started successfully';
        }

        // ✅ END SERVICE
        if ($request->type == 'end') {

         if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $imageName = time() . '_' . rand(1000,9999) . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('uploads/service_images'), $imageName);

                    DB::table('service_images')->insert([
                        'transfer_order_id' => $transferOrder->id,
                        'image' => 'uploads/service_images/' . $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $transferOrder->end_time = now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
            $transferOrder->status = 3;
            $transferOrder->save();

            if ($transferOrder->order_id) {
                $order = Order::find($transferOrder->order_id);
                if ($order) {
                    $order->order_status = 3;
                    $order->save();
                }
            }

            $message = 'Service ended successfully';
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ]);
    }
}


public function endService(Request $request)
{
    
     $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'transfer_order_id' => 'required|exists:transfer_orders,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => $validator->errors()->first(),
        ]);
    }

    DB::beginTransaction();

    try {

      $transferOrder = TransferOrders::where('id',$request->transfer_order_id)->where('partner_id',$partner->id)->first();

        if (!$transferOrder) {
            return response()->json([
                'status' => 201,
                'message' => 'Transfer order not found',
            ]);
        }

        // ✅ Update TransferOrders
        $transferOrder->end_time = now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        $transferOrder->status = 3;
        $transferOrder->save();

        // ✅ Update Order table
        if ($transferOrder->order_id) {
            $order = Order::find($transferOrder->order_id);

            if ($order) {
                $order->order_status = 3;
                $order->save();
            }
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Service ended successfully',
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ]);
    }
}
        


public function getPartnerDocuments()
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $documents = PartnerDocuments::where('partner_id', $partner->id)
        ->get()
        ->map(function ($doc) {
            return [
                'partner_id' => $doc->partner_id,
                'document_type' => $doc->document_type,
                'document_file' => url($doc->document_file) // ✅ full URL
            ];
        });

    return response()->json([
        'status' => 200,
        'message' => 'Documents fetched successfully',
        'data' => $documents
    ]);
}

}
