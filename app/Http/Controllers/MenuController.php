<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    function index(){
        $data = Menu::get();
        $dataReturn = [];
        foreach ($data as $key=>$val) {
            if($val->mn_parent == 0){
                $dataReturn[$val->mn_id] = $val;
                $dataReturn[$val->mn_id]->child = array();
            } 
            else {
                $dataReturn[$val->mn_parent]->child = 
                    array_merge( $dataReturn[$val->mn_parent]->child, array($val));
            }
        }

        return $dataReturn;
    } 
}