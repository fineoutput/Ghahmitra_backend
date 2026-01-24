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

class Services2Controller extends Controller
{

    public function index(Request $request)
    {
        $Services = ServicesSe::all();
        return view('admin.services2.index', compact('Services'));
    }
    public function create(Request $request)
    {
        $data['service'] = Services::where('status', 1)->get();
        $data['tital'] =  'Services 2';
        return view('admin.services2.create', $data);
    }

    public function edit($id)
    {
        $services  = Services::where('status', 1)->get();
        $ServicesSe = ServicesSe::findOrFail($id);
        $tital = 'Service 2';

        return view('admin.services2.edit', compact('services','ServicesSe', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = ServicesSe::findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'services_id'        => 'required',
            'description' => 'nullable',
            'image'       => 'nullable',
        ]);

        if ($request->hasFile('image')) {

            // old image delete
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = 'uploads/services/' . $imageName;
        }

        $service->update([
            'name'        => $request->name,
            'services_id'        => $request->services_id,
            'description' => $request->description,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('services2.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'services_id'        => 'required',
            'description' => 'nullable',
            'image'       => 'required',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/' . $imageName;
        }

        ServicesSe::create([
            'name'        => $request->name,
            'services_id'        => $request->services_id,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => 1,
        ]);

        return redirect()->route('services2.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = ServicesSe::findOrFail($id);

        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = ServicesSe::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
