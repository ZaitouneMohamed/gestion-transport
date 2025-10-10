<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PapierDueMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Collection $papiers ,public $username)
    {
    }
    public function build()
    {
        return $this->subject('📅 Alertes : papiers proches de leur expiration')
                    ->view('Mail.papierNearToEnd')
                    ->with(['papiers' => $this->papiers , "user" => $this->username ]);
    }
}
