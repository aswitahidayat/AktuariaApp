<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\AdminController;
use App\Models\UserType;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class UserTypeController extends AdminController
{
    public function index(Request $request)
    {
        return view('datamaster.usertype.usertypeindex');
    }

    public function search(Request $request)
    {
        $query = UserType::query();

        if($request->name != ''){
            $query->where('usertype_name', 'LIKE',  "%$request->name%");
        }

        $length = $request->length != '' ? $request->length : 10;
        $query->skip($request->start)->take($length)->get();

        $data = $query->orderBy('usertype_id')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->usertype_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUserType">Edit</a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->usertype_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUsertype">Delete</a>';
                return $btn;
            })
            ->addColumn('statusName', function($row){
                $btn = $row->usertype_status == 1 ? "Active" : "Inactive" ;
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function store(Request $request)
    {
        if($request->usertype_id == ''){
            $data = new UserType();
            $data->usertype_name = $request->usertype_name;
            $data->usertype_desc = $request->usertype_desc;
            $data->usertype_status = $request->usertype_status;
            $data->usertype_created_by = Auth::id();
            $data->usertype_created_date = date(now());
            $data->save();
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
