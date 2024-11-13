<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class CredencialesEstudiantesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $password;

    public function __construct( $usuario, $password)
    {
        $this->usuario = $usuario;
        $this->password = $password;
    }

    
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.credenciales',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }


    public function build()
    {
        return $this->view('emails.credenciales')
                    ->subject('Instrucciones para cambiar tu contraseña');
                  
    }
}
