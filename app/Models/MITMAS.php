<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $MMITNOIY
 * @property string $MMITNO
 * @property string $MMITNM
 * @property string $MMITDS
 * @property string $MMUNMS
 * @property string $MMREMK
 * @property string $MMRGID
 * @property string $MMRGDT
 * @property string $MMCHID
 * @property string $MMCHDT
 * @property int $MMCHNO
 * @property boolean $MMDLFG
 * @property boolean $MMDPFG
 * @property boolean $MMPTFG
 * @property int $MMPTCT
 * @property string $MMPTID
 * @property string $MMPTDT
 * @property string $MMSRCE
 * @property string $MMUSRM
 * @property string $MMITRM
 * @property string $MMCSDT
 * @property string $MMCSID
 * @property string $MMCSNO
 */
class MITMAS extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'MITMAS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'MMITNOIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['MMITNO', 'MMITNM', 'MMITDS', 'MMUNMS', 'MMREMK', 'MMRGID', 'MMRGDT', 'MMCHID', 'MMCHDT', 'MMCHNO', 'MMDLFG', 'MMDPFG', 'MMPTFG', 'MMPTCT', 'MMPTID', 'MMPTDT', 'MMSRCE', 'MMUSRM', 'MMITRM', 'MMCSDT', 'MMCSID', 'MMCSNO'];

}
