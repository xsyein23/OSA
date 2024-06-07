<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spectrum extends Model
{
    use HasFactory;

    protected $table = 'spectrum_post';

    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'title',
        'pdf_file',
        'image',
        'date_created',
        'is_archive'
    ];
}
