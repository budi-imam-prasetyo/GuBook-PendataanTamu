<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FotoTamuSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $kedatanganTamu;

    public function __construct($kedatanganTamu)
    {
        $this->kedatanganTamu = $kedatanganTamu;
    }

    public function build()
    {
        return $this->subject('Foto Tamu Berhasil Dikirim')
        ->view('mails.fotoTamu')
        ->with(['kedatangan_tamu' => $this->kedatanganTamu]);
    }
}