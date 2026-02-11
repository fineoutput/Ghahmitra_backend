<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\Banner;
use App\Models\City;
use App\Models\Customers;
use App\Models\Otp;
use App\Models\ServicePartner;
use App\Models\Services;
use App\Models\ServicesSe;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function banner()
    {
        $banners = Banner::where('status', 1)->get();

        $banners = $banners->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'type' => $banner->type,
                'status' => $banner->status,
                'image_url' => $banner->image 
                    ? url($banner->image)
                    : null,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Banners retrieved successfully',
            'data' => $banners
        ]);
    }

  public function services()
    {
        $Services = Services::where('status', 1)->get();

        $Services = $Services->map(function ($Service) {
            return [
                'id' => $Service->id,
                'name' => $Service->name,
                'description' => strip_tags($Service->description),
                'image_url' => $Service->image 
                    ? url($Service->image)
                    : null,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Services retrieved successfully',
            'data' => $Services
        ]);
    }

    public function ServicesSe(Request $request)
        {
            $Services = ServicesSe::where('status', 1)
               ->where('services_id',$request->services_id)->get();

            $Services = $Services->map(function ($Service) {
                return [
                    'id' => $Service->id,
                    'name' => $Service->name,
                    'description' => strip_tags($Service->description),
                    'image_url' => $Service->image 
                        ? url($Service->image)
                        : null,
                ];
            });

            return response()->json([
                'status' => 200,
                'message' => 'Services retrieved successfully',
                'data' => $Services
            ]);
        }

}
