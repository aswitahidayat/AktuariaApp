<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $table = 'kka_dab.mst_order_service_dtl';
    protected $primaryKey = 'ordsrvdtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordsrvdtl_hdrid', 'ordsrvdtl_price', 'ordsrvdtl_startdate', 'ordsrvdtl_enddate',
        'ordsrvdtl_created_by', 'ordsrvdtl_created_date', 'ordsrvdtl_updated_by', 'ordsrvdtl_updated_date'
    ];
}
