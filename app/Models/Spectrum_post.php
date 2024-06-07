<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpectrumPost extends Model
{
    use HasFactory;

    protected $table = 'spectrum_post';

    protected $fillable = [
        'title',
        'image',
        'pdf_file',
        'date_created',
        'is_archive'
    ];
}
