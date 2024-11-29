<?php

// app/Mail/TicketEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;

    // Constructor que recibe el PDF
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    // Construcción del correo electrónico
    public function build()
    {
        return $this->subject('Ticket de Compra')
            ->view('emails.ticket')  // Vista del correo
            ->attachData($this->pdf->output(), 'ticket.pdf', [
                'mime' => 'application/pdf', // Especificar el tipo MIME
            ]);
    }
}
