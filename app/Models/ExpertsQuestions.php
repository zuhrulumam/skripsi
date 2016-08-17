<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ExpertsQuestions",
 *      required={},
 *      @SWG\Property(
 *          property="question_id",
 *          description="question_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question_slug",
 *          description="question_slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="question_category_id",
 *          description="question_category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question_text",
 *          description="question_text",
 *          type="string"
 *      )
 * )
 */
class ExpertsQuestions extends Model {

    use SoftDeletes;

    public $table = 'experts_questions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'question_id';
    public $fillable = [
        'question_slug',
        'question_category_id',
        'question_text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'question_id' => 'integer',
        'question_slug' => 'string',
        'question_category_id' => 'integer',
        'question_text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function getCategoryComparation($type) {
        return $this->belongsTo("App\Models\Categories", $type, "category_id");
    }

    

}
