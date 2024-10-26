<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendToTamu extends Mailable
{
    use Queueable, SerializesModels;

    public $kedatangan;
    public $tamu;

    public function __construct($kedatangan, $tamu)
    {
        $this->kedatangan = $kedatangan;
        // dd($this->kedatanganTamu->user->nama);
        $this->tamu = $tamu;

    }

    public function build()
    {
        return $this->view('mails.SendToTamu')
        ->subject('Pemberitahuan Kedatangan Tamu');
    }
}
