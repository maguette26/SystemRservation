<?php
use App\Notifications\Channels\HttpChannel;
use Illuminate\Notifications\Notification;

class ReservationStatusNotification extends Notification
{
    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return [HttpChannel::class];
    }

    public function toHttp($notifiable)
    {
        return [
            'url' => 'http://localhost:3000/api/notifications',
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'data' => [
                'reservationId' => $this->reservation->id,
                'status' => $this->reservation->status,
            ],
        ];
    }
}
