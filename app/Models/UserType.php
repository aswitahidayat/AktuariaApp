<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'kka_dab.mst_user_type';
    protected $primaryKey = 'usertype_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

}
