<?php

namespace App\Repositories;

use App\Models\Experts;
use InfyOm\Generator\Common\BaseRepository;

class ExpertsRepository extends BaseRepository
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
        return Experts::class;
    }
}
