<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetailSub extends Model
{
    protected $table = 'kka_dab.mst_coytype_dtlsub';
    protected $primaryKey = 'coytypedtlsub_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['coytypedtlsub_dtlid', 'coytypedtlsub_amt_min', 
        'coytypedtlsub_amt_max'. 'coytypedtlsub_value', 'coytypedtlsub_created_by', 'coytypedtlsub_created_date'];
}
