<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHandbook extends Model
{
    use HasFactory;

    protected $table = 'student_handbook';

    protected $fillable = [
        'file_name',
        'cover',
        'uploaded_on'
    ];
}
