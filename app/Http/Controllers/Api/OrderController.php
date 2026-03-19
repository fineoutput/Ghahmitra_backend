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
use Illuminate\Validation\Validator;

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

    $orders = TransferOrders::with('order') 
        ->where('partner_id', $partner->id)
        ->get();

    $data = [
        'new_order' => [],
        'accept' => [],
        'complete' => [],
        'reject' => []
    ];

    foreach ($orders as $item) {

        $orderData = [
            'transfer_id' => $item->id,
            'order_id' => $item->order_id,
            'status' => $item->status,
            'distance' => $item->distance,
            'order' => $item->order // Order table ka data
        ];

        if ($item->order->status == 1) {
            $data['new_order'][] = $orderData;
        } elseif ($item->order->status == 2) {
            $data['accept'][] = $orderData;
        } elseif ($item->order->status == 3) {
            $data['complete'][] = $orderData;
        } elseif ($item->order->status == 4) {
            $data['reject'][] = $orderData;
        }
    }

    return response()->json([
        'status' => true,
        'message' => 'Orders fetched successfully',
        'data' => $data
    ]);
}


public function startService(Request $request)
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

        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Service started successfully',
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
        
}
