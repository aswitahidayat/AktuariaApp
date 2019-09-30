<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'kka_dab.trn_order_hdr';
    protected $primaryKey = 'ordhdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordhdr_ordnum', 'ordhdr_program','ordhdr_service_hdr', 'ordhdr_period_count', 'ordhdr_period_lastyear',
        'ordhdr_pension_age','ordhdr_sal_increase', 'ordhdr_date', 'ordhdr_pay_date', 'ordhdr_amount',
        'ordhdr_pay_status', 'ordhdr_created_by', 'ordhdr_created_date', 'ordhdr_bizpartid',
    ];
}
