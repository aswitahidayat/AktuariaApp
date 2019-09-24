<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'kka_dab.mst_order_service_hdr';
    protected $primaryKey = 'ordsrvhdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordsrvhdr_name', 'ordsrvhdr_desc', 'ordsrvhdr_status', 
        'ordsrvhdr_created_by', 'ordsrvhdr_created_date'
    ];
}
