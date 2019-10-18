<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\AdminController;
use App\Models\District;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class DistrictController extends AdminController
{
    public function index(Request $request){
        if($request->ajax())
        {
            $data = DB::table('kka_dab.mst_district')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->dis_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDistrict">Edit</a>';
                    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->dis_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDistrict">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query =District::where('dis_name', 'LIKE', '%' . $request->q . "%");

            if($request->prov != ""){
                $query->where('dis_provid', '=', "$request->prov");
            }
            $data = $query->orderBy('dis_id')->get();
            return response()->json($data);
        }
    }

    public function edit($dis_id)
    {
        $data = District::find($dis_id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->dis_id == ''){
            $data = new District();
            $data->dis_provid = $request->dis_provid;
            $data->dis_name = $request->dis_name;
            $data->dis_bps_code = $request->dis_bps_code;
            $data->dis_status = $request->dis_status;
            $data->dis_created_by = 1;
            $data->dis_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_district')
                ->where('dis_id', $request->dis_id)
                ->update(['dis_provid' => $request->dis_provid,
                    'dis_name' => $request->dis_name,
                    'dis_bps_code' => $request->dis_bps_code,
                     'dis_status' => $request->dis_status,
                     'dis_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'District Type saved successfully.']);
    }

    public function destroy($dis_id)
    {
        District::find($dis_id)->delete();
        return response()->json(['success'=>'District Type deleted successfully.']);
    }

    public function getdistrict(Request $request){
        $query = DB::table('kka_dab.mst_district')
                ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');
        if($request->provid != ''){
            $query->where('dis_provid', $request->provid);
        }

        if($request->name != ''){
            $query->where('dis_name', 'LIKE', "%$request->name%");
        }

        $data =  $query->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->dis_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDistrict">Edit</a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->dis_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDistrict">Delete</a>';
                return $btn;
            })
            ->addColumn('statusName', function($row){
                $btn = $row->dis_status == 1 ? "Active" : "Inactive" ;
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}