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

class PrivacyPolicyController extends Controller
{

    public function index(Request $request)
    {
        $AboutUs = PrivacyPolicy::orderBy('id', 'DESC')->get();
        return view('admin.PrivacyPolicy.index', compact('AboutUs'));
    }
    public function create(Request $request)
    {
        $tital =  'PrivacyPolicy';
        return view('admin.PrivacyPolicy.create', compact('tital'));
    }

    public function edit($id)
    {
        $AboutUs = PrivacyPolicy::findOrFail($id);
        $tital = 'PrivacyPolicy';

        return view('admin.PrivacyPolicy.edit', compact('AboutUs', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = PrivacyPolicy::findOrFail($id);

        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        $service->update([
            'title'        => $request->title,
            'content'        => $request->content,
            // 'status'      => $request->status,
        ]);

        return redirect()->route('PrivacyPolicy.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'content'        => 'required',
        ]);


        PrivacyPolicy::create([
            'title'        => $request->title,
            'content'        => $request->content,
            'status'      => 1,
        ]);

        return redirect()->route('PrivacyPolicy.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = PrivacyPolicy::findOrFail($id);

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = PrivacyPolicy::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Banner not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', ' status updated successfully.');
    }


}
