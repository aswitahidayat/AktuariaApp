<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'kka_dab.mst_menu';
    protected $primaryKey = 'mn_id'; // or null

    public $incrementing = true;
    public $timestamps = false;
}
