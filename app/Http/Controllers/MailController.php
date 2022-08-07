<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailComponent;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $humas = DB::table('humas')->where('id_event', $eventID)->first();

        $maildata = [
            'subject' => 'Pembayaran Ditolak',
            'title' => 'Maaf, Pembayaran Anda Telah Ditolak',
            'message' => 'Silahkan upload bukti pembayaran yang valid atau coba hubungi panitia acara.',
            'humas' => $humas,
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }

    /* Pembayaran Sukses */
    public static function transactionSuccess($email, $grup_wa, $googleCalendarUrl)
    {
        $maildata = [
            'subject' => 'Pembayaran Diverifikasi',
            'title' => 'Selamat, Pembayaran Anda Telah Diverifikasi',
            'message' => 'Silahkan masuk ke Grup Whatsapp untuk mendapatkan informasi selanjutnya dari panitia.',
            'url' => $grup_wa,
            'googleCalendar' => $googleCalendarUrl,
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }

    /* Pesanan event gratis */
    public static function transactionFreeSuccess($email, $grup_wa, $googleCalendarUrl)
    {

        $maildata = [
            'subject' => 'Pemesanan Tiket Berhasil',
            'title' => 'Selamat, Pemesanan Tiket Berhasil',
            'message' => 'Silahkan masuk ke Grup Whatsapp untuk mendapatkan informasi selanjutnya dari panitia.',
            'url' => $grup_wa,
            'googleCalendar' => $googleCalendarUrl,
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));
    }

    public static function make_google_calendar_link($name, $begin, $end, $location, $details)
    {
        $params = array('&dates=', '/',  '&location=', '&details=', '&sf=true&output=xml');
        $url = 'https://www.google.com/calendar/render?action=TEMPLATE&text=';
        $arg_list = func_get_args();
        for ($i = 0; $i < count($arg_list); $i++) {
            $current = $arg_list[$i];
            if (is_int($current)) {
                $t = new DateTime('@' . $current, new DateTimeZone('Asia/Jakarta'));
                $current = $t->format('Ymd\THis\Z');
                unset($t);
            } else {
                $current = urlencode($current);
            }
            $url .= (string) $current . $params[$i];
        }
        return $url;
    }
}
