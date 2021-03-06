<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $BPBPNOIY
 * @property string $BPBPNO
 * @property string $BPNAME
 * @property string $BPADDR
 * @property string $BPREMK
 * @property string $BPRGID
 * @property string $BPRGDT
 * @property string $BPCHID
 * @property string $BPCHDT
 * @property int $BPCHNO
 * @property boolean $BPDLFG
 * @property boolean $BPDPFG
 * @property boolean $BPPTFG
 * @property int $BPPTCT
 * @property string $BPPTID
 * @property string $BPPTDT
 * @property string $BPSRCE
 * @property string $BPUSRM
 * @property string $BPITRM
 * @property string $BPCSDT
 * @property string $BPCSID
 * @property string $BPCSNO
 */
class MBPMAS extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'MBPMAS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'BPBPNOIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['BPBPNO', 'BPNAME', 'BPADDR', 'BPREMK', 'BPRGID', 'BPRGDT', 'BPCHID', 'BPCHDT', 'BPCHNO', 'BPDLFG', 'BPDPFG', 'BPPTFG', 'BPPTCT', 'BPPTID', 'BPPTDT', 'BPSRCE', 'BPUSRM', 'BPITRM', 'BPCSDT', 'BPCSID', 'BPCSNO'];

}
