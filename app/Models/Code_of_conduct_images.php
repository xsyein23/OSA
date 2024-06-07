<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeOfConductImages extends Model
{
    use HasFactory;

    protected $table = 'code_of_conduct_images';

    protected $fillable = [
        'file_name',
        'uploaded_on',
        'status'
    ];
}
