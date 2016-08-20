<?php

namespace App\Repositories;

use App\Models\SubCategories;
use InfyOm\Generator\Common\BaseRepository;

class SubCategoriesRepository extends BaseRepository
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
        return SubCategories::class;
    }
}
