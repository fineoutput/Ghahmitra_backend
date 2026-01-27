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

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customers::orderBy('id', 'DESC')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Customers::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'Customer status updated successfully.');
    }


}
