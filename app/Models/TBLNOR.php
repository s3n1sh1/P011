<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TNNOMRIY
 * @property string $TNTABL
 * @property string $TNNOUR
 * @property string $TNREMK
 * @property string $TNRGID
 * @property string $TNRGDT
 * @property string $TNCHID
 * @property string $TNCHDT
 * @property int $TNCHNO
 * @property boolean $TNDLFG
 * @property boolean $TNDPFG
 * @property boolean $TNPTFG
 * @property int $TNPTCT
 * @property string $TNPTID
 * @property string $TNPTDT
 * @property string $TNSRCE
 * @property string $TNUSRM
 * @property string $TNITRM
 * @property string $TNCSDT
 * @property string $TNCSID
 * @property string $TNCSNO
 */
class TBLNOR extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'TBLNOR';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'TNNOMRIY';

    /**
     * @var array
     */
    protected $fillable = ['TNTABL', 'TNNOUR', 'TNREMK', 'TNRGID', 'TNRGDT', 'TNCHID', 'TNCHDT', 'TNCHNO', 'TNDLFG', 'TNDPFG', 'TNPTFG', 'TNPTCT', 'TNPTID', 'TNPTDT', 'TNSRCE', 'TNUSRM', 'TNITRM', 'TNCSDT', 'TNCSID', 'TNCSNO'];

}
