<?php

namespace App\Repositories;

use App\Models\ExpertsQuestions;
use InfyOm\Generator\Common\BaseRepository;

class ExpertsQuestionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ExpertsQuestions::class;
    }
}
