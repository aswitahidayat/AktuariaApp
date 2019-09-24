<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderAssumption extends Model
{
    protected $table = 'kka_dab.trn_order_assumption';
    protected $primaryKey = 'ordass_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ordass_hdrid', 'ordass_ordnum', 'ordass_periode',
        'ordass_sp', 'ordass_code',
        'ordass_value', 
        'ordass_created_by', 'ordass_created_date'];
}
