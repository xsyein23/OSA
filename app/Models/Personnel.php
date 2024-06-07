<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnel';

    public $timestamps = false;  // Disable timestamps
    
    protected $fillable = [
        'name',
        'position',
        'facebook',
        'email',
        'image',
        'is_archive'
    ];
}
