<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTestMail;

class MailSendController extends Controller
{
    public function send()
    {
        Mail::send(new SendTestMail());
    }
}
