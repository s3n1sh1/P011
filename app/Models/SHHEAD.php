<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $SHSHNOIY
 * @property string $SHSHNO
 * @property string $SHDATE
 * @property int $SHBPNOIY
 * @property float $SHTOTL
 * @property string $SHREMK
 * @property string $SHRGID
 * @property string $SHRGDT
 * @property string $SHCHID
 * @property string $SHCHDT
 * @property int $SHCHNO
 * @property boolean $SHDLFG
 * @property boolean $SHDPFG
 * @property boolean $SHPTFG
 * @property int $SHPTCT
 * @property string $SHPTID
 * @property string $SHPTDT
 * @property string $SHSRCE
 * @property string $SHUSRM
 * @property string $SHITRM
 * @property string $SHCSDT
 * @property string $SHCSID
 * @property string $SHCSNO
 * @property Mbpma $mbpma
 */
class SHHEAD extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'SHHEAD';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'SHSHNOIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['SHSHNO', 'SHDATE', 'SHBPNOIY', 'SHTOTL', 'SHREMK', 'SHRGID', 'SHRGDT', 'SHCHID', 'SHCHDT', 'SHCHNO', 'SHDLFG', 'SHDPFG', 'SHPTFG', 'SHPTCT', 'SHPTID', 'SHPTDT', 'SHSRCE', 'SHUSRM', 'SHITRM', 'SHCSDT', 'SHCSID', 'SHCSNO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mbpma()
    {
        return $this->belongsTo('App\Models\Mbpma', 'SHBPNOIY', 'BPBPNOIY');
    }
}
