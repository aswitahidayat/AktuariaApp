<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'kka_dab.mst_province';
    protected $primaryKey = 'prov_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
