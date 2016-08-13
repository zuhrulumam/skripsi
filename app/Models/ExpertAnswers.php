<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ExpertAnswers",
 *      required={},
 *      @SWG\Property(
 *          property="rel_user_id",
 *          description="rel_user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rel_question_id",
 *          description="rel_question_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rel_answer",
 *          description="rel_answer",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class ExpertAnswers extends Model
{
    use SoftDeletes;

    public $table = 'expert_answers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'rel_user_id',
        'rel_question_id',
        'rel_answer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rel_user_id' => 'integer',
        'rel_question_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
