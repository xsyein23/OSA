<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;

    public $timestamps = false;  // Disable timestamps

    protected $table = 'complainant_message';

    protected $fillable = [
        'date_filed',
        'student_id',
        'user_name',
        'user_college',
        'user_course',
        'user_email',
        'user_message',
        'user_file',
        'is_send'
    ];
}
