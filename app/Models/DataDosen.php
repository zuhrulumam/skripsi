<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="DataDosen",
 *      required={},
 *      @SWG\Property(
 *          property="ID_STATUS_HENTI",
 *          description="ID_STATUS_HENTI",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="NAMA",
 *          description="NAMA",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="NIP",
 *          description="NIP",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ID_UNIT",
 *          description="ID_UNIT",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ID_SUB_UNIT",
 *          description="ID_SUB_UNIT",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ID_JENIS_STAF",
 *          description="ID_JENIS_STAF",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="FAKULTAS",
 *          description="FAKULTAS",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="NAMA1",
 *          description="NAMA1",
 *          type="string"
 *      )
 * )
 */
class DataDosen extends Model
{
    use SoftDeletes;

    public $table = 'data_dosen';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ID_STATUS_HENTI',
        'NAMA',
        'NIP',
        'ID_UNIT',
        'ID_SUB_UNIT',
        'ID_JENIS_STAF',
        'FAKULTAS',
        'NAMA1'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID_STATUS_HENTI' => 'string',
        'NAMA' => 'string',
        'NIP' => 'string',
        'ID_UNIT' => 'string',
        'ID_SUB_UNIT' => 'string',
        'ID_JENIS_STAF' => 'string',
        'FAKULTAS' => 'string',
        'NAMA1' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
