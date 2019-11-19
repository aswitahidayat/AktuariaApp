<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\AdminController;
use App\Models\SubDistrict;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class SubDistrictController extends AdminController
{
    public function index(Request $request){
        // if($request->ajax())
        // {
        //     // $data = SubDistrict::get();
        //     $query = DB::table('kka_dab.mst_sub_district')
        //     ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
        //     ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

        //     $length = $request->length != '' ? $request->length : 10;
        //     $data = $query->skip($request->start)->take($length)->get();

        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($row){
        //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->subdis_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSubDistrict">Edit</a>';
        //             // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->subdis_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSubDistrict">Delete</a>';
        //             return $btn;
        //         })
        //         ->addColumn('statusName', function($row){
        //             $btn = $row->subdis_status == 1 ? "Active" : "Inactive" ;
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
    }

    public function edit($subdis_id)
    {
        // $data = SubDistrict::find($prov_id);
        $data = DB::table('kka_dab.mst_sub_district')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id')
            ->where('subdis_id', $subdis_id)
            ->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->subdis_id == ''){
            $data = new SubDistrict();
            $data->subdis_disid = $request->subdis_disid;
            $data->subdis_name = $request->subdis_name;
            $data->subdis_bps_code = $request->subdis_bps_code;
            $data->subdis_status = $request->subdis_status;
            $data->subdis_created_by = 1;
            $data->subdis_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_sub_district')
                ->where('subdis_id', $request->subdis_id)
                ->update(['subdis_name' => $request->subdis_name,
                    'subdis_disid' => $request->subdis_disid,
                    'subdis_bps_code' => $request->subdis_bps_code,
                     'subdis_status' => $request->subdis_status,
                     'subdis_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Sub District Type saved successfully.']);
    }

    public function destroy($subdis_id)
    {
        SubDistrict::find($subdis_id)->delete();
        return response()->json(['success'=>'Sub District Type deleted successfully.']);
    }

    public function getsubdistrict(Request $request){
        // $cari = $request->cari;
        $query = DB::table('kka_dab.mst_sub_district')
        // ->where('dis_provid', $cari)
        ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
        ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

        if($request->provid != ''){
            $query->where('kka_dab.mst_province.prov_id', $request->provid);
        }

        if($request->dis != ''){
            $query->where('kka_dab.mst_district.dis_id', $request->dis);
        }

        if($request->name != ''){
            $query->where('subdis_name', 'LIKE', "%$request->name%");
        }

        if($request->limit != ''){
            $query->skip(0)->take(10);
        }

        $data =  $query->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->subdis_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSubDistrict">Edit</a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->subdis_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSubDistrict">Delete</a>';
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