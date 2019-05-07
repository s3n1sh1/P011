<?php

namespace App\Models;

use App\Models\weModel;

/**
 * @property int $TSCOMSIY
 * @property string $TSDSCD
 * @property string $TSSYCD
 * @property string $TSSYNM
 * @property float $TSSYV1
 * @property float $TSSYV2
 * @property float $TSSYV3
 * @property string $TSSYT1
 * @property string $TSSYT2
 * @property string $TSSYT3
 * @property string $TSLSV1
 * @property string $TSLSV2
 * @property string $TSLSV3
 * @property string $TSLST1
 * @property string $TSLST2
 * @property string $TSLST3
 * @property string $TSREMK
 * @property string $TSRGID
 * @property string $TSRGDT
 * @property string $TSCHID
 * @property string $TSCHDT
 * @property int $TSCHNO
 * @property boolean $TSDLFG
 * @property boolean $TSDPFG
 * @property boolean $TSPTFG
 * @property int $TSPTCT
 * @property string $TSPTID
 * @property string $TSPTDT
 * @property string $TSSRCE
 * @property string $TSUSRM
 * @property string $TSITRM
 * @property string $TSCSDT
 * @property string $TSCSID
 * @property string $TSCSNO
 */
class TBLSYS extends weModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'TBLSYS';

    /**
     * @var array
     */
    protected $fillable = ['TSSYNM', 'TSSYV1', 'TSSYV2', 'TSSYV3', 'TSSYT1', 'TSSYT2', 'TSSYT3', 'TSLSV1', 'TSLSV2', 'TSLSV3', 'TSLST1', 'TSLST2', 'TSLST3', 'TSREMK', 'TSRGID', 'TSRGDT', 'TSCHID', 'TSCHDT', 'TSCHNO', 'TSDLFG', 'TSDPFG', 'TSPTFG', 'TSPTCT', 'TSPTID', 'TSPTDT', 'TSSRCE', 'TSUSRM', 'TSITRM', 'TSCSDT', 'TSCSID', 'TSCSNO'];

}
