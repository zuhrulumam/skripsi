<?php

namespace App\Repositories;

use App\Models\ExpertAnswers;
use InfyOm\Generator\Common\BaseRepository;

class ExpertAnswersRepository extends BaseRepository
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
        return ExpertAnswers::class;
    }
}
