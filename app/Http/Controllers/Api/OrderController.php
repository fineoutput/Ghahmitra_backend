<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\Customers;
use App\Models\LeaveReq;
use App\Models\Otp;
use App\Models\PartnerDocuments;
use App\Models\ServicePartner;
use App\Models\State;
use App\Models\TransferOrders;
use App\Models\UnverifiedCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        
}
