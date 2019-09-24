<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assumption extends Model
{
    protected $table = 'kka_dab.mst_assumption_template';
    protected $primaryKey = 'coytypehdr_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordass_hdrid', 'ordass_ordnum', 'ordass_periode',
        'ordass_sp', 'ordass_code',
        'ordass_value', 'coytypehdr_status', 'coytypehdr_created_by', 'coytypehdr_created_date'];
}
