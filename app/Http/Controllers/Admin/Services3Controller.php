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

class Services3Controller extends Controller
{

    public function index(Request $request)
    {
        $services  = Th_Services::orderBy('id', 'DESC')->get();
        return view('admin.services3.index', compact('services'));
    }
    public function create(Request $request)
    {
        $data['services'] = Services::where('status', 1)->get();
        $data['ServicesSe'] = ServicesSe::where('status', 1)->get();
        $data['tital'] =  'Services 3';
        return view('admin.services3.create', $data);
    }

    public function edit($id)
    {
        $data['services']  = Services::where('status', 1)->get();
        $data['servicesSe']  = ServicesSe::where('status', 1)->get();
        $data['thservices'] = Th_Services::findOrFail($id);
        $data['tital'] = 'Service 3';

        return view('admin.services3.edit', $data);
    }

    public function getServicesSe(Request $request)
    {
        $servicesSe = ServicesSe::where('services_id', $request->service_id)
                                ->where('status', 1)
                                ->get(['id', 'name']);
        return response()->json($servicesSe);
    }


  public function update(Request $request, $id)
    {
        $service = Th_Services::findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'services_se_id' => 'required',
            'services_id' => 'required',
            'price'       => 'required',
            'mrp'         => 'required',
            'commission_percentage' => 'required',
            'description' => 'nullable',
        ]);

        // Existing images (JSON → array)
        $existingImages = $service->image ?? [];

        // New images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services'), $imageName);
                $existingImages[] = 'uploads/services/' . $imageName;
            }
        }

        $service->update([
            'name'        => $request->name,
            'services_se_id' => $request->services_se_id,
            'price'       => $request->price,
            'mrp'         => $request->mrp,
            'commission_percentage' => $request->commission_percentage,
            'services_id' => $request->services_id,
            'description' => $request->description,
            'image'       => $existingImages, // auto JSON via cast
        ]);

        return redirect()
            ->route('services3.index')
            ->with('success', 'Record updated successfully.');
    }


public function deleteImage($id, $imageName)
{
    $service = Th_Services::findOrFail($id);

    // Existing images array
    $images = is_array($service->image) ? $service->image : json_decode($service->image, true);

    $imagePath = 'uploads/services/' . $imageName;

    if (($key = array_search($imagePath, $images)) !== false) {
        unset($images[$key]); // remove from array
        // Delete physical file
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }

    $service->update([
        'image' => $images
    ]);

    return redirect()->back()->with('success', 'Image deleted successfully.');
}



  public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'services_se_id' => 'required',
            'services_id' => 'required',
            'price'       => 'required',
            'mrp'         => 'required',
            'commission_percentage' => 'required',
            'description' => 'nullable',
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services'), $imageName);
                $imagePaths[] = 'uploads/services/' . $imageName;
            }
        }

        Th_Services::create([
            'name'        => $request->name,
            'services_se_id' => $request->services_se_id,
            'price'       => $request->price,
            'mrp'         => $request->mrp,
            'commission_percentage' => $request->commission_percentage,
            'services_id' => $request->services_id,
            'description' => $request->description,
            'image'       => json_encode($imagePaths),
            'status'      => 1,
        ]);

        return redirect()->route('services3.index')
                        ->with('success', 'Record added successfully.');
    }


    public function destroy($id)
    {
        $service = Th_Services::findOrFail($id);

        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = Th_Services::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'services not found.');
        }

        $customer->status = $request->status;
        $customer->save();

        return redirect()->back()->with('success', 'services status updated successfully.');
    }


}
