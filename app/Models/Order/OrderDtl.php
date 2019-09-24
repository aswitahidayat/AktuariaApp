<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDtl extends Model
{
    protected $table = 'kka_dab.trn_order_dtl';
    protected $primaryKey = 'orddtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'orddtl_id', 'orddtl_hdrid','orddtl_ordnum', 'orddtl_npk', 'orddtl_name',
        'orddtl_sex','orddtl_birthdate', 'orddtl_ktp_num', 'orddtl_npwp_num',
        'orddtl_addr', 'orddtl_hp', 'orddtl_startdate', 'orddtl_curr_sal',
        'orddtl_created_by', 'orddtl_created_date'
    ];
}
