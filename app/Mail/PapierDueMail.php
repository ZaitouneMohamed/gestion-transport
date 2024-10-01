<?php

namespace App\Mail;

use App\Models\Papier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PapierDueMail extends Mailable
{
    use Queueable, SerializesModels;

    public $papier;
    public $username;

    public function __construct(Papier $papier , $username)
    {
        $this->papier = $papier;
        $this->username = $username;
    }
    public function build()
    {
        return $this->view('Mail.papierNearToEnd')
            ->with(['papier' => $this->papier , "user" => $this->username ]);
    }
}
