<?php
namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(
    base_path('storage/app/firebase/grahmitra-partner-firebase-adminsdk-fbsvc-0e28f8e726.json')
);

        $this->messaging = $factory->createMessaging();
    }

  public function sendToTopic($title, $message, $topic, $image = null, $data = [])
{
    try {

        $notificationPayload = [
            'title' => $title,
            'body' => $message,
            'image' => $image,
        ];

        $dataPayload = array_merge([
            'image' => $image,
            'type' => $topic,
        ], $data);

        $cloudMessage = CloudMessage::withTarget('topic', strtolower($topic))
            ->withNotification($notificationPayload)
            ->withData($dataPayload);

        // ✅ Proper logging
        \Log::info('FCM Payload', [
            'notification' => $notificationPayload,
            'data' => $dataPayload,
            'topic' => strtolower($topic)
        ]);

        $response = $this->messaging->send($cloudMessage);

        // ✅ Response log
        \Log::info('FCM Success Response', [
            'response' => $response
        ]);

        return $response;

    } catch (\Exception $e) {

        \Log::error('FCM Send Error', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        throw $e; // controller ko bhi error mile
    }
}
}