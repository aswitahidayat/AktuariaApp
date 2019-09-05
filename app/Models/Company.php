<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'kka_dab.mst_coytype_hdr';
    protected $primaryKey = 'coytypehdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
