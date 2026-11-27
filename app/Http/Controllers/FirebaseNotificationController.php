<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FirebaseDeviceToken;

class FirebaseNotificationController extends Controller
{
    // notification code

    public function saveDeviceToken(Request $request)
    {
        if (!session()->has('id')) {
            return response()->json([
                'status' => false,
                'message' => 'Please login first.'
            ], 401);
        }

        $request->validate([
            'fcm_token' => 'required|string',
            'device_type' => 'nullable|string'
        ]);

        $userId = session('id');
        $userType = session('admin_type');

        // Only Admin and Staff
        if (!in_array(strtolower($userType), ['admin', 'staff'])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid user type.'
            ], 403);
        }

        // Check whether token already exists
        $deviceToken = FirebaseDeviceToken::updateOrCreate(
            [
                'fcm_token' => $request->fcm_token
            ],
            [
                'user_id' => $userId,
                'user_type' => strtolower($userType),
                'device_type' => $request->device_type ?? 'android'
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Device token saved successfully.'
        ]);
    }

    

}
