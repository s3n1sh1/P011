<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TMMENUIY
 * @property string $TMNOMR
 * @property string $TMGRUP
 * @property string $TMMENU
 * @property string $TMDESC
 * @property string $TMSCUT
 * @property string $TMACES
 * @property int $TMBCDT
 * @property int $TMFWDT
 * @property string $TMURLW
 * @property string $TMSYFG
 * @property int $TMUSCT
 * @property string $TMLSDT
 * @property string $TMLSBY
 * @property string $TMRLDT
 * @property string $TMGRID
 * @property string $TMREMK
 * @property string $TMRGID
 * @property string $TMRGDT
 * @property string $TMCHID
 * @property string $TMCHDT
 * @property int $TMCHNO
 * @property boolean $TMDLFG
 * @property boolean $TMDPFG
 * @property boolean $TMPTFG
 * @property int $TMPTCT
 * @property string $TMPTID
 * @property string $TMPTDT
 * @property string $TMSRCE
 * @property string $TMUSRM
 * @property string $TMITRM
 * @property string $TMCSDT
 * @property string $TMCSID
 * @property string $TMCSNO
 */
class TBLMNU extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'TBLMNU';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'TMMENUIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['TMNOMR', 'TMGRUP', 'TMMENU', 'TMDESC', 'TMSCUT', 'TMACES', 'TMBCDT', 'TMFWDT', 'TMURLW', 'TMSYFG', 'TMUSCT', 'TMLSDT', 'TMLSBY', 'TMRLDT', 'TMGRID', 'TMREMK', 'TMRGID', 'TMRGDT', 'TMCHID', 'TMCHDT', 'TMCHNO', 'TMDLFG', 'TMDPFG', 'TMPTFG', 'TMPTCT', 'TMPTID', 'TMPTDT', 'TMSRCE', 'TMUSRM', 'TMITRM', 'TMCSDT', 'TMCSID', 'TMCSNO'];

}
