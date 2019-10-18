<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\AdminController;
use App\Models\Province;
use Illuminate\Http\Request;
use DataTables;
use DB;

class RegionController extends AdminController
{
    public function index(Request $request)
    {
        return view('datamaster.region.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $usertypes = DB::table('dm_usertype')->where('usertype_nm', 'LIKE', '%' . $request->search . "%")->get();
            if ($usertypes) {
                foreach ($usertypes as $key => $usertype) {
                    $output .= '<tr>' .
                        '<th>' . $usertype->usertype_nm . '</th>' .
                        '<th>' . $usertype->usertype_status . '</th>' .
                        '<th> test </th>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }
}
