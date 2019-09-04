<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'kka_dab.mst_district';
    protected $primaryKey = 'dis_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
