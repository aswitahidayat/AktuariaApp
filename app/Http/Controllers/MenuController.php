<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    function index(){
        return view('datamaster.menu.menuindex');
    } 

    public function search(){
        $data = Menu::findPermition();
        $dataReturn = [];
        foreach ($data as $key=>$val) {
            if($val->mn_parent == 0){
                $val->child = [];
                $dataReturn[] = $val;
            } else {
                $key = array_search($val->mn_parent, array_column($dataReturn, 'mn_id'));
                $dataReturn[$key]->child = 
                    array_merge( $dataReturn[$key]->child, array($val));
            }
        }

        return (array) $dataReturn;
    }

    public function searchview(Request $request){
        $b['data'] = $this->findMenu($request, 'pagging');
        $b['recordsFiltered']= $this->findMenu($request, 'count');
        $b['recordsTotal']= $this->findMenu($request, 'count');

        return $b;
    }

    function findMenu(Request $request, $reqType ='', $param = '', $isPic = false){
        $query = Menu::query();

        if($request->name != ''){
            $query->where('mn_name', 'LIKE', "%$request->name%");
        }

        if($reqType == 'pagging'){
            $length = $request->length != '' ? $request->length : 10;
            $pag = $query->skip($request->start)->take($length)->get();
            foreach ($pag as $key =>$value) {
                $btn = '<a href="javascript:void(0)" 
                    data-toggle="tooltip"  data-id="'.$value->mn_id.'" 
                    data-original-title="Edit" class="edit btn btn-primary btn-sm editMenu">Edit</a>';
                
                $pag[$key]->DT_RowIndex = ($key+ 1)+$request->start;
                $pag[$key]->mn_status_name = $value->mn_status == 1 ? "Active" : "Inactive";
                $pag[$key]->action = $btn;
            }
            return $pag;
        } else if ($reqType == 'get'){
            return $query->get();
        } else if ($reqType == 'count'){
            return $query->count();
        } else if ($reqType == 'edit'){
            return $query->where('regis_id', $param)->first();
        }
    }

    public function edit($usertype_id)
    {
        $utype = Menu::find($usertype_id);
        $utype['permit'] = Menu::editPermit($usertype_id);
        return response()->json($utype);
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
}