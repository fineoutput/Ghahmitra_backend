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
use App\Models\Banner;

class BannerController extends Controller
{

    public function index(Request $request)
    {
        $Banner = Banner::orderBy('id', 'DESC')->get();
        return view('admin.Banner.index', compact('Banner'));
    }
    public function create(Request $request)
    {
        $tital =  'Banner';
        return view('admin.Banner.create', compact('tital'));
    }

    public function edit($id)
    {
        $Banner = Banner::findOrFail($id);
        $tital = 'Banner';

        return view('admin.Banner.edit', compact('Banner', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = Banner::findOrFail($id);

        $request->validate([
            'title'        => 'required',
            'type'        => 'required',
            'image'       => 'nullable',
        ]);

        if ($request->hasFile('image')) {

            // old image delete
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/Banner'), $imageName);
            $service->image = 'uploads/Banner/' . $imageName;
        }

        $service->update([
            'title'        => $request->title,
            'type'        => $request->type,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('Banner.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'type'        => 'required',
            'image'       => 'required',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/' . $imageName;
        }

        Banner::create([
            'title'        => $request->title,
            'type'        => $request->type,
            'image'       => $imagePath,
            'status'      => 1,
        ]);

        return redirect()->route('Banner.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = Banner::findOrFail($id);

        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Banner::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Banner not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'Banner status updated successfully.');
    }


}
