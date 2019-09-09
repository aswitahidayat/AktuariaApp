<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Zip;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ZipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
    }

    public function getzip(Request $request){
        $query = Zip::
            leftJoin('kka_dab.mst_village', 'zip_villid', '=', 'kka_dab.mst_village.vill_id')
            ->leftJoin('kka_dab.mst_sub_district', 'vill_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

            if($request->provid != ''){
                $query->where('dis_provid', $request->provid);
            }
    
            if($request->dis != ''){
                $query->where('dis_id', $request->dis);
            }

            if($request->subdis != ''){
                $query->where('subdis_disid', $request->subdis);
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
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->zip_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editZip">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->zip_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteZip">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->zip_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function edit($zip_id)
    {
        $data = Zip:: 
            leftJoin('kka_dab.mst_village', 'zip_villid', '=', 'kka_dab.mst_village.vill_id')
            ->leftJoin('kka_dab.mst_sub_district', 'vill_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id')
            ->where('zip_id', $zip_id)
            ->first()
        ;
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->zip_id == ''){
            $data = new Zip();
            $data->zip_villid = $request->zip_villid;
            $data->zip_code = $request->zip_code;
            $data->zip_status = $request->zip_status;
            $data->zip_created_by = 1;
            $data->zip_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_zipcode')
                ->where('zip_id', $request->zip_id)
                ->update(['zip_villid' => $request->zip_villid,
                    'zip_code' => $request->zip_code,
                    'zip_status' => $request->zip_status,
                    'zip_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Zip Type saved successfully.']);
    }

    public function destroy($zip_id)
    {
        Zip::find($zip_id)->delete();
        return response()->json(['success'=>'Zip Type deleted successfully.']);
    }

}