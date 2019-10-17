<?php

namespace App\Models\Benefit;

use Illuminate\Database\Eloquent\Model;

class BenefitDtl extends Model
{
    protected $table = 'kka_dab.mst_benefit_dtl';
    protected $primaryKey = 'bendtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    public function benedit()
    {
        return $this->belongsTo('App\Models\Benefit\Benefit');
    }

    protected $fillable = [
        'bendtl_hdrid', 
        'bendtl_agework_year', 'bendtl_agework_month',
        'bendtl_severance', 'bendtl_appreciation', 'bendtl_split',
        'bendtl_created_by', 'bendtl_created_date',
        'bendtl_updated_by', 'bendtl_updated_date'
    ];
}
