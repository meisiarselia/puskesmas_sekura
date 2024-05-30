<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidasiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $pasien;
    public $is_valid;
    public function __construct($pasien, $is_valid)
    {
        $this->is_valid = $is_valid;
        $this->pasien = $pasien;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Registrasi ' . ($this->is_valid ? 'Berhasil' : 'Gagal'))->view('email.validasi');
    }
}
