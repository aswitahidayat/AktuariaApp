<?php
/**
 * Created by PhpStorm.
 * User: Shandy
 * Date: 4/22/2019
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        // if($request->ajax())
        // {
        //     $data = Province::get();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($row){
        //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->prov_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUsertype">Edit</a>';
        //             $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->prov_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUsertype">Delete</a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

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
