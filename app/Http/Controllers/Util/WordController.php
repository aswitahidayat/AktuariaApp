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

    public function a(){
        $dompdf = new DomPDF();
        $a = '
            <table>
            <tbody>
                <tr><td style="text-align:center;" colspan="100%"><strong>Perusahaan Agent</strong></td></tr>
                <tr>
                    <td colspan="4"></td>
                <td>2018</td><td>2017</td><td></td></tr>
                <tr>
                    <td colspan="4">
                        <strong>A. Data untuk Perhitungan</strong>
                    </td> 
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Data Pegawai</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">a. Jumlah Pegawai</td>
                <td>2</td><td>2</td><td>orang</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>* Pegawai di bawah usia pensiun</td>
                <td>0</td><td>0</td><td>orang</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>* Pegawai di atas usia pensiun</td>
                <td>2</td><td>2</td><td>orang</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">b. Jumlah Upah Sebulan</td>
                <td>3,700,000.00</td><td>3,363,636.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>* Pegawai di bawah usia pensiun</td>
                <td>0.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>* Pegawai di atas usia pensiun</td>
                <td>3,700,000.00</td><td>3,363,636.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">c. * Rata-rata usia di bawah usia pensiun</td>
                <td>0.00</td><td>0.00</td><td>tahun</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>* Rata-rata usia di atas usia pensiun</td>
                <td>31.52</td><td>30.52</td><td>tahun</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">d. Rata-rata masa kerja lalu</td>
                <td>7.76</td><td>6.76</td><td>tahun</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">e. Perkiraan rata-rata masa kerja yang akan datang di bawah usia pensiun</td>
                <td>23.48</td><td>24.48</td><td>tahun</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Asumsi Aktuaria</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">a. Tingkat Diskonto (IBPA Per Tgl 30-Sept-2018)</td>
                <td>1.00%</td><td>1.00%</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">b. Tingkat Pengembalian Aset Program yang Diharapkan</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">c. Tingkat Kenaikan Upah</td>
                <td>10.00%</td><td>10.00%</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">d. Tingkat Mortalita</td>
                <td>TMI-3</td><td>TMI-3</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">e. Tingkat Cacat  ( % TMI-3)</td>
                <td>3.00</td><td>3.00</td><td></td></tr>
                
                <tr><td></td><td></td><td colspan="2">f. Tingkat Pengunduran Diri</td><td colspan="3"></td></tr><tr><td></td><td></td><td></td><td>18 - 30</td><td>2.00%</td><td>2.00%</td><td></td></tr><tr><td></td><td></td><td></td><td>31 - 40</td><td>2.00%</td><td>2.00%</td><td></td></tr><tr><td></td><td></td><td></td><td>41 - 45</td><td>1.00%</td><td>1.00%</td><td></td></tr><tr><td></td><td></td><td></td><td>46 - 53</td><td>0.50%</td><td>0.50%</td><td></td></tr><tr><td></td><td></td><td></td><td>54 - 100</td><td>0.00%</td><td>0.00%</td><td></td></tr><tr>
                    <td></td>
                    <td colspan="3">3. Metode Penilaian Aktuaria</td>
                <td>PUC</td><td>PUC</td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Usia Pensiun Normal</td>
                <td>55</td><td>55</td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Nilai Kini Kewajiban </td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Awal Periode</td>
                <td>208,839,784.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">* Pegawai di bawah usia pensiun</td>
                <td>208,839,784.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">* Pegawai di atas usia pensiun</td>
                <td>0.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Akhir Periode</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">* Pegawai di bawah usia pensiun</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2"> * Pegawai di atas usia pensiun</td>
                <td>0.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Nilai Wajar Aset Program</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Awal Periode</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Akhir Periode</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">7. Iuran Perusahaan</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">8. Imbalan Kerja yang dibayarkan</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Total Imbalan Kerja yang dibayarkan</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">- Imbalan Kerja yang dibayarkan oleh Perusahaan</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">- Imbalan Kerja yang dibayarkan oleh Aset Program</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Selisih Imbalan Kerja yang Masih Menjadi Beban</td>
                <td>0</td><td>0</td><td></td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>B. Perhitungan Aktuaria</strong></td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Nilai Kini Kewajiban, Awal Periode</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Nilai Wajar Aset Program, Awal Periode</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Biaya jasa lalu yang telah diakui</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Biaya jasa lalu imbalan yang belum diakui</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Amortisasi Biaya Jasa Lalu yang belum diakui</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">7. Nilai Kini Kewajiban, Akhir Periode</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">8. Biaya Jasa Kini</td>  
                <td>29,057,877.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">9. Periode rata-rata manfaat menjadi diakui</td>
                <td>31.23</td><td>31.23</td><td>tahun</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>C. Jumlah yang Diakui dalam Laporan Laba Rugi; Paragraf 57(c) PSAK 24 Rev 2013</strong></td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Biaya Jasa Kini
                    </td>
                <td>29,057,877.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Biaya Jasa Lalu Atas Kurtailment/Penyelesaian</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. (Keuntungan)/Kerugian Atas Kurtailment/Penyelesaian</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td>4.</td>
                    <td colspan="2">- Biaya Bunga atas Nilai Kini Kewajiban</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">- Penghasilan/Biaya Bunga atas Nilai Wajar Aset Program</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">- Biaya Bunga atas batas atas aset</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Dampak Mutasi Pegawai</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Pengakuan segera (Keuntungan)/Kerugian Aktuaria</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">7. Biaya Jasa Lalu yang telah diakui</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">8. Beban/(Pendapatan) yang diakui dalam Laporan Laba Rugi</td>
                <td>269,043,942.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">9.Selisih Imbalan Kerja yang Masih Menjadi Beban</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">10. Beban/(Pendapatan) yang seharusnya diakui dalam Lap. Laba Rugi</td>
                <td>269,043,942.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">D. Jumlah yang Diakui dalam Lap. Keu. Neraca</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Nilai Kini Kewajiban </td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Nilai Wajar Aset Program</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Status Pendanaan</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Perubahan Dampak Batas Atas Aset</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Liabilitas/Aset yang Diakui dalam Lap. Keu. Neraca</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>            
                </tr>
                <tr>
                    <td colspan="4">E. Perubahan yang Diakui dalam Lap. Keuangan (Neraca)</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. (Aset)/Kewajiban pada, Awal Periode</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Beban/(pendapatan) yang diakui dalam Laporan Laba Rugi</td>
                <td>269,043,942.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Beban/(pendapatan) yang diakui dalam Penghasilan Komprehensif Lain</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Iuran Perusahaan</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Imbalan Kerja yang dibayarkan oleh Perusahaan</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. (Aset)/Kewajiban pada, Akhir Periode</td>
                <td>269,043,942.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="9">Rekonsiliasi saldo awal ke saldo akhir Paragraf 140-141 PSAK 24 Revisi 2013</td>
                </tr>
                <tr>
                    <td colspan="4">I Rekonsiliasi Nilai Kini Kewajiban</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Nilai Kini Kewajiban, Awal Periode</td>
                <td>208,839,784.00</td><td>0.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Biaya Jasa Kini</td>
                <td>29,057,877.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Biaya Bunga atas Nilai Kini Kewajiban</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Biaya Jasa Lalu &amp; (Keuntungan)/Kerugian Aktuaria atas kurtailment dan penyelesaian</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Dampak Kombinasi dan Pelepasan Bisnis</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">7. Nilai Kini Kewajiban yang diharapkan, Akhir Periode</td>
                <td>477,883,726.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">8. (Keuntungan)/Kerugian aktuarial atas Kewajiban</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">9. - Dampak Perubahan Asumsi Keuangan</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">10. - Dampak Perubahan Asumsi Demografi</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">11. - Penyesuaian atas Pengalaman (Experienced Adjustment)</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">12. Nilai Kini Kewajiban, Akhir Periode</td>
                <td>477,883,726.00</td><td>237,609,959.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">II Rekonsiliasi Nilai Wajar Aset Program</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Nilai Wajar Aset Program, Awal Periode</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Penghasilan/Biaya Bunga atas Nilai Wajar Aset Program</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Iuran Pegawai</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Iuran Perusahaan</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Perubahan Kurs Valuta Asing</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Imbalan Kerja yang dibayarkan oleh Aset Program</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">7. Kombinasi Bisnis</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">8. Penyelesaian</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">9. Nilai Wajar Aset Program yang diharapkan, Akhir Periode</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">10. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">11. Nilai Wajar Aset Program, Akhir Periode</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">III Total Keuntungan/(Kerugian) Aktuaria tahun berjalan</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Ekspektasi Pembayaran Imbalan Paska Kerja</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Keuntungan/(Kerugian) aktuarial atas Imbalan Kerja</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Pembayaran Imbalan Paska Kerja Sebenarnya.</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Keuntungan/(Kerugian) aktuarial atas Kewajiban</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">6. Total Keuntungan/(Kerugian) Aktuaria tahun berjalan</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">IV. Bunga Neto atas Liablilitas (aset)</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Biaya Bunga dari Liabilitas</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Pendapatan Bunga dari aset Program</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Total Bunga Neto atas Liablilitas (aset)</td>
                <td>239,986,065.00</td><td>208,839,784.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">V. Pengukuran kembali atas kewajiban/aset program; paragraf 57(d), PSAK24 rev 2013</td>
                <td></td><td></td><td></td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Akumulasi Keuntungan/(Kerugian) Aktuaria yang belum diakui, Awal Periode</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. Keuntungan/(Kerugian) aktuarial atas Kewajiban</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">4. Dampak Perubahan Batas Atas Aset</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">5. (Beban)/Pendapatan yang diakui dalam Penghasilan Komprehensif Lain</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
                <tr>
                    <td colspan="4">VI. Rekonsiliasi Penghasilan Komprehensif Lain</td>
                <td></td><td></td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">1. Akumulasi Penghasilan Komprehensif Lain awal periode</td>
                <td>0</td><td>0</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">2. (Beban)/Pendapatan yang diakui dalam Penghasilan Komprehensif Lain</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td></td>
                    <td colspan="3">3. Total Akumulasi Penghasilan Komprehensif Lain akhir periode</td>
                <td>237,897,661.00</td><td>28,770,175.00</td><td>rupiah</td></tr>
                <tr>
                    <td colspan="100%"></td>
                </tr>
            </tbody>
            </table>
        ';
        $dompdf->loadHtml($a);

        // // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // // Render the HTML as PDF
        $dompdf->render();
        // \Storage::put('invoice.pdf', $dompdf->output());

        // // Output the generated PDF to Browser
        // // $dompdf->stream($title);
        // return response()->download('a.pdf')->deleteFileAfterSend(true);
        return $dompdf->stream('aa.pdf');
    }

    public function process_xls_by_html(Request $request){
        $html = isset($request->html) ? $request->html : '';
        $title = isset($request->title) ? $request->title : 'untitled';

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data $title.xls");
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