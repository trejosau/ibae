<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioCredenciales extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    public $password;
    public function __construct($usuario, $password)
    {
        $this->usuario = $usuario;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.credenciales')
            ->subject('Credenciales de usuario');
    }
}
