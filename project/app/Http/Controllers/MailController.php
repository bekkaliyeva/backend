<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
    public function send(){
        Mail::raw("Ainura the best", function ($message)  {
            $message->from(env("MAIL_USERNAME"));
            $message->to("sekerbekova00@gmail.com")->subject("Тикет");
        });}
    //
}

