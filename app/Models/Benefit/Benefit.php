<?php

namespace App\Models\Benefit;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'kka_dab.mst_benefit_hdr';
    protected $primaryKey = 'benhdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    public static function detail($id) {
        $file = Benefit::find($id);
        $file['detailCount'] = Benefit::find($id)->countDetail();
        $file['detail'] = Benefit::find($id)->getDetail;
        return $file;
    }

    public static function createData($request){
        $request->validate([
            'benhdr_desc' => 'required|max:255',
            'benhdr_start_date' => 'required|date',
            'benhdr_end_date' => 'required|date',
        ]);

        return Benefit::create([
            'benhdr_desc' => $request->benhdr_desc,
            'benhdr_start_date' => $request->benhdr_start_date,
            'benhdr_end_date' => $request->benhdr_end_date,
            'benhdr_created_by' => 1,
            'benhdr_created_date' => date(now())
        ]);
    }
    public static function editData($request){
        return Benefit::where('benhdr_id', $request->benhdr_id)
                ->update(['benhdr_desc' => $request->benhdr_desc,
                    'benhdr_updated_date' => date(now())
                ]);
    }

    public function getDetail() {
        return $this->hasMany('App\Models\Benefit\BenefitDtl', 'bendtl_hdrid')->orderBy('bendtl_id');
    }

    public function countDetail() {
        return $this->hasMany('App\Models\Benefit\BenefitDtl', 'bendtl_hdrid')->count();
    }

    protected $fillable = [
        'benhdr_desc', 
        'benhdr_start_date', 'benhdr_end_date',
        'benhdr_created_by', 'benhdr_created_date',
        'benhdr_updated_by', 'benhdr_updated_date'
    ];
}
