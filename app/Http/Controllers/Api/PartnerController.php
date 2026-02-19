<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\Customers;
use App\Models\Otp;
use App\Models\PartnerDocuments;
use App\Models\ServicePartner;
use App\Models\State;
use App\Models\UnverifiedCustomer;
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
        
}
