<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Menu extends Model
{
    protected $table = 'kka_dab.mst_menu';
    protected $primaryKey = 'mn_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'mn_name',
        'mn_status', 
        'mn_parent',
        'mn_link', 
        'mn_order', 
    ];

    public static function findPermition(){
        $querry = DB::table('kka_dab.mst_menu');
        $usrtype = Auth::user()->user_type;
        if($usrtype != 1){
            
            $querry->join('kka_dab.mst_menu_permission', 'kka_dab.mst_menu.mn_id', '=', 'kka_dab.mst_menu_permission.mnp_mn');

            $querry->where('mnp_usrt', $usrtype);
        }

        $querry->where('mn_status', '1');

        $querry->orderBy('mn_parent');
        $querry->orderBy('mn_order');

        return $querry->get();

    }

    public static function editPermit($mn_id){
        $querry = DB::table('kka_dab.mst_user_type');
        $querry ->leftJoin('kka_dab.mst_menu_permission', function($q) use ($mn_id){
            $q->on('kka_dab.mst_user_type.usertype_id', '=', 'kka_dab.mst_menu_permission.mnp_usrt')
            ->where('kka_dab.mst_menu_permission.mnp_mn', $mn_id);
        });
        $querry ->where('kka_dab.mst_user_type.usertype_id', '<>', 1);

        return $querry->get();

    }
}
