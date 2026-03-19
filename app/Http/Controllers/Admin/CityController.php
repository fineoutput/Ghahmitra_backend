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
use App\Models\ManualCity;
use App\Models\PrivacyPolicy;
use App\Models\TC;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $AboutUs = ManualCity::orderBy('id', 'DESC')->get();
        return view('admin.ManualCity.index', compact('AboutUs'));
    }
    public function create(Request $request)
    {
        $tital =  'City';
        return view('admin.ManualCity.create', compact('tital'));
    }

    public function edit($id)
    {
        $ManualCity = ManualCity::findOrFail($id);
        $tital = 'City';

        return view('admin.ManualCity.edit', compact('ManualCity', 'tital'));
    }


    public function update(Request $request, $id)
    {
        $service = ManualCity::findOrFail($id);

       $request->validate([
            'city_name'        => 'required',
            'pincode'        => 'required',
        ]);


        $service->update([
            'city_name'        => $request->city_name,
            'pincode'        =>  implode(',', $request->pincode),
            // 'status'      => $request->status,
        ]);

        return redirect()->route('city.index')->with('success', 'Record updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_name'        => 'required',
            'pincode'        => 'required',
        ]);


        ManualCity::create([
            'city_name'        => $request->city_name,
            'pincode'        =>  implode(',', $request->pincode),
            'status'      => 1,
        ]);

        return redirect()->route('city.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $service = ManualCity::findOrFail($id);

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = ManualCity::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Banner not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', ' status updated successfully.');
    }


}
