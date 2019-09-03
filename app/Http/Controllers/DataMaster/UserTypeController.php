<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\UserType;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = UserType::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->usertype_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUsertype">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->usertype_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUsertype">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datamaster.UserType.index');
    }

    public function store(Request $request)
    {
//        DB::table('groceries')
//            ->updateOrInsert(
//                ['id' => $request->id],
//                ['name' => $request->name, 'type' => $request->type, 'price' => 1000]
//            );
        if($request->usertype_id == ''){
            $data = new UserType();
            $data->usertype_name = $request->usertype_name;
            $data->usertype_desc = $request->usertype_desc;
            $data->usertype_status = $request->usertype_status;
            $data->usertype_created_by = 1;
            $data->usertype_created_date = date(now());
            $data->save();
//            DB::table('groceries')->insert(
//                ['name' => $request->name, 'type' => $request->type]
//            );
        }else{
            DB::table('kka_dab.mst_user_type')
                ->where('usertype_id', $request->usertype_id)
                ->update(['usertype_name' => $request->usertype_name,
                    'usertype_desc' => $request->usertype_desc,
                     'usertype_status' => $request->usertype_status]);
        }
        return response()->json(['success'=>'User Type saved successfully.']);
    }

    public function edit($usertype_id)
    {
        $utype = UserType::find($usertype_id);
        return response()->json($utype);
    }

    public function destroy($usertype_id)
    {
        UserType::find($usertype_id)->delete();
        return response()->json(['success'=>'User Type deleted successfully.']);
    }
}
