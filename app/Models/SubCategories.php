<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="SubCategories",
 *      required={},
 *      @SWG\Property(
 *          property="sub_category_id",
 *          description="sub_category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rel_category_id",
 *          description="rel_category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sub_category_slug",
 *          description="sub_category_slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sub_category_name",
 *          description="sub_category_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sub_category_description",
 *          description="sub_category_description",
 *          type="string"
 *      )
 * )
 */
class SubCategories extends Model
{
    use SoftDeletes;

    public $table = 'sub_categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'sub_category_id';

    public $fillable = [
        'rel_category_id',
        'sub_category_slug',
        'sub_category_name',
        'sub_category_description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'sub_category_id' => 'integer',
        'rel_category_id' => 'integer',
        'sub_category_slug' => 'string',
        'sub_category_name' => 'string',
        'sub_category_description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
