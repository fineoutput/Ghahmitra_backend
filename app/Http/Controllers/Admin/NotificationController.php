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
        $path = config('app.firebase_credentials') 
            ? base_path(config('app.firebase_credentials')) 
            : base_path('storage/app/firebase/grahmitra-partner-firebase-adminsdk-fbsvc-1d6e9ba7b1.json');

             if (!file_exists($path)) {
            throw new \Exception('Firebase JSON file not found: ' . $path);
        }


        $factory = (new Factory)->withServiceAccount($path);
            dd(config('app.firebase_credentials'));
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

    // ✅ Upload Image (public folder)
    $imagePath = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/notifications'), $imageName);

        $imagePath = 'uploads/notifications/' . $imageName;
    }

    // ✅ Save DB
    $notification = Notification::create([
        'title' => $request->title,
        'message' => $request->message,
        'topic' => $request->topic,
        'image' => $imagePath
    ]);

    try {

        // ✅ Firebase Setup (CONFIG BASED)
        $factory = (new Factory)->withServiceAccount(
            base_path(config('app.firebase_credentials'))
        );

        $messaging = $factory->createMessaging();

        // ✅ Full Image URL
        $imageUrl = $imagePath ? url($imagePath) : null;

        // ✅ Notification Payload
        $notificationPayload = [
            'title' => $request->title,
            'body' => $request->message,
            'image' => $imageUrl,
        ];

        // ✅ Data Payload (extra info)
        $dataPayload = [
            'image' => $imageUrl,
            'type' => $request->topic,
            'screen' => 'Notification'
        ];

        // ✅ Cloud Message
        $cloudMessage = CloudMessage::withTarget('topic', strtolower($request->topic))
            ->withNotification($notificationPayload)
            ->withData($dataPayload);

        // ✅ Send
        $messaging->send($cloudMessage);

        return redirect()->route('notifications.index')
            ->with('success', 'Notification sent successfully');

    } catch (\Exception $e) {

        \Log::error('FCM Error: ' . $e->getMessage());

        return redirect()->route('notifications.index')
            ->with('error', 'Firebase error: ' . $e->getMessage());
    }
}
    

}
