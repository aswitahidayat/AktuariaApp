<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $table = 'kka_dab.mst_order_service_hdr';
    protected $primaryKey = 'ordsrvhdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
