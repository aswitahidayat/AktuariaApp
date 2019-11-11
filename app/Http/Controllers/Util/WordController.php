<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Dompdf;
use Dompdf\Dompdf;

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

    public function process_xls_by_html(Request $request){
        $html = isset($request->html) ? $request->html : '';
        $title = isset($request->title) ? $request->title : 'untitled';

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$title.xls");
        echo $html;
    }

    public function process_pdf_by_html(Request $request){
        $html = isset($request->html) ? $request->html : '';
        $title = isset($request->title) ? $request->title.".pdf" : 'untitled.pdf';

        $dompdf = new DomPDF();
        $dompdf->loadHtml($html);

        // // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // // Render the HTML as PDF
        $dompdf->render();
        // \Storage::put('invoice.pdf', $dompdf->output());

        // // Output the generated PDF to Browser
        // // $dompdf->stream($title);
        // return response()->download('a.pdf')->deleteFileAfterSend(true);
        // return $dompdf->stream('aa.pdf');
        $output = $dompdf->output();
        
        file_put_contents($title, $output);
        return response()->json($title);

    }


}