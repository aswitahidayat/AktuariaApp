<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(){
		return view('upload');
	}

	public function proses_upload($file, $tujuan_upload = 'upload_folder'){
		// $this->validate($request, [
		// 	'file' => 'required',
		// 	'keterangan' => 'required',
		// ]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $file;

      	//         // nama file
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';

      	//         // ekstensi file
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';

      	//         // real path
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';

      	//         // ukuran file
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';

      	        // tipe mime
		// echo 'File Mime Type: '.$file->getMimeType();

      	        // isi dengan nama folder tempat kemana file diupload
		
        
        $now = Carbon::now();
        $unique_code = $now->format('YmdHisu');
                // upload file
        $file->move($tujuan_upload, $unique_code);

	}
}