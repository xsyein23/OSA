<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationList extends Model
{
    use HasFactory;

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
}
