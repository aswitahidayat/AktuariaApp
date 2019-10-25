<?php

namespace App\Models\Register;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'kka_dab.mst_bizpartner';
    protected $primaryKey = 'bizpart_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['bizpart_regisid','bizpart_num', 
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

}