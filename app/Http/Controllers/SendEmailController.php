<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Mail\NotifyMail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    //
     public function transactionSuc(){

     }
    public function example1()
    {
        /*  $email = 'chandraperdiansyah@gmail.com';
        $article = [
            'title' => 'Lorem Ipsum',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];
        Mail::to($email)->send(new NotifyMail("Pesan Baru", $article));
        die('Email Sent. - Example1'); */

        // $url = url('/invoice/' . $this->invoice->id);
        $url = url('');

        return (new MailMessage)
            ->greeting('Hello!')
            ->line('One of your invoices has been paid!')
            ->action('View Invoice', $url)
            ->line('Thank you for using our application!');
    }
    /* public function example1()
    {
        $email = 'chandraperdiansyah@gmail.com';
        $articl e = [
            'title' => 'Lorem Ipsum',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];
        Mail::to($email)->send(new NotifyMail($article));
        die('Email Sent. - Example1');
    }

    public function example2()
    {
        $email = 'chandraperdiansyah@gmail.com';
        $article = [
            'title' => 'Lorem Ipsum',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];
        Mail::send('emails.newsletter', ['article' => $article], function ($message) use ($email) {
            $message->to($email)->subject('Weekly Newsletter');
        });
        die('Email Sent. - Example2');
    }

    public function example3()
    {
        $email = 'chandraperdiansyah@gmail.com';
        $text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
        Mail::raw($text, function ($message) use ($email) {
            $message->to($email)->subject('Weekly Newsletter');
        });
        die('Email Sent. - Example3');
    } */
    public function transactionNotification()
    {
        $transactions = DB::table('transactions')
            ->where('status', '=', 'pending')
            ->get();

        foreach ($transactions as $transaction) {
            $event = DB::table('events')
                ->where('id', '=', $transaction->event_id)
                ->first();
            $user = DB::table('users')
                ->where('id', '=', $event->user_id)
                ->first();
            $email = $user->email;
            $subject = 'Pembayaran Event';
            $message = 'Pembayaran event anda belum dikonfirmasi, silahkan cek email anda untuk melakukan konfirmasi pembayaran.';
            Mail::to($email)->send(new NotifyMail($subject, $message));
        }
        die('Email Sent. - Example3');
    }
    public function transactionSuccess()
    {
    }
}
