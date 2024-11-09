<?php

use App\Mail\Composemail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

// Helper functions for email

if (!function_exists('SendMail')) {
    function SendMail($to,$message,$subject) {
        return Mail::to($to)->send(new Composemail($message,$subject));
    }
}
