<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TDCOMSIY
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
 * @property Syscom $syscom
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
     * @var array
     */
    protected $fillable = ['TDDSNM', 'TDLGTH', 'TDREMK', 'TDRGID', 'TDRGDT', 'TDCHID', 'TDCHDT', 'TDCHNO', 'TDDLFG', 'TDDPFG', 'TDPTFG', 'TDPTCT', 'TDPTID', 'TDPTDT', 'TDSRCE', 'TDUSRM', 'TDITRM', 'TDCSDT', 'TDCSID', 'TDCSNO'];

    /**
     * The primary key for the model.
     * Gak Bisa Pakain protected $primaryKey
     * TDDSCD nilainya akan jadi 0
     * Alias akan tukar data jadi fieldnya id
     * @var string
     */
    // protected $primaryKey = 'TDDSCD';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function syscom()
    {
        return $this->belongsTo('App\Models\Syscom', 'TDCOMSIY', 'SCCOMSIY');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tblsys()
    {
        // return $this->hasMany('App\Models\Tblsys', 'TSDSCD', 'TDDSCD');
        return $this->hasMany('App\Models\Tblsys', 'TSDSCD', 'TDDSCD')->where('TSCOMSIY', $this->TDCOMSIY);
        // return $this->hasMany('App\Models\Tblsys', 'TSDSCD', 'TDDSCD')->whereColumn('TBLSYS.TSCOMSIY', 'TBLDSC.TDCOMSIY');
        // return $this->hasMany('App\Models\Tblsys', ['TSCOMSIY','TSDSCD'], ['TDCOMSIY','TDDSCD']);
    }

}
