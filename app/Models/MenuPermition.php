<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class MenuPermition extends Model
{
    protected $table = 'kka_dab.mst_menu_permission';
    protected $primaryKey = 'mnp_id'; // or null

    protected $fillable = [
        'mnp_mn',
        'mnp_usrt', 
    ];
}