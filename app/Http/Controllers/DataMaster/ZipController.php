<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Zip;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Redirect,Response;

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
        $data = $this->zip($request, 'pagging');
        
        $b['data']= $data;
        $b['recordsFiltered']= $this->zip($request, 'count');
        $b['recordsTotal']= $this->zip($request, 'count');
        return $b;
    }

    public function edit($zipcode_id)
    {
        $data = $this->zip(new Request,'edit', $zipcode_id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->zipcode_id == ''){
            $data = new Zip();
            $data->zip_villid = $request->zip_villid;
            $data->zip_code = $request->zip_code;
            $data->zip_status = $request->zip_status;
            $data->zip_created_by = 1;
            $data->zip_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_zipcode')
                ->where('zipcode_id', $request->zipcode_id)
                ->update(['zip_villid' => $request->zip_villid,
                    'zip_code' => $request->zip_code,
                    'zip_status' => $request->zip_status,
                    'zip_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Zip Type saved successfully.']);
    }

    public function destroy($zipcode_id)
    {
        Zip::find($zipcode_id)->delete();
        return response()->json(['success'=>'Zip Type deleted successfully.']);
    }

    public function zip(Request $request, $reqType ='', $param = ''){
        $query = Zip::
            leftJoin('kka_dab.mst_sub_district', 'zip_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id')
            ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

        $query->raw("zip_status AS total");
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
        
        if($reqType == 'pagging'){
            $length = $request->length != '' ? $request->length : 10;
            $pag = $query->skip($request->start)->take($length)->get();
            foreach ($pag as $key =>$value) {
                $btn = '<a href="javascript:void(0)" 
                    data-toggle="tooltip"  data-id="'.$value->zipcode_id.'" 
                    data-original-title="Edit" class="edit btn btn-primary btn-sm editZip">Edit</a>';
                
                $pag[$key]->DT_RowIndex = ($key+ 1)+$request->start;
                $pag[$key]->statusName = 'Active';
                $pag[$key]->action = $btn;
            }
            return $pag;
        } else if ($reqType == 'get'){
            return $query->get();
        } else if ($reqType == 'count'){
            return $query->count();
        } else if ($reqType == 'edit'){
            return $query->where('zipcode_id', $param)->first();
        }
    }   

}