<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ["question_text", "question_slug", "question_category_id"];
    
    protected $primaryKey = "question_id";
    
    
}
