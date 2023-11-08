<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','answer_id','vote','question_id'];
    
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function question ()
    {
        return $this->belongsTo(Question::class);
    }
}
