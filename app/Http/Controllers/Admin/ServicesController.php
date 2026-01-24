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

class ServicesController extends Controller
{

    public function index(Request $request)
    {
        $Services = Services::all();
        return view('admin.services.index', compact('Services'));
    }
    public function create(Request $request)
    {
        $tital =  'Services';
        return view('admin.services.create', compact('tital'));
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        $tital = 'Service';

        return view('admin.services.edit', compact('service', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = Services::findOrFail($id);

        $request->validate([
            'name'        => 'required',
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
            'description' => $request->description,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('services.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
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

        Services::create([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => 1,
        ]);

        return redirect()->route('services.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = Services::findOrFail($id);

        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Services::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
