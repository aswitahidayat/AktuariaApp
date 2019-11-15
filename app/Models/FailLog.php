<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailLog extends Model
{
    protected $table = 'kka_dab.job_fail';
    protected $primaryKey = 'fail_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

}
