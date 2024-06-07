<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    public $timestamps = false;  // Disable timestamps

    protected $table = 'evaluation_list';

    protected $fillable = [
        'year',
        'semester',
        'title',
        'status',
        'is_archive',
        'is_default',
        'date_created'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function criteria()
    {
        return $this->hasMany(Criteria::class);
    }
}
