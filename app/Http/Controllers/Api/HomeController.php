<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminmodel\Team;
use App\Models\AboutUs;
use App\Models\Availability;
use App\Models\Banner;
use App\Models\City;
use App\Models\Customers;
use App\Models\Otp;
use App\Models\PrivacyPolicy;
use App\Models\ServicePartner;
use App\Models\Services;
use App\Models\ServicesSe;
use App\Models\State;
use App\Models\TC;
use App\Models\Th_Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


public function homeData()
{
    $services = Services::where('status', 1)->get()->map(function ($service) {

        $servicesSe = ServicesSe::where('status', 1)
            ->where('services_id', $service->id)
            ->get()
            ->map(function ($serviceSe) {

                $servicesTh = Th_Services::where('status', 1)
                    ->where('services_se_id', $serviceSe->id)
                    ->get()
                    ->map(function ($serviceTh) {

                        $images = [];

                        if (!empty($serviceTh->image) && is_array($serviceTh->image)) {
                            $images = array_map(function ($img) {
                                return url($img);
                            }, $serviceTh->image);
                        }

                        return [
                            'id' => $serviceTh->id,
                            'name' => $serviceTh->name,
                            'description' => strip_tags($serviceTh->description),
                            'description_2' => strip_tags($serviceTh->description_2),
                            'description_3' => strip_tags($serviceTh->description_3),
                            'price' => $serviceTh->price,
                            'mrp' => $serviceTh->mrp,
                            'images' => $images,
                        ];
                    });

                return [
                    'id' => $serviceSe->id,
                    'name' => $serviceSe->name,
                    'description' => strip_tags($serviceSe->description),
                    'image_url' => $serviceSe->image 
                        ? url($serviceSe->image)
                        : null,
                    'third_services' => $servicesTh
                ];
            });

        return [
            'id' => $service->id,
            'name' => $service->name,
            'description' => strip_tags($service->description),
            'image_url' => $service->image 
                ? url($service->image)
                : null,
            'second_services' => $servicesSe
        ];
    });

    $banners = Banner::where('status', 1)->get()->map(function ($banner) {
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
        'message' => 'Home data retrieved successfully',
        'services' => $services,
        'banners' => $banners
    ]);
}


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

  public function ServicesTh(Request $request)
    {
        $Services = Th_Services::where('status', 1)
            ->where('services_se_id', $request->services_se_id)
            ->get();

        $Services = $Services->map(function ($Service) {

            $images = [];

            if (!empty($Service->image) && is_array($Service->image)) {
                $images = array_map(function ($img) {
                    return url($img);
                }, $Service->image);
            }

            return [
                'id' => $Service->id,
                'name' => $Service->name,
                'description' => strip_tags($Service->description),
                'description_2' => strip_tags($Service->description_2),
                'description_3' => strip_tags($Service->description_3),
                'price' => $Service->price,
                'mrp' => $Service->mrp,
                'images' => $images,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Services retrieved successfully',
            'data' => $Services
        ]);
    }

    
public function ServicesDetails(Request $request)
{
    $service = Th_Services::where('status', 1)
        ->where('id', $request->services_id)
        ->first();

    if (!$service) {
        return response()->json([
            'status' => 404,
            'message' => 'Service not found',
            'data' => null
        ]);
    }

    $serviceavailability = Availability::where('services_id', $request->services_id)
        ->where('status', 1)
        ->get();

    $images = [];

    if (!empty($service->image) && is_array($service->image)) {
        $images = array_map(function ($img) {
            return url($img);
        }, $service->image);
    }

    $availabilityArray = $serviceavailability->map(function ($item) {
        return [
            'id' => $item->id,
            'day' => $item->day ?? null,
            'start_time' => $item->start_time ?? null,
            'end_time' => $item->end_time ?? null,
            'description' => strip_tags($item->description) ?? null,
        ];
    });

    $data = [
        'id' => $service->id,
        'name' => $service->name,
        'description' => strip_tags($service->description),
        'description_2' => strip_tags($service->description_2),
        'description_3' => strip_tags($service->description_3),
        'price' => $service->price,
        'mrp' => $service->mrp,
        'images' => $images,
        'availability' => $availabilityArray, // 👈 Added here
    ];

    return response()->json([
        'status' => 200,
        'message' => 'Service retrieved successfully',
        'data' => $data
    ]);
}

    public function aboutUs()
    {
        $aboutUs = AboutUs::where('status', 1)->first();

        if (!$aboutUs) {
            return response()->json([
                'status' => 404,
                'message' => 'About Us information not found',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'About Us retrieved successfully',
            'data' => [
                'id' => $aboutUs->id,
                'title' => $aboutUs->title,
                'content' => strip_tags($aboutUs->content),
            ]
        ]);
    }

    public function PrivacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::where('status', 1)->first();

        if (!$privacyPolicy) {
            return response()->json([
                'status' => 404,
                'message' => 'Privacy Policy information not found',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Privacy Policy retrieved successfully',
            'data' => [
                'id' => $privacyPolicy->id,
                'title' => $privacyPolicy->title,
                'content' => strip_tags($privacyPolicy->content),
            ]
        ]);
    }


    public function tc()
    {
        $tc = TC::where('status', 1)->first();

        if (!$tc) {
            return response()->json([
                'status' => 404,
                'message' => 'Terms & Conditions information not found',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Terms & Conditions retrieved successfully',
            'data' => [
                'id' => $tc->id,
                'title' => $tc->title,
                'content' => strip_tags($tc->content),
            ]
        ]);
    }



  public function servicesavAvailability(Request $request)
    {
        $serviceId = $request->input('service_id');

        $availability = Availability::where('services_id', $serviceId)
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                return [
                    'availability_id' => $item->id,
                    'day' => $item->day,
                    'start_time' => $item->start_time,
                    'end_time' => $item->end_time,
                    'description' => strip_tags($item->description),
                    'is_active' => $item->status,
                ];
            });

        return response()->json([
            'status' => 200,
            'message' => 'Service availability checked successfully',
            'data' => $availability,
        ]);
    }

}
