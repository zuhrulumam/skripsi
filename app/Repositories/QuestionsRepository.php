<?php

namespace App\Repositories;

use App\Models\Questions;
use InfyOm\Generator\Common\BaseRepository;

class QuestionsRepository extends BaseRepository
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
        return Questions::class;
    }
}
