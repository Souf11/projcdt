<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable; // Adds notification support for the Admin model

    // Specify the guard to use for authentication
    protected $guard = 'admin'; // Ensure this matches the guard in config/auth.php

    // If your admins table name is different, specify it here
    protected $table = 'admins'; // Change 'admins' if the table name is different in your database

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // The attributes that should be hidden for arrays (e.g., passwords)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast to native types (e.g., dates)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Optionally, you can add custom methods or relationships if needed in the future
}
