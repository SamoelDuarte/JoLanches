<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserNotification extends Notification
{
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Esta é a sua notificação personalizada.',
        ]);
    }
}
