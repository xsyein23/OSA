<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publications extends Model
{
    use HasFactory;

    protected $table = 'publication_page';

    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'title',
        'image',
        'description',
        'is_archive'
    ];
}
