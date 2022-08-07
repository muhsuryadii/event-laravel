<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    /* Pembayaran berhasil dibuat */
    public static function transactionCreated($email, $url)
    {
        $data = [
            'subject' => 'Pesanan anda berhasil dibuat',
            'title' => 'Selamat, Pesanan Anda Berhasil Dibuat',
            'message' => 'Pesanan berhasil dibuat, Mohon lengkapi pembayaran pada halaman berikut.',
            'email' => $email,
            'url' => $url
        ];
        Mail::to($email)->send(new SendEmailComponent($data));
    }
    /* Pembayaran Diproses */
    public static function transactionProcess($email)
    {
        $data = [
            'subject' => 'Pembayaran Diterima',
            'title' => 'Selamat, Pembayaran Telah Diterima',

            'message' => 'Pembayaran anda telah diterima oleh sistem, Mohon tunggu verifikasi dari panitia.',
            'email' => $email,
        ];
        Mail::to($email)->send(new SendEmailComponent($data));
    }

    /* Pembayaran Gagal */
    public static function transactionFailed($email, $eventID)
    {
        $maildata = [
            'subject' => 'Pembayaran Ditolak',
            'title' => 'Maaf, Pembayaran Anda Telah Ditolak',
            'message' => 'Silahkan upload bukti pembayaran yang valid atau coba hubungi panitia di halaman pembayaran.',
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }

    /* Pembayaran Sukses */
    public static function transactionSuccess($email, $url)
    {
        $maildata = [
            'subject' => 'Pembayaran Diverifikasi',
            'title' => 'Selamat, Pembayaran Anda Telah Diverifikasi',
            'message' => 'Silahkan masuk ke Grup Whatsapp untuk mendapatkan informasi selanjutnya dari panitia.',
            'url' => $url
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }

    /* Pesanan event gratis */
    public static function transactionFreeSuccess($email, $url)
    {
        $maildata = [
            'subject' => 'Pemesanan Tiket Berhasil',
            'title' => 'Selamat, Pemesanan Tiket Berhasil',
            'message' => 'Silahkan masuk ke Grup Whatsapp untuk mendapatkan informasi selanjutnya dari panitia.',
            'url' => $url
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }
}
