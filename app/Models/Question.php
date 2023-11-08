<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Question extends Model
{
    use HasFactory;
    // protected $table = 'questions';
    protected $fillable = ['user_id','question_title','description'];
  

    public function question()
    {
        return $this->belongsTo(User::class,'user_id');
    }
  

    public function answer()
    {
        return $this->belongsTo(Answer::class,'user_id');
    }
}

