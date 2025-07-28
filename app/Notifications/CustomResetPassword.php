<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class CustomResetPassword extends Notification
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Fetch the user's name from the database using the email
        $user = DB::table('users')->where('email', $this->email)->first();
        $name = $user ? $user->name : null;

        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->email,
        ], false));

        $expiration = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->view('vendor.notifications.email', [
                'actionUrl' => $resetUrl,
                'expiration' => $expiration,
                'name' => $name,
            ]);
    }
}
