<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\Channel;
use Illuminate\Support\Facades\Http;

class HttpChannel extends Channel
{
    public function send($notifiable, Notification $notification)
    {
        $httpMessage = $notification->toHttp($notifiable);

        Http::withHeaders($httpMessage['headers'])
            ->{$httpMessage['method']}($httpMessage['url'], $httpMessage['data']);
    }
}
