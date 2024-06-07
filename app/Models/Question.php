<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;  // Disable timestamps

    protected $table = 'question_list';

    protected $fillable = [
        'evaluation_id',
        'question',
        'criteria_id'
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
