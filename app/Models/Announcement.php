<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';
    
    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'cover',
        'title',
        'date_created',
        'descriptions',
        'image',
        'is_archive'
    ];
}
