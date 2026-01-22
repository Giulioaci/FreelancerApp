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

    // CAMPi riempibili
    protected $fillable = [
        'name',
        'email',
        'password',
        'plan', // free/pro
    ];

    // CAMPi nascosti
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // CASTS
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ===========================
    // RELAZIONI
    // ===========================
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // ===========================
    // MAIL RESET PASSWORD
    // ===========================
    public function sendPasswordResetNotification($token)
    {
        $email = $this->email;

        $view = 'auth.emails.password-reset';
        $data = [
            'token' => $token,
            'email' => $email,
        ];

        Mail::mailer('yahoo')->to($email)->send(new GenericMail($view, $data));
    }

    // ===========================
    // UTILI PER LIMITI PIANO
    // ===========================
    
    /**
     * Verifica se l'utente free ha raggiunto il limite clienti
     */
    public function hasReachedClientLimit(): bool
    {
        return $this->plan === 'free' && $this->clients()->count() >= 5;
    }

    /**
     * Restituisce il numero di clienti utilizzati
     */
    public function clientsCount(): int
    {
        return $this->clients()->count();
    }

    /**
     * Verifica se l'utente è PRO
     */
    public function isPro(): bool
    {
        return $this->plan === 'pro';
    }
}







