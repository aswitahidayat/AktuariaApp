<?php

namespace App\Models\Register;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agent;
use DB;

class CompanyPartner extends Model
{
    protected $table = 'kka_dab.mst_bizpartner';
    protected $primaryKey = 'bizpart_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'bizpart_regisid','bizpart_num', 
        'bizpart_user_type',
        'bizpart_pic_email', 'bizpart_pic_name', 
        'bizpart_pic_typeid', 'bizpart_pic_idnum',
        'bizpart_pic_hp', 'bizpart_pic_birthplace',
        'bizpart_pic_birthdate', 'bizpart_pic_npwp',

        'bizpart_coy_name', 'bizpart_coytype_hdr', 'bizpart_coy_npwp',
        'bizpart_coy_addr', 'bizpart_coy_village', 'bizpart_coy_zipcodeid',
        'bizpart_coy_provid', 'bizpart_coy_disid', 'bizpart_coy_subdisid',
        'bizpart_coy_phone1', 'bizpart_coy_phone2', 'bizpart_coy_fax',
        'bizpart_coy_web', 'bizpart_coy_email',
        
        'bizpart_created_by', 'bizpart_created_date'
    ];

    public static function paging($request){
        $query = CompanyPartner::query();

        if($request->name != ''){
            $query->where('bizpart_coy_name', 'LIKE', "%$request->name%");
        }
        $query->whereNotNull('bizpart_coytype_hdr');
        

        $length = $request->length != '' ? $request->length : 10;
        $pag = $query->skip($request->start)->take($length)->get();
        return $pag;
    }

    public static function simpan($request){
        $exception = DB::transaction(function() use ($request) {
            $dataPartner = CompanyPartner::normalizePartner($request);
            $dataPartner['bizpart_created_by'] = 1;
            $dataPartner['bizpart_created_date'] = date(now());
            Partner::create($dataPartner);
        });
        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;
    }

    public static function edit($request){
        $exception = DB::transaction(function() use ($request) {

            $dataPartner = CompanyPartner::normalizePartner($request);

            CompanyPartner::
                    where('bizpart_id', $request->bizpart_id)
                    ->update($dataPartner);
        });
        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;
    }

    public static function normalizePartner($request){

        $result = [

            'bizpart_pic_email' => $request->bizpart_pic_email,
            'bizpart_pic_name' => $request->bizpart_pic_name, 
            'bizpart_pic_typeid' => $request->bizpart_pic_typeid, 
            'bizpart_pic_idnum' => $request->bizpart_pic_idnum,
            'bizpart_pic_hp' => $request->bizpart_pic_hp, 
            'bizpart_pic_birthplace' => $request->bizpart_pic_birthplace,
            'bizpart_pic_birthdate' => $request->bizpart_pic_birthdate, 
            'bizpart_pic_npwp' => $request->bizpart_pic_npwp,

            'bizpart_coy_name' => $request->bizpart_coy_name, 
            'bizpart_coytype_hdr' => $request->bizpart_coytype_hdr, 
            'bizpart_coy_npwp' => $request->bizpart_coy_npwp,
            'bizpart_coy_addr' => $request->bizpart_coy_addr, 
            'bizpart_coy_zipcode' => $request->bizpart_coy_zipcode,
            'bizpart_coy_provid' => $request->bizpart_coy_provid, 
            'bizpart_coy_disid' => $request->bizpart_coy_disid, 
            'bizpart_coy_subdisid' => $request->bizpart_coy_subdisid,
            'bizpart_coy_phone1' => $request->bizpart_coy_phone1, 
            'bizpart_coy_phone2' => $request->bizpart_coy_phone2, 
            'bizpart_coy_fax' => $request->bizpart_coy_fax,
            'bizpart_coy_web' => $request->bizpart_coy_web, 
            'bizpart_coy_email' => $request->bizpart_coy_email,
            'bizpart_num' => Agent::bizpartnum(),
            'bizpart_status' => $request->bizpart_status,

        ];

        return $result;
    }
}