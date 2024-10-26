<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendToPegawai extends Mailable
{
    use Queueable, SerializesModels;

    public $kedatanganTamu;
    // public $tamu;

    public function __construct($kedatanganTamu)
    {
        $this->kedatanganTamu = $kedatanganTamu;
        // dd($this->kedatanganTamu->user->nama);
        // $this->tamu = $tamu;

    }

    public function build()
    {
        return $this->view('mails.SendToPegawai')
            ->subject('Pemberitahuan Kedatangan Tamu');
    }
}
