<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProgram extends Model
{
    protected $table = 'kka_dab.mst_order_program';
    protected $primaryKey = 'ordprg_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

}
