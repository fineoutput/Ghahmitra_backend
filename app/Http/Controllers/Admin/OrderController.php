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
use App\Models\Wallet;
use App\Models\WalletTransactions;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $Order = Order::where('order_status',1)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order'));
    }

    public function acceptindex(Request $request)
    {
        $Order = Order::where('order_status',2)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order'));
    }
    
    public function completeindex(Request $request)
    {
        $Order = Order::where('order_status',3)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order'));
    }

    public function rejectindex(Request $request)
    {
        $Order = Order::where('order_status',4)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order'));
    }
    public function startindex(Request $request)
    {
        $Order = Order::where('order_status',5)->orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('Order'));
    }

    public function itemsindex($id)
    {
        $Order = OrderItems::where('order_id',$id)->orderBy('id', 'DESC')->get();
        return view('admin.order.orderItems.index', compact('Order'));
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
