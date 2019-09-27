<?php
namespace App\Helpers;
use Carbon\Carbon;
class Helper {

    public static function upload($file, $dir = 'upload_folder', $name ='') : String{
        $a = $file;
        if($name == ''){
            $now = Carbon::now();
            $name = $now->format('YmdHisu').'.jpg';
        }
        $a->move($dir, $name);
        return $dir.$name;
    }
}