<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\ActivityNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function sendActivityNotification()
    {
        $userSchema = User::find(auth()->user()->id);

        $offerData = [
            'name' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($userSchema, new ActivityNotification($offerData));

        dd('Task completed!');
    }

    public function getAllActivityNotification()
    {
        $notifications = json_decode(auth()->user()->unreadNotifications);
        return response()->json($notifications);
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
