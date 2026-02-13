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
use App\Models\AboutUs;
use App\Models\Banner;

class AboutUsController extends Controller
{

    public function index(Request $request)
    {
        $AboutUs = AboutUs::orderBy('id', 'DESC')->get();
        return view('admin.AboutUs.index', compact('AboutUs'));
    }
    public function create(Request $request)
    {
        $tital =  'AboutUs';
        return view('admin.AboutUs.create', compact('tital'));
    }

    public function edit($id)
    {
        $AboutUs = AboutUs::findOrFail($id);
        $tital = 'AboutUs';

        return view('admin.AboutUs.edit', compact('AboutUs', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = AboutUs::findOrFail($id);

        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        $service->update([
            'title'        => $request->title,
            'content'        => $request->content,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('aboutUs.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        AboutUs::create([
            'title'        => $request->title,
            'content'        => $request->content,
            'status'      => 1,
        ]);

        return redirect()->route('aboutUs.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = AboutUs::findOrFail($id);

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = AboutUs::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Banner not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', ' status updated successfully.');
    }


}
