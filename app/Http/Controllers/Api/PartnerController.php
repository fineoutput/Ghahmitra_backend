<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\Customers;
use App\Models\LeaveReq;
use App\Models\Otp;
use App\Models\PartnerDocuments;
use App\Models\ServicePartner;
use App\Models\State;
use App\Models\UnverifiedCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{

    public function deleteaccount(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();
    
        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }
    
        $partner->delete();
    
        return response()->json([
            'message' => 'Account deleted successfully',
            'status' => 200,
            ]);
    }


   public function document(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $request->validate([
            'document_type' => 'required|string',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('documents'), $filename);

        $document = PartnerDocuments::create([
            'partner_id'    => $partner->id,
            'document_type' => $request->document_type,
            'document_file' => 'documents/' . $filename,
            'status'        => 1,
        ]);

        return response()->json([
            'message' => 'Document uploaded successfully',
            'status' => 200,
            'data' => $document,
            'document_url' => url($document->document_file),
        ]);
    }


  public function updateProfile(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();

        if (!$partner) {
            return response()->json([
                'status' => 404,
                'message' => 'Partner not found'
            ]);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:service_partner,email,' . $partner->id,
            'phone' => 'required|regex:/^[0-9]{10}$/|unique:service_partner,phone,' . $partner->id,
            'address' => 'required',
            'district' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $partner->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'district' => $request->district,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Profile updated successfully',
                'data' => $partner
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }


public function getProfile()
{
    $partner = Auth::guard('partner_api')->user();

    if (!$partner) {
        return response()->json([
            'status' => 404,
            'message' => 'Partner not found'
        ]);
    }

    $data = collect([$partner])->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'phone' => $item->phone,
            'address' => $item->address,
            'district' => $item->district,
            'state_id' => $item->state_id,
            'city_id' => $item->city_id,
            'status' => $item->status,
            'rank' => $item->rank,
            'created_at' => $item->created_at,
        ];
    })->first(); // because single record

    return response()->json([
        'status' => 200,
        'message' => 'Profile fetched successfully',
        'data' => $data
    ]);
}



    public function LeaveReq(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $request->validate([
            'description' => 'required|string',
        ]);

        $leaveReq = LeaveReq::create([
            'partner_id' => $partner->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json([
            'message' => 'Leave request submitted successfully',
            'status' => 200,
            'data' => $leaveReq,
        ]);
    }



    public function getLeaveReq(Request $request)
    {
        $partner = Auth::guard('partner_api')->user();

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $leaveReqs = LeaveReq::where('partner_id', $partner->id)->get();

        return response()->json([
            'message' => 'Leave requests fetched successfully',
            'status' => 200,
            'data' => $leaveReqs,
        ]);
    }

        
}
