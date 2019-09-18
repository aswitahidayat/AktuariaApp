<?php

namespace App\Models\Mortalita;

use Illuminate\Database\Eloquent\Model;

class MortalitaDtl extends Model
{
    protected $table = 'kka_dab.mst_mortalita_dtl';
    protected $primaryKey = 'mortalitadtl_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'mortalitadtl_hdrid', 'mortalitadtl_agework', 'mortalitadtl_percentage',
        'mortalitadtl_created_by', 'mortalitadtl_created_date',
        'mortalitadtl_updated_by', 'mortalitadtl_updated_date'
    ];
}
