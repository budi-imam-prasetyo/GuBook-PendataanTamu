<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendToTamuTolak extends Mailable
{
    use Queueable, SerializesModels;

    public $kedatangan;
    public $tamu;
    public $alasan_penolakan;

    public function __construct($kedatangan, $tamu, $alasan_penolakan)
    {
        $this->kedatangan = $kedatangan;
        $this->tamu = $tamu;
        $this->alasan_penolakan = $alasan_penolakan;
    }

    public function build()
    {
        return $this->view('mails.SendToTamuTolak')
            ->subject('Pemberitahuan Penolakan Pertemuan')
            ->with([
                'nama_tamu' => $this->tamu->nama,
                'tujuan' => $this->kedatangan->tujuan,
                'waktu_perjanjian' => $this->kedatangan->waktu_perjanjian,
                'alasan_penolakan' => $this->alasan_penolakan,
            ]);
    }
}
