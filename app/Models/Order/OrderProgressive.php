<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderProgressive extends Model
{
    protected $table = 'kka_dab.trn_order_progresive';
    protected $primaryKey = 'ordpro_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordpro_id', 'ordpro_assid', 'ordpro_amt_min','ordpro_amt_max', 'ordpro_value', 
        'ordpro_created_by', 'ordpro_created_date','ordpro_updated_by', 'ordpro_updated_date'
    ];
}
