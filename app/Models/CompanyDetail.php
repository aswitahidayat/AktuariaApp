<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $table = 'kka_dab.mst_coytype_dtl';
    protected $primaryKey = 'coytypedtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
