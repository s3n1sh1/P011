<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TENOMRIY
 * @property string $TEUSER
 * @property string $TEERNO
 * @property string $TEERST
 * @property string $TEERMS
 * @property string $TESPTR
 * @property string $TESTMT
 * @property string $TEREMK
 * @property string $TERGID
 * @property string $TERGDT
 * @property string $TECHID
 * @property string $TECHDT
 * @property int $TECHNO
 * @property boolean $TEDLFG
 * @property boolean $TEDPFG
 * @property boolean $TEPTFG
 * @property int $TEPTCT
 * @property string $TEPTID
 * @property string $TEPTDT
 * @property string $TESRCE
 * @property string $TEUSRM
 * @property string $TEITRM
 * @property string $TECSDT
 * @property string $TECSID
 * @property string $TECSNO
 */
class TBLELF extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'TBLELF';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'TENOMRIY';

    /**
     * @var array
     */
    protected $fillable = ['TEUSER', 'TEERNO', 'TEERST', 'TEERMS', 'TESPTR', 'TESTMT', 'TEREMK', 'TERGID', 'TERGDT', 'TECHID', 'TECHDT', 'TECHNO', 'TEDLFG', 'TEDPFG', 'TEPTFG', 'TEPTCT', 'TEPTID', 'TEPTDT', 'TESRCE', 'TEUSRM', 'TEITRM', 'TECSDT', 'TECSID', 'TECSNO'];

}
