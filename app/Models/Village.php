<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'kka_dab.mst_village';
    protected $primaryKey = 'vill_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
