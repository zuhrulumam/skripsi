<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Categories",
 *      required={},
 *      @SWG\Property(
 *          property="category_id",
 *          description="category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="category_slug",
 *          description="category_slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="category_name",
 *          description="category_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="category_description",
 *          description="category_description",
 *          type="string"
 *      )
 * )
 */
class Categories extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'category_id';

    public $fillable = [
        'category_slug',
        'category_name',
        'category_description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'category_slug' => 'string',
        'category_name' => 'string',
        'category_description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
