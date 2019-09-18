<?php

namespace App\Models\Benefit;

use Illuminate\Database\Eloquent\Model;

class BenefitDtl extends Model
{
    protected $table = 'kka_dab.mst_benefit_dtl';
    protected $primaryKey = 'bendtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'bendtl_hdrid', 
        'bendtl_agework_year', 'bendtl_agework_month',
        'bendtl_severance', 'bendtl_appreciation', 'bendtl_split',
        'benhdr_created_by', 'benhdr_created_date',
        'benhdr_updated_by', 'benhdr_updated_date'
    ];
}
