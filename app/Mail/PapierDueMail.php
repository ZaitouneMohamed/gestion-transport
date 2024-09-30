<?php

namespace App\Mail;

use App\Models\Papier;
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

    public function __construct(Papier $papier)
    {
        $this->papier = $papier;
    }
    public function build()
    {
        return $this->view('emails.papier_due')
            ->with(['papier' => $this->papier]);
    }
}
