<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $table = 'kka_dab.mst_coytype_dtl';
    protected $primaryKey = 'coytypedtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'coytypedtl_hdrid','coytypedtl_assumpt_sp', 'coytypedtl_assumpt_code',
        'coytypedtl_assumpt_value', 'coytypedtl_status', 'coytypedtl_created_by', 
        'coytypedtl_created_date'];
}
