<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public $timestamps = false;  // Disable timestamps

    protected $table = 'comments';

    protected $fillable = [
        'evaluation_id',
        'comment',
        'date_created'
    ];
}
