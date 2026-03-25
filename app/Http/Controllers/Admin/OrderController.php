<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\adminmodel\AdminSidebar;
use App\adminmodel\AdminSidebar2;
use App\adminmodel\Order1Modal;
use App\adminmodel\UserModal;
use App\adminmodel\CategoryModal;
use App\adminmodel\ProductModal;
use App\Models\Customers;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ServicePartner;
use App\Models\Wallet;
use App\Models\WalletTransactions;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $Order = Order::with('transferOrder')->where('order_status',1)->orderBy('id', 'DESC')->get();
        $servicePartner = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order','servicePartner'));
    }

    public function acceptindex(Request $request)
    {
        $Order = Order::with('transferOrder')->where('order_status',2)->orderBy('id', 'DESC')->get();
            $servicePartner = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order','servicePartner'));
    }
    
    public function completeindex(Request $request)
    {
        $Order = Order::with('transferOrder')->where('order_status',3)->orderBy('id', 'DESC')->get();
            $servicePartner = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order','servicePartner'));
    }

    public function rejectindex(Request $request)
    {
        $Order = Order::with('transferOrder')->where('order_status',4)->orderBy('id', 'DESC')->get();
            $servicePartner = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order','servicePartner'));
    }
    public function startindex(Request $request)
    {
        $Order = Order::with('transferOrder')->where('order_status',5)->orderBy('id', 'DESC')->get();
            $servicePartner = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order','servicePartner'));
    }

    public function itemsindex($id)
    {
        $Order = OrderItems::where('order_id',$id)->orderBy('id', 'DESC')->get();
        return view('admin.order.orderItems.index', compact('Order'));
    }


    public function assignPartner(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->transferOrder()->delete();
        
        if ($request->partner_id) {
            $order->transferOrder()->create([
                'partner_id' => $request->partner_id,
                'order_id' => $id,
                'status' => 1,
                'start_time' =>now(),
                'end_time' =>  null,
                'distance' => 0,
            ]);
        }

        return back()->with('success', 'Partner assigned successfully');
    }


       public function updateStatus(Request $request, $id)
    {
        $customer = Order::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $customer->order_status = $request->order_status;
        $customer->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }




}
