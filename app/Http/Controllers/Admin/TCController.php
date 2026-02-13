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
use App\Models\PrivacyPolicy;
use App\Models\TC;

class TCController extends Controller
{

    public function index(Request $request)
    {
        $AboutUs = TC::orderBy('id', 'DESC')->get();
        return view('admin.tc.index', compact('AboutUs'));
    }
    public function create(Request $request)
    {
        $tital =  'T & C';
        return view('admin.tc.create', compact('tital'));
    }

    public function edit($id)
    {
        $AboutUs = TC::findOrFail($id);
        $tital = 'T & C';

        return view('admin.tc.edit', compact('AboutUs', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = TC::findOrFail($id);

        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        $service->update([
            'title'        => $request->title,
            'content'        => $request->content,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('tc.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        TC::create([
            'title'        => $request->title,
            'content'        => $request->content,
            'status'      => 1,
        ]);

        return redirect()->route('tc.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = TC::findOrFail($id);

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = TC::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Banner not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', ' status updated successfully.');
    }


}
