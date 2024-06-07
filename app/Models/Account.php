<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable // Extend Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'account';

    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'userID',
        'student_id',
        'fullname',
        'gender',
        'course',
        'college',
        'email',
        'password',
        'userType'
    ];
}
