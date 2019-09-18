<?php

namespace App\Models\Benefit;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'kka_dab.mst_benefit_hdr';
    protected $primaryKey = 'benhdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'benhdr_desc', 
        'benhdr_start_date', 'benhdr_end_date',
        'benhdr_created_by', 'benhdr_created_date',
        'benhdr_updated_by', 'benhdr_updated_date'
    ];
}
