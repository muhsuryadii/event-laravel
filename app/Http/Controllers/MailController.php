<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendMail()
    {
        $email = 'chandraperdiansyah@gmail.com';

        $maildata = [
            'title' => 'Laravel Mail Markdown SendEmailComponent',
        ];

        Mail::to($email)->send(new SendEmailComponent($maildata));

        dd("Mail has been sent successfully");
    }
    public function sendMailComponent()
    {
        dd('Nicesnippets.com');
    }
}
