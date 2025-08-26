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
    use SerializesModels;

    public function __construct(public Papier $papier ,public $username)
    {
    }
    public function build()
    {
        return $this->view('Mail.papierNearToEnd')
            ->with(['papier' => $this->papier , "user" => $this->username ]);
    }
}
