<?php

namespace App\Repositories;

use App\Models\UserQuestions;
use InfyOm\Generator\Common\BaseRepository;

class UserQuestionsRepository extends BaseRepository
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
        return UserQuestions::class;
    }
}
