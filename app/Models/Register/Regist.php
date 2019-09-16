<?php

namespace App\Models\Register;

use Illuminate\Database\Eloquent\Model;

class Regist extends Model
{
    protected $table = 'kka_dab.trn_regis';
    protected $primaryKey = 'regis_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['regis_num','regis_activate_by', 
        'regis_activate_date', 'regis_user_type', 'regis_date',
        'regis_email', 'regis_name', 'regis_typeid', 'regis_id_num',
        'regis_hp', 'regis_birthplace',
        'regis_birthdate', 'regis_npwp',

        'regis_coy_name', 'regis_coytype_hdr', 'regis_coy_npwp',
        'regis_coy_addr', 'regis_coy_village', 'regis_coy_zipcodeid',
        'regis_coy_provid', 'regis_coy_disid', 'regis_coy_subdisid',
        'regis_coy_phone1', 'regis_coy_phone2', 'regis_coy_fax',
        'regis_coy_web',  'regis_coy_email',
        
        'regis_created_by', 'regis_created_date'
    ];

    public function createRegistData(Request $request)
    {

        $now = date(now());

        $result = [
            'regis_num' => 2,
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
}
