<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class NotificationController extends Controller
{

    function sendPushNotification($title, $message, $topic, $image = null)
    {
        $factory = (new Factory)->withServiceAccount(
                base_path(config('app.firebase_credentials'))
            );
        $messaging = $factory->createMessaging();

        $notification = FirebaseNotification::create($title, $message, $image);

        $message = CloudMessage::withTarget('topic', strtolower($topic))
            ->withNotification($notification);

        return $messaging->send($message);
    }

    public function index() {
        $data['notification'] = Notification::orderBy('id','DESC')->get();
        return view('admin.notification.index',$data);
    }

    public function create() {
        $data['notification'] = Notification::get();
        $data['tital'] = 'Notifications';
        return view('admin.notification.create',$data);
    }



   public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
            'topic' => 'required|in:Customer,Partner',
            'image' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 201,
                'message' => $validator->errors()->first()
            ]);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/notifications'), $imageName);

            $imagePath = 'uploads/notifications/' . $imageName;
        }

        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'topic' => $request->topic,
            'image' => $imagePath
        ]);

        $this->sendPushNotification(
            $request->title,
            $request->message,
            $request->topic,
            $imagePath ? url($imagePath) : null
        );

        return redirect()->route('notifications.index')->with('success','Notification Sent Successfully');
    }
    

}
