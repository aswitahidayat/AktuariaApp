<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Identity;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class IdentityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Identity::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->typeid_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editIdentity">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->typeid_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteIdentity">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datamaster.identity.index');
    }

    public function store(Request $request)
    {
        if($request->typeid_id == ''){
            $data = new Identity();
            $data->typeid_name = $request->typeid_name;
            $data->typeid_desc = $request->typeid_desc;
            $data->typeid_status = $request->typeid_status;
            $data->typeid_created_by = 1;
            $data->typeid_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_type_identity')
                ->where('typeid_id', $request->typeid_id)
                ->update(['typeid_name' => $request->typeid_name,
                    'typeid_desc' => $request->typeid_desc,
                    'typeid_status' => $request->typeid_status]);
        }
        return response()->json(['success'=>'Identity saved successfully.']);
    }

    public function edit($typeid_id)
    {
        $identity = Identity::find($typeid_id);
        return response()->json($identity);
    }

    public function destroy($typeid_id)
    {
        Identity::find($typeid_id)->delete();
        return response()->json(['success'=>'Identity deleted successfully.']);
    }
}
