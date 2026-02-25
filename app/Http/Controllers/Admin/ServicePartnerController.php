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
use App\Models\LeaveReq;
use App\Models\PartnerDocuments;
use App\Models\ServicePartner;

class ServicePartnerController extends Controller
{

    public function index(Request $request)
    {
        $ServicePartner  = ServicePartner::where('status',0)->orderBy('id', 'DESC')->get();
        return view('admin.ServicePartner.index', compact('ServicePartner'));
    }
    public function activeindex(Request $request)
    {
        $ServicePartner  = ServicePartner::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.ServicePartner.index', compact('ServicePartner'));
    }
  
    public function blockindex(Request $request)
    {
        $ServicePartner  = ServicePartner::where('status',2)->orderBy('id', 'DESC')->get();
        return view('admin.ServicePartner.index', compact('ServicePartner'));
    }
  
    public function document(Request $request,$id)
    {
        $ServicePartner  = PartnerDocuments::orderBy('id', 'DESC')->where('partner_id',$id)->get();
        return view('admin.ServicePartner.document.index', compact('ServicePartner'));
    }
  
    public function leaveindex(Request $request,$id)
    {
        $ServicePartner  = ServicePartner::find($id);
        $leaveReq = LeaveReq::orderBy('id', 'DESC')->where('partner_id', $id)->get();
        return view('admin.ServicePartner.leave.index', compact('leaveReq','ServicePartner'));
    }

    
    public function updaterank(Request $request, $id)
    {
        $request->validate([
            'rank' => 'required',
        ]);

        $service = ServicePartner::findOrFail($id);
        $service->rank = $request->rank;
        $service->save();

        return redirect()->back()->with('success', 'Rank updated successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $customer = ServicePartner::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
