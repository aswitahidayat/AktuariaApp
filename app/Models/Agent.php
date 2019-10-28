<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\Register\Regist;
use App\Models\Register\Partner;
use Illuminate\Http\Request;
use App\User;
use DataTables;
use DB;

class Agent extends Model
{
    private $name = "";
    private $email = "";
    private $identity_type = "";
    private $identity_number = "";
    private $hp= "";
    private $birthplace;
    private $birthdate;
    private $npwp;
    private $status;

    protected $table = 'kka_dab.user';
    protected $primaryKey = 'coytypedtlsub_id'; // or null

    public function createAgent($name, $email, $identity_type, $identity_number,
                    $hp, $birthplace, $birthdate, $npwp, $status) {

    }

    public static function findAgent(Request $request, $reqType ='', $param = '', $isPic = false){
        $query = User::
            leftJoin('kka_dab.mst_bizpartner', 'user_bizpartid', '=', 'kka_dab.mst_bizpartner.bizpart_id')
            ->leftJoin('kka_dab.trn_regis', 'kka_dab.mst_bizpartner.bizpart_regisid', '=', 'kka_dab.trn_regis.regis_id');

        if($request->name != ''){
            $query->where('regis_name', 'LIKE', "%$request->name%");
        }

        if($isPic == true){
            $query->where('user_type', "3");
        } else {
            $query->where('user_type', "2");
        }

        if($reqType == 'pagging'){
            $length = $request->length != '' ? $request->length : 10;
            $pag = $query->skip($request->start)->take($length)->get();
            foreach ($pag as $key =>$value) {
                $btn = '<a href="javascript:void(0)" 
                    data-toggle="tooltip"  data-id="'.$value->regis_id.'" 
                    data-original-title="Edit" class="edit btn btn-primary btn-sm editAgent">Edit</a>';
                
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
            return $query->where('regis_id', $param)->first();
        }
    }

    public static function agentTransaction(Request $request, $isPic = false){
        $exception = DB::transaction(function() use ($request, $isPic) {
            $dataRegist = Agent::normalizeRegist($request, false, $isPic);
            $q1 = Regist::create($dataRegist);

            $dataPartner = Agent::normalizePartner($request, $q1->regis_id, false);
            $q2 = Partner::create($dataPartner);
            
            $dataUser = Agent::normalizeUser($request, $q2->bizpart_id, false,$isPic);
            $q3 = User::create($dataUser);
        });
        return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;

    }

    public static function agentEditTransaction(Request $request, $isPic = false){
        $exception = DB::transaction(function() use ($request, $isPic) {
            $dataRegist = Agent::normalizeRegist($request, true, $isPic);
            $q1 = Regist::where('regis_id', $request->regis_id)->update($dataRegist);

            $dataPartner = Agent::normalizePartner($request, '', true);
            $q2 = Partner::where('bizpart_id', $request->bizpart_id)->update($dataPartner);

            $dataUser = Agent::normalizeUser($request, '', true, $isPic);
            $q3 = User::where('user_id', $request->user_id)->update($dataUser);
        });
        return is_null($exception) ? response()->json(['success'=>'Agent saved successfully.']) : $exception;
    }

    public static function normalizeRegist(Request $request, $isEdit = '', $isPic){
        $now = date(now());

        $result = [
            'regis_email' => $request->agent_email,
            'regis_name' => $request->agent_name,
            'regis_typeid' => $request->type_identity,
            'regis_id_num' => $request->identity_number,

            'regis_hp' => $request->agent_phone,
            'regis_birthplace' => $request->agent_birth_place,
            'regis_birthdate' => $request->agent_birth_date,
            'regis_npwp' => $request->npwp,
        ];

        if($isEdit == ''){
            $result['regis_num'] = Agent::regnum();
            $result['regis_activate_by'] = 1;
            $result['regis_activate_date'] = $now;
            $result['regis_user_type'] = 2;
            $result['regis_date'] = $now;
            $result['regis_created_by'] = 1;
            $result['regis_created_date'] = $now;
        }

        return $result;
    }


    /*
        PIC ga perlu normalize partner
    */
    public static function normalizePartner(Request $request, $regis_id, $isEdit = ''){
        $now = date(now());

        $result = [
            'bizpart_pic_email' => $request->agent_email,
            'bizpart_pic_name' => $request->agent_name,
            'bizpart_pic_hp' => $request->agent_phone,
            'bizpart_pic_birthplace' => $request->agent_birth_place,
            'bizpart_pic_birthdate' => $request->agent_birth_date,
            'bizpart_pic_npwp' => $request->npwp,

            'bizpart_pic_typeid' => $request->type_identity,
            'bizpart_pic_idnum' => $request->identity_number,
        ];

        if($isEdit == ''){
            $result['bizpart_regisid'] = $regis_id;
            $result['bizpart_num'] = Agent::bizpartnum();

            $result['bizpart_user_type'] = 2;

            $result['bizpart_created_by'] = 1;
            $result['bizpart_created_date'] = $now;
        }

        return $result;
    }

    public static function normalizeUser(Request $request, $bizpart_id, $isEdit = '', $isPic = false){
        $now = date(now());

        $result = [
            'user_name' => $request->agent_name,
            'user_email' => $request->agent_email,
        ];

        if($isEdit == ''){
            $result['user_bizpartid'] = $bizpart_id;
            $result['user_type'] = $isPic == true ? 3 : 2;
            $result['user_password'] = Hash::make('sehati');
            $result['user_status'] = 1;

            $result['user_created_by'] = 1;
            $result['user_created_date'] = $now;
        }

        return $result;
    }

    public static function bizpartnum():?string 
    {
        $str = "AGN";
        $year= date("Y");
        $count = str_pad( 1, 5, "0", STR_PAD_LEFT );
        $q = Partner::where('bizpart_num', 'LIKE', "%$year%")
        ->orderBy('bizpart_created_date', 'desc')->first();
        if(isset($q->bizpart_num)){
            $var2 = str_replace($year.$str,"",$q->bizpart_num);
            $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
        }

        return $year.$str.$count;
    }

    public static function bizpartpic():?string 
    {
        $str = "PIC";
        $year= date("Y");
        $count = str_pad( 1, 5, "0", STR_PAD_LEFT );
        $q = Partner::where('bizpart_num', 'LIKE', "%$year%")
        ->orderBy('bizpart_id', 'desc')->first();
        if(isset($q->bizpart_num)){
            $var2 = str_replace($year.$str,"",$q->bizpart_num);
            $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
        }

        return $year.$str.$count;
    }

    public static function regnum():?string 
    {
        $str = "REG";
        $year= date("Y");
        $count = str_pad( 1, 5, "0", STR_PAD_LEFT );
        $q = DB::table('kka_dab.trn_regis')->where('regis_num', 'LIKE', "%$year%")
        ->orderBy('regis_id', 'desc')->first();
        if(isset($q->regis_num)){
            $var2 = str_replace($year.$str,"",$q->regis_num);
            $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
        }

        return $year.$str.$count;
    }
}
