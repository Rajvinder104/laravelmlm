<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; // Make sure to import this



class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define the table if it is not the default 'admins'
    protected $table = 'admins';
    protected $primaryKey = 'id';
    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'password',
        'role',

    ];

    // Hide sensitive attributes when serialized
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Automatically cast attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
