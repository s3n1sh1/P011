<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $SCCOMSIY
 * @property string $SCCODE
 * @property string $SCNAME
 * @property string $SCDESC
 * @property string $SCREMK
 * @property string $SCRGID
 * @property string $SCRGDT
 * @property string $SCCHID
 * @property string $SCCHDT
 * @property int $SCCHNO
 * @property boolean $SCDLFG
 * @property boolean $SCDPFG
 * @property boolean $SCPTFG
 * @property int $SCPTCT
 * @property string $SCPTID
 * @property string $SCPTDT
 * @property string $SCSRCE
 * @property string $SCUSRM
 * @property string $SCITRM
 * @property string $SCCSDT
 * @property string $SCCSID
 * @property string $SCCSNO
 */
class SYSCOM extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'SYSCOM';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'SCCOMSIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['SCCODE', 'SCNAME', 'SCDESC', 'SCREMK', 'SCRGID', 'SCRGDT', 'SCCHID', 'SCCHDT', 'SCCHNO', 'SCDLFG', 'SCDPFG', 'SCPTFG', 'SCPTCT', 'SCPTID', 'SCPTDT', 'SCSRCE', 'SCUSRM', 'SCITRM', 'SCCSDT', 'SCCSID', 'SCCSNO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tbldsc()
    {
        return $this->hasMany('App\Models\Tbldsc', 'TDCOMSIY', 'SCCOMSIY');
        // return $this->belongsToMany('App\Models\Tbldsc', 'SYSCOM', 'SCdCOMSIY', 'SCCOMSIY');
        // return $this->belongsToMany('App\Models\SYSCOM', 'TBLDSC', 'TDCOMSIY', 'TDCOMSIY');
    }

}
