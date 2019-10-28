<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Hash;
use App\User;

use App\Models\Agent;
use App\Models\Register\Regist;
use App\Models\Register\Partner;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;


class AgentController extends AdminController
{
    public function index()
    {
        return view('transaction.agent.agentIndex');
    }

    public function search(Request $request)
    {
        $b['data'] = Agent::findAgent($request, 'pagging');
        $b['recordsFiltered']= Agent::findAgent($request, 'count');
        $b['recordsTotal']= Agent::findAgent($request, 'count');

        return $b;
    }

    public function emailChecker(Request $request){
        if(sizeof(User::where('user_email','=', $request->email)->get()) > 0) {
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
        $data = Agent::findAgent(new Request, 'edit', $id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->user_id == ''){
            $response = Agent::agentTransaction($request);
        }else{
            $response = Agent::agentEditTransaction($request);            
        }
        return $response;
    }

    // public function agent(Request $request, $reqType ='', $param = '', $isPic = false){
    //     $query = User::
    //         leftJoin('kka_dab.mst_bizpartner', 'user_bizpartid', '=', 'kka_dab.mst_bizpartner.bizpart_id')
    //         ->leftJoin('kka_dab.trn_regis', 'kka_dab.mst_bizpartner.bizpart_regisid', '=', 'kka_dab.trn_regis.regis_id');

    //     if($request->name != ''){
    //         $query->where('regis_name', 'LIKE', "%$request->name%");
    //     }

    //     if($isPic == true){
    //         $query->where('user_type', "3");
    //     } else {
    //         $query->where('user_type', "2");
    //     }

    //     if($reqType == 'pagging'){
    //         $length = $request->length != '' ? $request->length : 10;
    //         $pag = $query->skip($request->start)->take($length)->get();
    //         // foreach ($pag as $key =>$value) {
    //         //     $btn = '<a href="javascript:void(0)" 
    //         //         data-toggle="tooltip"  data-id="'.$value->zipcode_id.'" 
    //         //         data-original-title="Edit" class="edit btn btn-primary btn-sm editZip">Edit</a>';
                
    //         //     $pag[$key]->DT_RowIndex = ($key+ 1)+$request->start;
    //         //     $pag[$key]->statusName = 'Active';
    //         //     $pag[$key]->action = $btn;
    //         // }
    //         return $pag;
    //     } else if ($reqType == 'get'){
    //         return $query->get();
    //     } else if ($reqType == 'count'){
    //         return $query->count();
    //     } else if ($reqType == 'edit'){
    //         return $query->where('regis_id', $param)->first();
    //     }
    // }

    // function agentTransaction(Request $request, $isPic = false){
    //     $exception = DB::transaction(function() use ($request, $isPic) {
    //         $dataRegist = $this->normalizeRegist($request, $isPic);
    //         $q1 = Regist::create($dataRegist);

    //         $dataPartner = $this->normalizePartner($request, $q1->regis_id, $isPic);
    //         $q2 = Partner::create($dataPartner);

    //         $dataUser = $this->normalizeUser($request, $q2->bizpart_id, $isPic);
    //         $q3 = User::create($dataUser);
    //     });
    //     return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;

    // }

    // function agentEditTransaction(Request $request, $isPic = false){
    //     $exception = DB::transaction(function() use ($request, $isPic) {
    //         $dataRegist = $this->normalizeRegist($request, true, $isPic);
    //         $q1 = Regist::where('regis_id', $request->regis_id)->update($dataRegist);

    //         $dataPartner = $this->normalizePartner($request, '', true);
    //         $q2 = Partner::where('bizpart_id', $request->bizpart_id)->update($dataPartner);

    //         $dataUser = $this->normalizeUser($request, '', true);
    //         $q3 = User::where('user_id', $request->user_id)->update($dataUser);
    //     });
    //     return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;
    // }

    // function normalizeRegist(Request $request, $isEdit = '', $isPic){
    //     $now = date(now());

    //     $result = [
    //         'regis_email' => $request->agent_email,
    //         'regis_name' => $request->agent_name,
    //         'regis_typeid' => $request->type_identity,
    //         'regis_id_num' => $request->identity_number,

    //         'regis_hp' => $request->agent_phone,
    //         'regis_birthplace' => $request->agent_birth_place,
    //         'regis_birthdate' => $request->agent_birth_date,
    //         'regis_npwp' => $request->npwp,
    //     ];

    //     if($isEdit == ''){
    //         $result['regis_num'] = $this->regnum();
    //         $result['regis_activate_by'] = 1;
    //         $result['regis_activate_date'] = $now;
    //         $result['regis_user_type'] = 2;
    //         $result['regis_date'] = $now;
    //         $result['regis_created_by'] = 1;
    //         $result['regis_created_date'] = $now;
    //     }

    //     return $result;
    // }

    // function normalizePartner(Request $request, $regis_id, $isEdit = ''){
    //     $now = date(now());

    //     $result = [
    //         'bizpart_pic_email' => $request->agent_email,
    //         'bizpart_pic_name' => $request->agent_name,
    //         'bizpart_pic_hp' => $request->agent_phone,
    //         'bizpart_pic_birthplace' => $request->agent_birth_place,
    //         'bizpart_pic_birthdate' => $request->agent_birth_date,
    //         'bizpart_pic_npwp' => $request->npwp,

    //         'bizpart_pic_typeid' => $request->type_identity,
    //         'bizpart_pic_idnum' => $request->identity_number,
    //     ];

    //     if($isEdit == ''){
    //         $result['bizpart_regisid'] = $regis_id;
    //         $result['bizpart_num'] = $this->bizpartnum();
    //         $result['bizpart_user_type'] = 2;

    //         $result['bizpart_created_by'] = 1;
    //         $result['bizpart_created_date'] = $now;
    //     }

    //     return $result;
    // }

    // function normalizeUser(Request $request, $bizpart_id, $isEdit = ''){
    //     $now = date(now());

    //     $result = [
    //         'user_name' => $request->agent_email,
    //         'user_email' => $request->agent_email,
    //     ];

    //     if($isEdit == ''){
    //         $result['user_bizpartid'] = $bizpart_id;
    //         $result['user_type'] = 2;
    //         $result['user_password'] = Hash::make('sehati');
    //         $result['user_status'] = 1;

    //         $result['user_created_by'] = 1;
    //         $result['user_created_date'] = $now;
    //     }

    //     return $result;
    // }

    // public function bizpartnum():?string 
    // {
    //     $str = "AGN";
    //     $year= date("Y");
    //     $count = str_pad( 1, 5, "0", STR_PAD_LEFT );
    //     $q = Partner::where('bizpart_num', 'LIKE', "%$year%")
    //     ->orderBy('bizpart_id', 'desc')->first();
    //     if(isset($q->bizpart_num)){
    //         $var2 = str_replace($year.$str,"",$q->bizpart_num);
    //         $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
    //     }

    //     return $year.$str.$count;
    // }

    // public function regnum():?string 
    // {
    //     $str = "REG";
    //     $year= date("Y");
    //     $count = str_pad( 1, 5, "0", STR_PAD_LEFT );
    //     $q = DB::table('kka_dab.trn_regis')->where('regis_num', 'LIKE', "%$year%")
    //     ->orderBy('regis_id', 'desc')->first();
    //     if(isset($q->regis_num)){
    //         $var2 = str_replace($year.$str,"",$q->regis_num);
    //         $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
    //     }

    //     return $year.$str.$count;
    // }
}
