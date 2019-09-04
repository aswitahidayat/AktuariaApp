<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $table = 'kka_dab.mst_sub_district';
    protected $primaryKey = 'subdis_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
