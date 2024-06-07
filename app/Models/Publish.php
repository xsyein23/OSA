<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publish extends Model
{
    use HasFactory;

    protected $table = 'publish_post';
    
    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'title',
        'image',
        'descriptions',
        'date_created',
        'own_by',
        'is_archive'
    ];

    public function publicationPage()
    {
        return $this->belongsTo(Publications::class, 'own_by');
    }
}
