<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Premiosuser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $premiosuser;

    public function __construct($premiosuser)
    {
        $this->premiosuser = $premiosuser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.premio')

                    ->from('pedidos@sondemiga.com','SondeMiga.com')
                    ->subject('Premio Reclamado');
    }
}
