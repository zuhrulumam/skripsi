<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $fillable = ["rel_user_id", 'rel_question_id', 'rel_answer'];
}
