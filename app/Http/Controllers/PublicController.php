<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Identity;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\Zip;
use App\User;

use Illuminate\Http\Request;
use DataTables;
use DB;

class PublicController extends Controller
{
    public function searchCompany(Request $request){
        if($request->ajax())
        {
            $url = route('company.index');

            $query = Company::query();
            if($request->name != ''){
                $query->where('coytypehdr_name', 'LIKE',  "%$request->name%");
            }
            $data = $query->get();
            
            return response()->json($data);
        }
    }

    public function searchIdentity (Request $request){
        if($request->ajax())
        {
            $query = Identity::query();
            if($request->name != ''){
                $query->where('typeid_name', 'LIKE',  "%$request->name%");
            }
            $data = $query->get();

            return response()->json($data);
        }   
    }

    public function searchProvinsi(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $query = DB::table('kka_dab.mst_province');

            if($request->name != ''){
                $query->where('prov_name', 'LIKE', "%$request->name%");
            }

            $data =  $query->orderBy('prov_id')->get();

            return response()->json($data);
        }
    }

    public function searchDistrict(Request $request)
    {
        if ($request->ajax()) {
            $query =District::where('dis_name', 'LIKE', '%' . $request->q . "%");

            if($request->prov != ""){
                $query->where('dis_provid', '=', "$request->prov");
            }
            $data = $query->orderBy('dis_id')->get();
            return response()->json($data);
        }
    }

    public function searchSubDistrict(Request $request){
        // $cari = $request->cari;
        $query = SubDistrict::
        leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id');
        // ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

        // if($request->provid != ''){
        //     $query->where('kka_dab.mst_province.prov_id', $request->provid);
        // }

        if($request->dis != ''){
            $query->where('kka_dab.mst_district.dis_id', $request->dis);
        }

        if($request->name != ''){
            $query->where('subdis_name', 'LIKE', "%$request->name%");
        }

        // if($request->limit != ''){
        //     $query->skip(0)->take(10);
        // }

        $data =  $query->get();
        
        return response()->json($data);
    }

    public function searchZip(Request $request, $reqType ='', $param = ''){
        $query = Zip::
            leftJoin('kka_dab.mst_sub_district', 'zip_subdisid', '=', 'kka_dab.mst_sub_district.subdis_id');
            // ->leftJoin('kka_dab.mst_district', 'kka_dab.mst_sub_district.subdis_disid', '=', 'kka_dab.mst_district.dis_id')
            // ->leftJoin('kka_dab.mst_province', 'kka_dab.mst_district.dis_provid', '=', 'kka_dab.mst_province.prov_id');

        $query->raw("zip_status AS total");

        if($request->subdis != ''){
            $query->where('zip_subdisid', $request->subdis);
        }

        if($request->name != ''){
            $query->where('zipcode', 'LIKE', "%$request->name%");
        }

        
        $data =  $query->get();
        
        return response()->json($data);
    } 

    function register(Request $request){
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
            'regis_user_type' => 3,
            'regis_date' => $now,
            
            'regis_email' => $request->usremail,
            'regis_name' => $request->username,
            'regis_typeid' => $request->usridentity_type,
            'regis_id_num' => $request->usridentity_number,
            'regis_hp' => $request->usrphone,
            'regis_birthplace' => $request->usrbirth_place,
            'regis_birthdate' => $request->usrbirth_date,
            'regis_npwp' => $request->usrnpwp,

            'regis_coy_name' => $request->compname, 
            'regis_coytype_hdr' => $request->comptype, 
            'regis_coy_npwp' => $request->compnpwp,
            'regis_coy_addr' => $request->compaddress, 
            'regis_coy_zipcodeid' => $request->comppos,
            'regis_coy_provid' => $request->compprov,
            'regis_coy_disid' => $request->compkota,
            'regis_coy_subdisid' => $request->compkec,
            'regis_coy_phone1' => $request->compphone, 
            'regis_coy_fax' => $request->compfax,
            'regis_coy_web' => $request->compweb,
            'regis_coy_email' => $request->compemail,

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
            'bizpart_pic_email' => $request->usremail,
            'bizpart_pic_name' => $request->username,
            'bizpart_pic_hp' => $request->usrphone,
            'bizpart_pic_birthplace' => $request->usrbirth_place,
            'bizpart_pic_birthdate' => $request->usrbirth_date,
            'bizpart_pic_npwp' => $request->usrnpwp,

            'bizpart_coy_name' => $request->compname, 
            'bizpart_coytype_hdr' => $request->comptype, 
            'bizpart_coy_npwp' => $request->compnpwp,
            'bizpart_coy_addr' => $request->compaddress, 
            'bizpart_coy_zipcodeid' => $request->comppos,
            'bizpart_coy_provid' => $request->compprov, 
            'bizpart_coy_disid' => $request->compkota, 
            'bizpart_coy_subdisid' => $request->compkec,
            'bizpart_coy_phone1' => $request->compphone, 
            'bizpart_coy_fax' => $request->compfax,
            'bizpart_coy_web' => $request->compweb, 
            'bizpart_coy_email' => $request->compemail,

            'bizpart_created_by' => 1,
            'bizpart_created_date' => $now,
        ];

        return $result;
    }

    function normalizeUser(Request $request, $bizpart_id){
        $now = date(now());

        $result = [
            'user_bizpartid' => $bizpart_id,
            'user_type' => 3,
            'user_name' => $request->username,
            'email' => $request->usremail,
            'password' => Hash::make($request->usrpassword),
            'user_status' => 1,
            'user_created_by' => 1,
            'created_at' => $now
        ];

        return $result;
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
}