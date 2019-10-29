<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function proses_word(){
        $template = new \PhpOffice\PhpWord\TemplateProcessor('assets/doc/template.docx');
        $template->setValue('name', 'John Doe');
        $template->saveAs('a.docx');
        return response()->download('a.docx')->deleteFileAfterSend(true);
    }

    public function process_pdf(){
        $domPdfPath = realpath(PHPWORD_BASE_DIR . '/../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $template = new \PhpOffice\PhpWord\TemplateProcessor('assets/doc/template.docx');
        $template->setValue('name', 'John Doe');
        $template->saveAs('a.docx');

        $phpWord = \PhpOffice\PhpWord\IOFactory::load('a.docx'); 
        //Save it
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
        $xmlWriter->save('result.pdf');  
        return response()->download('result.pdf')->deleteFileAfterSend(true);   
    }
}