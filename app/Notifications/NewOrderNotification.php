<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    public function toBroadcast($notifiable)
    {
        return [
            'message' => 'Novo pedido recebido!',
        ];
    }
}
