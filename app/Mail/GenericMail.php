<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $data;

    /**
     * Crea una nuova istanza del messaggio.
     */
    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Costruisce il messaggio.
     */
    public function build()
    {
        return $this->view($this->view)
                    ->with($this->data)
                    ->subject('Reset Password'); // puoi cambiare il subject
    }
}

