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
use App\Models\Slots;

class SlotController extends Controller
{

    public function index(Request $request, $id)
    {
        $Slots  = Slots::where('day_id', $id)->orderBy('id', 'DESC')->get();
        $thservices = Availability::findOrFail($id);
        return view('admin.Availability.slot.index', compact('Slots','thservices'));
    }
    public function create(Request $request,$id)
    {
        $data['services'] = Services::where('status', 1)->get();
        $data['thservices'] = Availability::findOrFail($id);
        $data['tital'] =  'Slot Create';
        return view('admin.Availability.slot.create', $data);
    }

    public function edit($id)
    {
        $data['services']  = Services::where('status', 1)->get();
        $data['servicesSe']  = ServicesSe::where('status', 1)->get();
        $data['Availability'] = Slots::findOrFail($id);
        $data['tital'] = 'Slot';

        return view('admin.Availability.slot.edit', $data);
    }


  public function update(Request $request, $id)
    {
        $service = Slots::findOrFail($id);

       $request->validate([
            // 'day'        => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable',
        ]);

        $service->update([
            'day_id'        => $service->day_id,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
        ]);

        return redirect()->route('slot.index',$service->day_id)
            ->with('success', 'Record updated successfully.');
    }



  public function store(Request $request,$id)
    {
        $request->validate([
            // 'day'        => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable',
        ]);

        Slots::create([
            'day_id'        => $request->day_id,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'status'      => 1,
        ]);

        return redirect()->route('slot.index',$id)
                        ->with('success', 'Record added successfully.');
    }


    public function destroy($id)
    {
        $service = Slots::findOrFail($id);


        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Slots::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
