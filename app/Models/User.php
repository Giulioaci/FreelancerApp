<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenericMail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Override invio reset password usando Yahoo
     */
    public function sendPasswordResetNotification($token)
    {
        $email = $this->email;

        $view = 'auth.emails.password-reset';
        $data = [
            'token' => $token,
            'email' => $email,
        ];

        // Invia la mail tramite il mailer Yahoo configurato
        Mail::mailer('yahoo')->to($email)->send(new GenericMail($view, $data));
    }
}





