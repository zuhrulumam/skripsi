<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "category_id";
    protected $fillable = ["category_slug", "category_name", "category_description"];
}
