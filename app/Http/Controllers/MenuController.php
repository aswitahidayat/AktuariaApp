<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuPermition;
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
        $dataReturn = Menu::find($usertype_id);
        $dataReturn['permit'] = Menu::editPermit($usertype_id);
        return response()->json($dataReturn);
    }

    public function store(Request $request)
    {
        if($request->mn_id == ''){
            $q =  Menu::create([

                'mn_name' => $request->mn_name,
                'mn_status' => $request->mn_status,
                'mn_parent' => $request->mn_parent,
                'mn_link' => $request->mn_link,
                'mn_order' => $request->mn_order,
    
                'usertype_created_by' => Auth::id(),
                'usertype_created_date' => date(now()),
            ]);
            $this->checkPremit ($q->mn_id, $request->permit);
        }else{
            Menu::where('mn_id', $request->mn_id)
                ->update(['mn_name' => $request->mn_name,
                    'mn_status' => $request->mn_status,
                     'mn_parent' => $request->mn_parent,
                     'mn_link' => $request->mn_link,
                     'mn_order' => $request->mn_order,
                     ]);

            $this->checkPremit ($request->mn_id, $request->permit);            
        }
        return response()->json(['success'=>'User Type saved successfully.']);
    }

    public function checkPremit($mn_id = '', $usertype_id = ''){
        if ($mn_id != '' && $usertype_id  != ''){
            //delete
            $delquery = MenuPermition::where('mnp_mn', $mn_id);
            if(count($usertype_id) >0){
                $delquery->whereNotIn('mnp_usrt', $usertype_id);
            }

            $delquery->delete();

            if(count($usertype_id) >0){

                foreach ($usertype_id as $key =>$row) {
                    $query2 = MenuPermition::where('mnp_mn', $mn_id)->where('mnp_usrt', $row)->count();
                    if($query2 == 0 ){
                        $this->insertpremit($mn_id, $row);
                    }
                }
            }
        } else {
            MenuPermition::where('mnp_mn', $mn_id)->delete();
        }
    }

    function insertpremit($mn_id, $mnp_usrt){
        $cd = MenuPermition::insert([
                'mnp_mn' => $mn_id,
                'mnp_usrt' => $mnp_usrt,
            ]);
    }

    function findParent(){
        $dataReturn = Menu::where('mn_parent', 0)->get();
        return response()->json($dataReturn);
    }
}