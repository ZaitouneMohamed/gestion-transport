<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PapierDueNotification extends Notification
{
    use Queueable;

    protected $papers;

    public function __construct($papers)
    {
        $this->papers = $papers;
    }
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Upcoming Papier Due Dates')
            ->line("Hello {$notifiable->name},") // Use user's name
            ->line('The following Papier entries are due soon:')
            ->line($this->papers->pluck('title')->implode(', '))
            ->action('View Papier', url('/papier'));
    }


    public function toDatabase($notifiable)
    {
        return [
            'papers' => $this->papers,
            'user_id' => $notifiable->id,
            'message' => 'You have upcoming Papier entries due soon.',
        ];
    }
}
