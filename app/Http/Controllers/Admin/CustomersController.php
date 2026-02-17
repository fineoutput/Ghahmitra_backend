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
use App\Models\Wallet;
use App\Models\WalletTransactions;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customers::where('status',0)->orderBy('id', 'DESC')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function feedback(Request $request)
    {
        $Feedback = Feedback::orderBy('id', 'DESC')->get();
        return view('admin.Feedback.index', compact('Feedback'));
    }

    public function activeindex(Request $request)
    {
        $customers = Customers::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function wallethistory(Request $request,$id)
    {
        $data['WalletTransactions'] = WalletTransactions::where('user_id',$id)->orderBy('id', 'DESC')->get();
        $data['Wallet'] = Wallet::where('user_id',$id)->orderBy('id', 'DESC')->first();
        return view('admin.customers.wallet', $data);
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
