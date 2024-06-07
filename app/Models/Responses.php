<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'evaluation_id',
        'userID',
        'question_id',
        'response',
        'date_created'
    ];

    public function evaluation()
    {
        return $this->belongsTo(EvaluationList::class, 'evaluation_id');
    }

    public function user()
    {
        return $this->belongsTo(Account::class, 'userID');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
