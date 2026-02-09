<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\City;
use App\Models\ServicePartner;
use App\Models\State;

class AuthController extends Controller
{

  public function getstates()
    {
        $states = State::all()->map(function ($state) {
            return [
                'id' => $state->id,
                'state_name' => $state->state_name,
            ];
        });

        return response()->json([
            'status' => 200,
            'data' => $states
        ]);
    }


    public function getcityes(Request $request)
    {
        $stateId = $request->state_id;

        $cities = City::where('state_id', $stateId)
            ->get()
            ->map(function ($city) {
                return [
                    'id' => $city->id,
                    'city_name' => $city->city_name,
                ];
            });

        return response()->json([
            'status' => 200,
            'data' => $cities
        ]);
    }

    function register_partner(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'district' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        $partner = ServicePartner::created([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'status' => 0,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Partner registered successfully',
            'data' => $partner
        ]);
        
    }

}
