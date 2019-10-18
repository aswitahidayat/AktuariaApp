<?php

namespace App\Models\Mortalita;

use Illuminate\Database\Eloquent\Model;

class Mortalita extends Model
{
    protected $table = 'kka_dab.mst_mortalita_hdr';
    protected $primaryKey = 'mortalitahdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'mortalitahdr_name', 'mortalitahdr_status',
        'mortalitahdr_created_by', 'mortalitahdr_created_date',
        'mortalitahdr_updated_by', 'mortalitahdr_updated_date'
    ];

    public static function detail($id) {
        $file = Mortalita::find($id);
        $file['detailCount'] = Mortalita::find($id)->countDetail();
        $file['detail'] = Mortalita::find($id)->getDetail;
        return $file;
    }

    public static function createData($request){
        return Mortalita::create([
            'mortalitahdr_name' => $request->mortalitahdr_name,
            'mortalitahdr_status' => 1,
            'mortalitahdr_created_by' => 1,
            'mortalitahdr_created_date' => date(now())
        ]); 
    }

    public static function updateData($request){
        return Mortalita::where('mortalitahdr_id', $request->mortalitahdr_id)
                ->update(['mortalitahdr_name' => $request->mortalitahdr_name,
                    'mortalitahdr_status' => $request->mortalitahdr_status,
                    'mortalitahdr_updated_date' => date(now())
                ]);
    }

    public function getDetail() {
        return $this->hasMany('App\Models\Mortalita\MortalitaDtl', 'mortalitadtl_hdrid')->orderBy('mortalitadtl_id');
    }

    public function countDetail() {
        return $this->hasMany('App\Models\Mortalita\MortalitaDtl', 'mortalitadtl_hdrid')->count();
    }
}
