<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PapierDueNotification extends Notification
{
    use Queueable;

    protected $papier;

    public function __construct($papier)
    {
        $this->papier = $papier;
    }
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'paper_id' => $this->papier->id,
            'message' => 'You have a Papier entry due soon: ' . $this->papier->title,
        ];
    }
}
