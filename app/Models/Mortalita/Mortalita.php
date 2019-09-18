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
}
