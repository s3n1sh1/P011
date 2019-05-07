<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TDDSCDIY
 * @property string $TDDSCD
 * @property string $TDDSNM
 * @property float $TDLGTH
 * @property string $TDREMK
 * @property string $TDRGID
 * @property string $TDRGDT
 * @property string $TDCHID
 * @property string $TDCHDT
 * @property int $TDCHNO
 * @property boolean $TDDLFG
 * @property boolean $TDDPFG
 * @property boolean $TDPTFG
 * @property int $TDPTCT
 * @property string $TDPTID
 * @property string $TDPTDT
 * @property string $TDSRCE
 * @property string $TDUSRM
 * @property string $TDITRM
 * @property string $TDCSDT
 * @property string $TDCSID
 * @property string $TDCSNO
 */
class TBLDSC extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'TBLDSC';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'TDDSCDIY';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['TDDSCD', 'TDDSNM', 'TDLGTH', 'TDREMK', 'TDRGID', 'TDRGDT', 'TDCHID', 'TDCHDT', 'TDCHNO', 'TDDLFG', 'TDDPFG', 'TDPTFG', 'TDPTCT', 'TDPTID', 'TDPTDT', 'TDSRCE', 'TDUSRM', 'TDITRM', 'TDCSDT', 'TDCSID', 'TDCSNO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tblsys()
    {
        // return $this->hasMany('App\Models\Tblsys', 'TSDSCD', 'TDDSCD');
        return $this->hasMany('App\Models\Tblsys', 'TSDSCDIY', 'TDDSCDIY');
        // return $this->hasMany('App\Models\Tblsys', 'TSDSCD', 'TDDSCD')->whereColumn('TBLSYS.TSCOMSIY', 'TBLDSC.TDCOMSIY');
        // return $this->hasMany('App\Models\Tblsys', ['TSCOMSIY','TSDSCD'], ['TDCOMSIY','TDDSCD']);
    }
}
