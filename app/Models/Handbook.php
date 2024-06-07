<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handbook extends Model
{
    use HasFactory;

    protected $table = 'student_handbook';

    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'file_name',
        'cover',
        'uploaded_on'
    ];
}
