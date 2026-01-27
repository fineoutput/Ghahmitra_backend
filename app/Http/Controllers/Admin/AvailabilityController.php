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

class AvailabilityController extends Controller
{

    public function index(Request $request, $id)
    {
        $Availability  = Availability::where('services_id', $id)->orderBy('id', 'DESC')->get();
        $thservices = Th_Services::findOrFail($id);
        return view('admin.Availability.index', compact('Availability','thservices'));
    }
    public function create(Request $request,$id)
    {
        $data['services'] = Services::where('status', 1)->get();
        $data['thservices'] = Th_Services::findOrFail($id);
        $data['tital'] =  'Availability Create';
        return view('admin.Availability.create', $data);
    }

    public function edit($id)
    {
        $data['services']  = Services::where('status', 1)->get();
        $data['servicesSe']  = ServicesSe::where('status', 1)->get();
        $data['Availability'] = Availability::findOrFail($id);
        $data['tital'] = 'Availability';

        return view('admin.Availability.edit', $data);
    }


  public function update(Request $request, $id)
    {
        $service = Availability::findOrFail($id);

       $request->validate([
            'day'        => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable',
        ]);

        $service->update([
            'day'        => $request->day,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'services_id' => $id,
            'description' => $request->description,
        ]);

        return redirect()->route('availability.index',$id)
            ->with('success', 'Record updated successfully.');
    }



  public function store(Request $request,$id)
    {
        $request->validate([
            'day'        => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable',
        ]);

        Availability::create([
            'day'        => $request->day,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'services_id' => $id,
            'description' => $request->description,
            'status'      => 1,
        ]);

        return redirect()->route('availability.index',$id)
                        ->with('success', 'Record added successfully.');
    }


    public function destroy($id)
    {
        $service = Availability::findOrFail($id);

        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Availability::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
