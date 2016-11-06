<?php

namespace App\Repositories;

use App\Models\DataDosen;
use InfyOm\Generator\Common\BaseRepository;

class DataDosenRepository extends BaseRepository
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
        return DataDosen::class;
    }
}
