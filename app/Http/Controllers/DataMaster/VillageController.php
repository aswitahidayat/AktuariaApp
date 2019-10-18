<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\AdminController;
use App\Models\Village;
use App\Models\District;

use Illuminate\Http\Request;
use DataTables;
use DB;

class VillageController extends AdminController
{
    public function index(Request $request){
    }

    public function getvillage(Request $request){
        $query = Village::
            leftJoin('kka_dab.mst_sub_district', 'vill_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

            if($request->provid != ''){
                $query->where('dis_provid', $request->provid);
            }
    
            if($request->dis != ''){
                $query->where('dis_id', $request->dis);
            }

            if($request->subdis != ''){
                $query->where('subdis_id', $request->subdis);
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
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->vill_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editVillage">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->vill_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteVillage">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->vill_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function edit($vill_id)
    {
        $data = Village:: 
            leftJoin('kka_dab.mst_sub_district', 'vill_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id')
            ->where('vill_id', $vill_id)
            ->first()
        ;
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->vill_id == ''){
            $data = new Village();
            $data->vill_subdisid = $request->vill_subdisid;
            $data->vill_name = $request->vill_name;
            $data->vill_bps_code = $request->vill_bps_code;
            $data->vill_status = $request->vill_status;
            $data->vill_created_by = 1;
            $data->vill_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_village')
                ->where('vill_id', $request->vill_id)
                ->update(['vill_subdisid' => $request->vill_subdisid,
                    'vill_name' => $request->vill_name,
                    'vill_bps_code' => $request->vill_bps_code,
                     'vill_status' => $request->vill_status,
                     'vill_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Village Type saved successfully.']);
    }

    public function destroy($vill_id)
    {
        Village::find($vill_id)->delete();
        return response()->json(['success'=>'Village Type deleted successfully.']);
    }

}