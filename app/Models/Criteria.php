<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public $timestamps = false;  // Disable timestamps

    protected $table = 'criteria_list';

    protected $fillable = [
        'criteria',
        'evaluation_id',
        'description'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
