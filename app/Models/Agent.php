<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    private $name = "";
    private $email = "";
    private $identity_type = "";
    private $identity_number = "";
    private $hp= "";
    private $birthplace;
    private $birthdate;
    private $npwp;
    private $status;

    protected $table = 'kka_dab.user';
    protected $primaryKey = 'coytypedtlsub_id'; // or null

    public function createAgent($name, $email, $identity_type, $identity_number,
                    $hp, $birthplace, $birthdate, $npwp, $status) {

    }

}
