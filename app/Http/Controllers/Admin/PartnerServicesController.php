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
use App\Models\Services;
use App\Models\ServicesSe;
use App\Models\Th_Services;
use App\Models\Availability;
use App\Models\PartnerDocuments;
use App\Models\PartnerServices;
use App\Models\ServicePartner;

class PartnerServicesController extends Controller
{

    public function index(Request $request,$id)
    {
        $ServicePartner  = PartnerServices::where('partner_id',$id)->orderBy('id', 'DESC')->get();
        return view('admin.PartnerServices.index', compact('ServicePartner'));
    }


    public function updateCommission(Request $request, $id)
    {
        $request->validate([
            'commission_percentage' => 'required',
        ]);

        $service = PartnerServices::findOrFail($id);
        $service->commission_percentage = $request->commission_percentage;
        $service->save();

        return redirect()->back()->with('success', 'Commission updated successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $customer = PartnerServices::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
