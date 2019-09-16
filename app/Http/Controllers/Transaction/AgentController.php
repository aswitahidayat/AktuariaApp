<?php
/**
 * Created by PhpStorm.
 * User: Shandy
 * Date: 4/22/2019
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;


class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $datas = User::paginate(10);

        return view('transaction.agent.index', compact('datas'));
    }

    public function search(Request $request)
    {
        $data = $this->agent($request, 'pagging');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAgent">Edit</a>';
                    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->vill_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteVillage">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->user_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function emailChecker(Request $request){
        if(sizeof(User::where('email','=', $request->email)->get()) > 0) {
            return response()->json([
                'success'=>0,
                'Message'=>'User email exists'
            ]);
        } 
        return response()->json([
            'success'=>1,
            'Message'=>'Email available'
        ]);
    }

    public function edit($id)
    {
        $data  = $this->agent( New Request(), 'edit', $id);
            
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->id == ''){
            $response = $this->agentTransaction($request);
        }else{
            
            Identity::
                where('typeid_id', $request->typeid_id)
                ->update(['typeid_name' => $request->typeid_name,
                    'typeid_desc' => $request->typeid_desc,
                    'typeid_status' => $request->typeid_status]);
        }
        return $response;
    }

    public function agent(Request $request, $reqType ='', $param = ''){
        $query = User::
            leftJoin('kka_dab.mst_bizpartner', 'user_bizpartid', '=', 'kka_dab.mst_bizpartner.bizpart_id')
            ->leftJoin('kka_dab.trn_regis', 'kka_dab.mst_bizpartner.bizpart_regisid', '=', 'kka_dab.trn_regis.regis_id');

        if($request->name != ''){
            $query->where('regis_name', 'LIKE', "%$request->name%");
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
            return $query->where('id', $param)->first();
        }
    }

    function agentTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            $dataRegist = $this->normalizeRegist($request);
            $q1 = Regist::create($dataRegist);

            $dataPartner = $this->normalizePartner($request, $q1->regis_id);
            $q2 = Partner::create($dataPartner);

            $dataUser = $this->normalizeUser($request, $q2->bizpart_id);
            $q3 = User::create($dataUser);
        });
        return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;

    }

    function agentEditTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            $dataRegist = $this->normalizeRegist($request);
            $q1 = Regist::create($dataRegist);

            $dataPartner = $this->normalizePartner($request, $q1->regis_id);
            $q2 = Partner::create($dataPartner);

            $dataUser = $this->normalizeUser($request, $q2->bizpart_id);
            $q3 = User::create($dataUser);
        });
        return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;
    }

    function normalizeRegist(Request $request){
        $now = date(now());

        $result = [
            'regis_num' => 3,
            'regis_activate_by' => 1,
            'regis_activate_date' => $now,
            'regis_user_type' => 2,
            'regis_date' => $now,
            'regis_email' => $request->agent_email,
            'regis_name' => $request->agent_name,
            'regis_typeid' => $request->type_identity,
            'regis_id_num' => $request->identity_number,

            'regis_hp' => $request->agent_phone,
            'regis_birthplace' => $request->agent_birth_place,
            'regis_birthdate' => $request->agent_birth_date,
            'regis_npwp' => $request->npwp,
            'regis_created_by' => 1,
            'regis_created_date' => $now,
        ];

        return $result;
    }

    function normalizePartner(Request $request, $regis_id){
        $now = date(now());

        $result = [
            'bizpart_regisid' => $regis_id,
            'bizpart_num' => 3,
            'bizpart_user_type' => 2,
            'bizpart_pic_email' => $request->agent_email,
            'bizpart_pic_name' => $request->agent_name,
            'bizpart_pic_hp' => $request->agent_phone,
            'bizpart_pic_birthplace' => $request->agent_birth_place,
            'bizpart_pic_birthdate' => $request->agent_birth_date,
            'bizpart_pic_npwp' => $request->npwp,
            'bizpart_created_by' => 1,
            'bizpart_created_date' => $now,
        ];

        return $result;
    }

    function normalizeUser(Request $request, $bizpart_id){
        $now = date(now());

        $result = [
            'user_bizpartid' => $bizpart_id,
            'user_type' => 2,
            'user_name' => $request->agent_email,
            'email' => $request->agent_email,
            'password' => Hash::make('sehati'),
            'user_status' => 1,
            'user_created_by' => 1,
            'created_at' => $now
        ];

        return $result;
    }
}
