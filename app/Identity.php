<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $table = 'kka_dab.mst_type_identity';
    protected $primaryKey = 'typeid_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

}
