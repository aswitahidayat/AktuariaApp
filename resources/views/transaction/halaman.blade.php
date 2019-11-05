@extends('layouts.header')

<style>
    body {
        background-color: white !important;
    }

    td, th {
        padding: 2px !important;
    }
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <form method="post" class="no-print" action="{{ route('process_xls_by_html') }}">
            {{csrf_field()}}
            <input type="hidden" name="html" id="html" value="">
            <input type="hidden" name="title" id="title" value="">
            <label style="color: #fff;">Download Sebagai</label>
            <button type="submit">Excel</button>
        </form>
    </div>
  </nav>

<table id="test" class="" cellspacing=0 border=1 style="margin-top: 70px;">
    <tbody>
        <tr>
            <td style="text-align:center;" colspan="100%">
                <strong>PT Persada Raya Energi - UUK</strong>
            </td>
        </tr>
        <tr>
            <td colspan=4></td>
        </tr>
        <tr>
            <td colspan=4>
                <strong>A. Data untuk Perhitungan</strong>
            </td> 
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Data Pegawai</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>a. Jumlah Pegawai</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>* Pegawai di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>* Pegawai di atas usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>b. Jumlah Upah Sebulan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>* Pegawai di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>* Pegawai di atas usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>c. * Rata-rata usia di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>* Rata-rata usia di atas usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>d. Rata-rata masa kerja lalu</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>e. Perkiraan rata-rata masa kerja yang akan datang di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Asumsi Aktuaria</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>a. Tingkat Diskonto (IBPA Per Tgl 30-Sept-2018)</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>b. Tingkat Pengembalian Aset Program yang Diharapkan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>c. Tingkat Kenaikan Upah</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>d. Tingkat Mortalita</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>e. Tingkat Cacat  ( % TMI-3)</td>
        </tr>
        
        <tr>
            <td></td>
            <td colspan=3>3. Metode Penilaian Aktuaria</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Usia Pensiun Normal</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Nilai Kini Kewajiban </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>* Pegawai di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>* Pegawai di atas usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Akhir Periode</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>* Pegawai di bawah usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2> * Pegawai di atas usia pensiun</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Nilai Wajar Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Akhir Periode</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>7. Iuran Perusahaan</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>8. Imbalan Kerja yang dibayarkan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Total Imbalan Kerja yang dibayarkan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>- Imbalan Kerja yang dibayarkan oleh Perusahaan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>- Imbalan Kerja yang dibayarkan oleh Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>Selisih Imbalan Kerja yang Masih Menjadi Beban</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4><strong>B. Perhitungan Aktuaria</strong></td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Nilai Kini Kewajiban, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Nilai Wajar Aset Program, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Biaya jasa lalu yang telah diakui</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Biaya jasa lalu imbalan yang belum diakui</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Amortisasi Biaya Jasa Lalu yang belum diakui</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>7. Nilai Kini Kewajiban, Akhir Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>8. Biaya Jasa Kini</td>  
        </tr>
        <tr>
            <td></td>
            <td colspan=3>9. Periode rata-rata manfaat menjadi diakui</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4><strong>C. Jumlah yang Diakui dalam Laporan Laba Rugi; Paragraf 57(c) PSAK 24 Rev 2013</strong></td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Biaya Jasa Kini
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Biaya Jasa Lalu Atas Kurtailment/Penyelesaian</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. (Keuntungan)/Kerugian Atas Kurtailment/Penyelesaian</td>
        </tr>
        <tr>
            <td></td>
            <td>4.</td>
            <td colspan=2>- Biaya Bunga atas Nilai Kini Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>- Penghasilan/Biaya Bunga atas Nilai Wajar Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan=2>- Biaya Bunga atas batas atas aset</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Dampak Mutasi Pegawai</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Pengakuan segera (Keuntungan)/Kerugian Aktuaria</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>7. Biaya Jasa Lalu yang telah diakui</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>8. Beban/(Pendapatan) yang diakui dalam Laporan Laba Rugi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>9.Selisih Imbalan Kerja yang Masih Menjadi Beban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>10. Beban/(Pendapatan) yang seharusnya diakui dalam Lap. Laba Rugi</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>D. Jumlah yang Diakui dalam Lap. Keu. Neraca</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Nilai Kini Kewajiban </td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Nilai Wajar Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Status Pendanaan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Perubahan Dampak Batas Atas Aset</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Liabilitas/Aset yang Diakui dalam Lap. Keu. Neraca</td>
        </tr>
        <tr>
            <td colspan="100%"></td>            
        </tr>
        <tr>
            <td colspan=4>E. Perubahan yang Diakui dalam Lap. Keuangan (Neraca)</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. (Aset)/Kewajiban pada, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Beban/(pendapatan) yang diakui dalam Laporan Laba Rugi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Beban/(pendapatan) yang diakui dalam Penghasilan Komprehensif Lain</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Iuran Perusahaan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Imbalan Kerja yang dibayarkan oleh Perusahaan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. (Aset)/Kewajiban pada, Akhir Periode</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=9>Rekonsiliasi saldo awal ke saldo akhir Paragraf 140-141 PSAK 24 Revisi 2013</td>
        </tr>
        <tr>
            <td colspan=4>I Rekonsiliasi Nilai Kini Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Nilai Kini Kewajiban, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Biaya Jasa Kini</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Biaya Bunga atas Nilai Kini Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Biaya Jasa Lalu &amp; (Keuntungan)/Kerugian Aktuaria atas kurtailment dan penyelesaian</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Imbalan Kerja yang Sudah Tercatat Bagi Pegawai Keluar</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Dampak Kombinasi dan Pelepasan Bisnis</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>7. Nilai Kini Kewajiban yang diharapkan, Akhir Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>8. (Keuntungan)/Kerugian aktuarial atas Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>9. - Dampak Perubahan Asumsi Keuangan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>10. - Dampak Perubahan Asumsi Demografi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>11. - Penyesuaian atas Pengalaman (Experienced Adjustment)</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>12. Nilai Kini Kewajiban, Akhir Periode</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>II Rekonsiliasi Nilai Wajar Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Nilai Wajar Aset Program, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Penghasilan/Biaya Bunga atas Nilai Wajar Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Iuran Pegawai</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Iuran Perusahaan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Perubahan Kurs Valuta Asing</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Imbalan Kerja yang dibayarkan oleh Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>7. Kombinasi Bisnis</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>8. Penyelesaian</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>9. Nilai Wajar Aset Program yang diharapkan, Akhir Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>10. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>11. Nilai Wajar Aset Program, Akhir Periode</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>III Total Keuntungan/(Kerugian) Aktuaria tahun berjalan</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Ekspektasi Pembayaran Imbalan Paska Kerja</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Keuntungan/(Kerugian) aktuarial atas Imbalan Kerja</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Pembayaran Imbalan Paska Kerja Sebenarnya.</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Keuntungan/(Kerugian) aktuarial atas Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>6. Total Keuntungan/(Kerugian) Aktuaria tahun berjalan</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>IV. Bunga Neto atas Liablilitas (aset)</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Biaya Bunga dari Liabilitas</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Pendapatan Bunga dari aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Total Bunga Neto atas Liablilitas (aset)</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>V. Pengukuran kembali atas kewajiban/aset program; paragraf 57(d), PSAK24 rev 2013</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Akumulasi Keuntungan/(Kerugian) Aktuaria yang belum diakui, Awal Periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. Keuntungan/(Kerugian) aktuarial atas Kewajiban</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Keuntungan/(Kerugian) aktuarial atas Aset Program</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>4. Dampak Perubahan Batas Atas Aset</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>5. (Beban)/Pendapatan yang diakui dalam Penghasilan Komprehensif Lain</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
        <tr>
            <td colspan=4>VI. Rekonsiliasi Penghasilan Komprehensif Lain</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>1. Akumulasi Penghasilan Komprehensif Lain awal periode</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>2. (Beban)/Pendapatan yang diakui dalam Penghasilan Komprehensif Lain</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>3. Total Akumulasi Penghasilan Komprehensif Lain akhir periode</td>
        </tr>
        <tr>
            <td colspan="100%"></td>
        </tr>
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{asset('assets/js/app.js')}}" ></script>
<script type="text/javascript">

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, function (params) {
            
        }
    });

    function b(){
        var ids = '{{ $id }}'
        
        $.ajax({
                data: {
                    id: ids
                },

                url: "{{ route('getHalaman') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    // debugger
                    a(data)
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
    }

    b()
})
function a(datas){
    var vartable = $('#test tr')
    var countData = datas.detail.length
    vartable[0].innerHTML = `<td style="text-align:center;" colspan="100%"><strong>${datas.coy_name ? datas.coy_name : ''}</strong></td>`
    datas.detail.forEach(function(data, i){
        vartable[1].innerHTML += `<td>${data.ordass_periode}</td>`
        vartable[2].innerHTML += `<td></td>`
        vartable[3].innerHTML += `<td></td>`
        vartable[4].innerHTML += `<td>${data.pegawai_non_pensiun + data.pegawai_pensiun}</td>`
        vartable[5].innerHTML += `<td>${data.pegawai_non_pensiun}</td>`
        vartable[6].innerHTML += `<td>${data.pegawai_pensiun}</td>`

        vartable[7].innerHTML += `<td>${formatHumanCurrency(parseFloat(data.pegawai_upah_non_pensiun) + parseFloat(data.pegawai_upah_pensiun))}</td>`
        vartable[8].innerHTML += `<td>${formatHumanCurrency(data.pegawai_upah_non_pensiun)}</td>`
        vartable[9].innerHTML += `<td>${formatHumanCurrency(data.pegawai_upah_pensiun)}</td>`

        vartable[10].innerHTML += `<td>${parseFloat(data.pegawai_umur_non_pensiun).toFixed(2)}</td>`
        vartable[11].innerHTML += `<td>${parseFloat(data.pegawai_umur_pensiun).toFixed(2)}</td>`
        vartable[12].innerHTML += `<td>${parseFloat(data.kerja_lalu).toFixed(2)}</td>`
        vartable[13].innerHTML += `<td>${parseFloat(data.kerja_depan).toFixed(2)}</td>`
        vartable[14].innerHTML += `<td></td>`

        vartable[15].innerHTML += `<td>${parseFloat(data.diskonto).toFixed(2)}%</td>`
        vartable[16].innerHTML += `<td>0</td>`
        vartable[17].innerHTML += `<td>${parseFloat(data.kenaikan_upah).toFixed(2)}%</td>`
        vartable[18].innerHTML += `<td>TMI-3</td>`
        vartable[19].innerHTML += `<td>${parseFloat(data.tingkat_cacat).toFixed(2)}</td>`
        vartable[20].innerHTML += `<td>PUC</td>`
        vartable[21].innerHTML += `<td>${parseFloat(data.umur_pensiun).toFixed(0)}</td>`
        vartable[22].innerHTML += `<td></td>`

        var awal_periode = (datas.detail[i+1] ? parseFloat(datas.detail[i+1].pegawai_dibawah_pensiun ) + parseFloat(datas.detail[i+1].pegawai_diatas_pensiun) : 0)
        vartable[23].innerHTML += `<td>${formatHumanCurrency(awal_periode)}</td>`
        vartable[24].innerHTML += `<td>${formatHumanCurrency(datas.detail[i+1] ? datas.detail[i+1].pegawai_dibawah_pensiun : 0)}</td>`
        vartable[25].innerHTML += `<td>${formatHumanCurrency(datas.detail[i+1] ? datas.detail[i+1].pegawai_diatas_pensiun : 0)}</td>`

        var akhir_periode = parseFloat(data.pegawai_dibawah_pensiun)+parseFloat(data.pegawai_diatas_pensiun)
        vartable[26].innerHTML += `<td>${formatHumanCurrency(akhir_periode)}</td>`
        vartable[27].innerHTML += `<td>${formatHumanCurrency(data.pegawai_dibawah_pensiun)}</td>`
        vartable[28].innerHTML += `<td>${formatHumanCurrency(data.pegawai_diatas_pensiun)}</td>`

        vartable[29].innerHTML += `<td></td>`
        vartable[30].innerHTML += `<td>0</td>`
        vartable[31].innerHTML += `<td>0</td>`
        vartable[33].innerHTML += `<td></td>`
        
        vartable[35].innerHTML += `<td></td>`
        vartable[36].innerHTML += `<td>0</td>`
        vartable[37].innerHTML += `<td>0</td>`
        vartable[38].innerHTML += `<td>0</td>`
        vartable[39].innerHTML += `<td>0</td>`
        vartable[40].innerHTML += `<td>0</td>`

        vartable[42].innerHTML += `<td></td>`
        vartable[43].innerHTML += `<td>${formatHumanCurrency(akhir_periode)}</td>`
        vartable[44].innerHTML += `<td>0</td>`
        vartable[45].innerHTML += `<td>0</td>`
        vartable[46].innerHTML += `<td>0</td>`
        vartable[47].innerHTML += `<td>0</td>`
        vartable[48].innerHTML += `<td>0</td>`
        vartable[49].innerHTML += `<td>${formatHumanCurrency((parseFloat(datas.detail[i].pegawai_dibawah_pensiun) + parseFloat(datas.detail[i].pegawai_diatas_pensiun) ))}</td>`
        vartable[50].innerHTML += `<td>${formatHumanCurrency(data.jasa_kini)}</td>`
        vartable[51].innerHTML += `<td>${parseFloat( parseFloat(data.kerja_lalu) + parseFloat(data.kerja_depan)).toFixed(2)}</td>`

        var kewajiban = parseFloat(datas.detail[i].diskonto).toFixed(2) * (parseFloat(datas.detail[i].pegawai_dibawah_pensiun) + parseFloat(datas.detail[i].pegawai_diatas_pensiun)-0) 
        var beban = parseFloat(kewajiban) + parseFloat(data.jasa_kini)
        vartable[53].innerHTML += `<td></td>`
        vartable[54].innerHTML += `<td>${formatHumanCurrency(data.jasa_kini)}</td>`
        vartable[55].innerHTML += `<td>0</td>`
        vartable[56].innerHTML += `<td>0</td>`
        vartable[57].innerHTML += `<td>${formatHumanCurrency(kewajiban)}</td>`
        vartable[58].innerHTML += `<td>0</td>`
        vartable[59].innerHTML += `<td>0</td>`
        vartable[60].innerHTML += `<td>0</td>`
        vartable[61].innerHTML += `<td>0</td>`
        vartable[62].innerHTML += `<td>0</td>`
        vartable[63].innerHTML += `<td>${formatHumanCurrency(beban)}</td>`
        vartable[64].innerHTML += `<td>0</td>`
        vartable[65].innerHTML += `<td>${formatHumanCurrency(beban)}</td>`

        vartable[67].innerHTML += `<td></td>`
        vartable[68].innerHTML += `<td>${formatHumanCurrency((parseFloat(datas.detail[i].pegawai_dibawah_pensiun) + parseFloat(datas.detail[i].pegawai_diatas_pensiun)))}</td>`
        vartable[69].innerHTML += `<td>0</td>`
        vartable[70].innerHTML += `<td>${formatHumanCurrency((parseFloat(datas.detail[i].pegawai_dibawah_pensiun) + parseFloat(datas.detail[i].pegawai_diatas_pensiun)))}</td>`
        vartable[71].innerHTML += `<td>0</td>`
        vartable[72].innerHTML += `<td>${formatHumanCurrency((parseFloat(datas.detail[i].pegawai_dibawah_pensiun) + parseFloat(datas.detail[i].pegawai_diatas_pensiun)))}</td>`

        var kewajiban_awal = 0
        var totalAkhir = parseFloat(kewajiban_awal) + parseFloat(beban)
        vartable[74].innerHTML += `<td></td>`
        vartable[75].innerHTML += `<td>0</td>`
        vartable[76].innerHTML += `<td>${formatHumanCurrency(beban)}</td>`
        vartable[77].innerHTML += `<td>0</td>` //TODO
        vartable[78].innerHTML += `<td>0</td>`
        vartable[79].innerHTML += `<td>0</td>`
        vartable[80].innerHTML += `<td>${formatHumanCurrency(totalAkhir)}</td>`

        var kewajiban_yang_diharapkan = parseFloat(awal_periode) + parseFloat(data.jasa_kini) + parseFloat(kewajiban)
        vartable[83].innerHTML += `<td></td>`
        vartable[84].innerHTML += `<td>${formatHumanCurrency(awal_periode)}</td>`
        vartable[85].innerHTML += `<td>${formatHumanCurrency(data.jasa_kini)}</td>`
        vartable[86].innerHTML += `<td>${formatHumanCurrency(kewajiban)}</td>`
        vartable[87].innerHTML += `<td>0</td>`
        vartable[88].innerHTML += `<td>0</td>`
        vartable[89].innerHTML += `<td>0</td>`
        vartable[90].innerHTML += `<td>${formatHumanCurrency(kewajiban_yang_diharapkan)}</td>`
        vartable[91].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`
        vartable[92].innerHTML += `<td></td>`
        vartable[93].innerHTML += `<td></td>`
        vartable[94].innerHTML += `<td></td>`
        vartable[95].innerHTML += `<td>${formatHumanCurrency(kewajiban_yang_diharapkan)}</td>`
        
        vartable[97].innerHTML += `<td></td>`
        vartable[98].innerHTML += `<td></td>`
        vartable[99].innerHTML += `<td></td>`
        vartable[100].innerHTML += `<td></td>`
        vartable[101].innerHTML += `<td></td>`
        vartable[102].innerHTML += `<td></td>`
        vartable[103].innerHTML += `<td></td>`
        vartable[104].innerHTML += `<td></td>`
        vartable[105].innerHTML += `<td></td>`
        vartable[106].innerHTML += `<td></td>`
        vartable[107].innerHTML += `<td></td>`
        vartable[108].innerHTML += `<td></td>`

        vartable[110].innerHTML += `<td></td>`
        vartable[111].innerHTML += `<td>0</td>`
        vartable[112].innerHTML += `<td>0</td>`
        vartable[113].innerHTML += `<td>0</td>`
        vartable[114].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`
        vartable[115].innerHTML += `<td>0</td>`
        vartable[116].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`

        vartable[118].innerHTML += `<td></td>`
        vartable[119].innerHTML += `<td>${formatHumanCurrency(kewajiban)}</td>`
        vartable[120].innerHTML += `<td>0</td>`
        vartable[121].innerHTML += `<td>${formatHumanCurrency(kewajiban)}</td>`

        vartable[123].innerHTML += `<td></td>`
        vartable[124].innerHTML += `<td></td>`
        vartable[125].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`
        vartable[126].innerHTML += `<td></td>`
        vartable[127].innerHTML += `<td></td>`
        vartable[128].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`

        var rekonsiliasi = 0 //TODO
        var total = parseFloat(rekonsiliasi) + parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode)
        vartable[130].innerHTML += `<td></td>`
        vartable[131].innerHTML += `<td>${rekonsiliasi}</td>`
        vartable[132].innerHTML += `<td>${formatHumanCurrency(parseFloat(kewajiban_yang_diharapkan) - parseFloat(akhir_periode))}</td>`
        vartable[133].innerHTML += `<td>${formatHumanCurrency(total)}</td>`

    });
    vartable[1].innerHTML += `<td></td>`
    vartable[2].innerHTML += `<td></td>`
    vartable[3].innerHTML += `<td></td>`

    vartable[4].innerHTML += `<td>orang</td>`
    vartable[5].innerHTML += `<td>orang</td>`
    vartable[6].innerHTML += `<td>orang</td>`

    vartable[7].innerHTML += `<td>rupiah</td>`
    vartable[8].innerHTML += `<td>rupiah</td>`
    vartable[9].innerHTML += `<td>rupiah</td>`

    vartable[10].innerHTML += `<td>tahun</td>`
    vartable[11].innerHTML += `<td>tahun</td>`

    vartable[12].innerHTML += `<td>tahun</td>`
    vartable[13].innerHTML += `<td>tahun</td>`
    vartable[14].innerHTML += `<td></td>`

    vartable[15].innerHTML += `<td></td>`
    vartable[16].innerHTML += `<td></td>`
    vartable[17].innerHTML += `<td></td>`
    vartable[18].innerHTML += `<td></td>`
    vartable[19].innerHTML += `<td></td>`
    vartable[20].innerHTML += `<td></td>`
    vartable[21].innerHTML += `<td></td>`
    vartable[22].innerHTML += `<td></td>`

    vartable[23].innerHTML += `<td>rupiah</td>`
    vartable[24].innerHTML += `<td>rupiah</td>`
    vartable[25].innerHTML += `<td>rupiah</td>`

    vartable[26].innerHTML += `<td>rupiah</td>`
    vartable[27].innerHTML += `<td>rupiah</td>`
    vartable[28].innerHTML += `<td>rupiah</td>`

    vartable[29].innerHTML += `<td></td>`
    vartable[30].innerHTML += `<td>rupiah</td>`
    vartable[31].innerHTML += `<td>rupiah</td>`
    vartable[33].innerHTML += `<td></td>`

    vartable[35].innerHTML += `<td></td>`
    vartable[36].innerHTML += `<td></td>`
    vartable[37].innerHTML += `<td></td>`
    vartable[38].innerHTML += `<td></td>`
    vartable[39].innerHTML += `<td></td>`
    vartable[40].innerHTML += `<td></td>`

    vartable[42].innerHTML += `<td></td>`
    vartable[43].innerHTML += `<td>rupiah</td>`
    vartable[44].innerHTML += `<td>rupiah</td>`
    vartable[45].innerHTML += `<td>rupiah</td>`
    vartable[46].innerHTML += `<td>rupiah</td>`
    vartable[47].innerHTML += `<td>rupiah</td>`
    vartable[48].innerHTML += `<td>rupiah</td>`
    vartable[49].innerHTML += `<td>rupiah</td>`
    vartable[50].innerHTML += `<td>rupiah</td>`
    vartable[51].innerHTML += `<td>tahun</td>`

    vartable[53].innerHTML += `<td></td>`
    vartable[54].innerHTML += `<td>rupiah</td>`
    vartable[55].innerHTML += `<td>rupiah</td>`
    vartable[56].innerHTML += `<td>rupiah</td>`
    vartable[57].innerHTML += `<td>rupiah</td>`
    vartable[58].innerHTML += `<td>rupiah</td>`
    vartable[59].innerHTML += `<td>rupiah</td>`
    vartable[60].innerHTML += `<td>rupiah</td>`
    vartable[61].innerHTML += `<td>rupiah</td>`
    vartable[62].innerHTML += `<td>rupiah</td>`
    vartable[63].innerHTML += `<td>rupiah</td>`
    vartable[64].innerHTML += `<td>rupiah</td>`
    vartable[65].innerHTML += `<td>rupiah</td>`

    vartable[67].innerHTML += `<td></td>`
    vartable[68].innerHTML += `<td>rupiah</td>`
    vartable[69].innerHTML += `<td>rupiah</td>`
    vartable[70].innerHTML += `<td>rupiah</td>`
    vartable[71].innerHTML += `<td>rupiah</td>`
    vartable[72].innerHTML += `<td>rupiah</td>`

    vartable[74].innerHTML += `<td></td>`
    vartable[75].innerHTML += `<td>rupiah</td>`
    vartable[76].innerHTML += `<td>rupiah</td>`
    vartable[77].innerHTML += `<td>rupiah</td>`
    vartable[78].innerHTML += `<td>rupiah</td>`
    vartable[79].innerHTML += `<td>rupiah</td>`
    vartable[80].innerHTML += `<td>rupiah</td>`

    vartable[83].innerHTML += `<td></td>`
    vartable[84].innerHTML += `<td>rupiah</td>`
    vartable[85].innerHTML += `<td>rupiah</td>`
    vartable[86].innerHTML += `<td>rupiah</td>`
    vartable[87].innerHTML += `<td>rupiah</td>`
    vartable[88].innerHTML += `<td>rupiah</td>`
    vartable[89].innerHTML += `<td>rupiah</td>`
    vartable[90].innerHTML += `<td>rupiah</td>`
    vartable[91].innerHTML += `<td>rupiah</td>`
    vartable[92].innerHTML += `<td>rupiah</td>`
    vartable[93].innerHTML += `<td>rupiah</td>`
    vartable[94].innerHTML += `<td>rupiah</td>`
    vartable[95].innerHTML += `<td>rupiah</td>`

    vartable[97].innerHTML += `<td></td>`
    vartable[98].innerHTML += `<td></td>`
    vartable[99].innerHTML += `<td></td>`
    vartable[100].innerHTML += `<td></td>`
    vartable[101].innerHTML += `<td></td>`
    vartable[102].innerHTML += `<td></td>`
    vartable[103].innerHTML += `<td></td>`
    vartable[104].innerHTML += `<td></td>`
    vartable[105].innerHTML += `<td></td>`
    vartable[106].innerHTML += `<td></td>`
    vartable[107].innerHTML += `<td></td>`
    vartable[108].innerHTML += `<td></td>`

    vartable[110].innerHTML += `<td></td>`
    vartable[111].innerHTML += `<td>rupiah</td>`
    vartable[112].innerHTML += `<td>rupiah</td>`
    vartable[113].innerHTML += `<td>rupiah</td>`
    vartable[114].innerHTML += `<td>rupiah</td>`
    vartable[115].innerHTML += `<td>rupiah</td>`
    vartable[116].innerHTML += `<td>rupiah</td>`
    
    vartable[118].innerHTML += `<td>rupiah</td>`
    vartable[119].innerHTML += `<td>rupiah</td>`
    vartable[120].innerHTML += `<td>rupiah</td>`
    vartable[121].innerHTML += `<td>rupiah</td>`

    vartable[123].innerHTML += `<td></td>`
    vartable[124].innerHTML += `<td>rupiah</td>`
    vartable[125].innerHTML += `<td>rupiah</td>`
    vartable[126].innerHTML += `<td>rupiah</td>`
    vartable[127].innerHTML += `<td>rupiah</td>`
    vartable[128].innerHTML += `<td>rupiah</td>`

    vartable[130].innerHTML += `<td>rupiah</td>`
    vartable[131].innerHTML += `<td>rupiah</td>`
    vartable[132].innerHTML += `<td>rupiah</td>`
    vartable[133].innerHTML += `<td>rupiah</td>`

    
    var table = document.getElementById("test")
    var row = table.insertRow(20);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    cell2.innerHTML = "f. Tingkat Pengunduran Diri";
    cell2.colSpan = 2
    var cell3 = row.insertCell(3);
    cell3.colSpan = countData+1

    var countRow = 20
    $.each( datas.tpe, function( keys, values ) {
        countRow++
        var row = table.insertRow(countRow);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        cell3.innerHTML = keys;
        
        var countCol = 3
        datas.detail.forEach(function(data, i){
            countCol++
            var cellx = row.insertCell(countCol)
            var penjaga = values[data.ordass_periode] ? values[data.ordass_periode].value : '0'
            cellx.innerHTML = `${penjaga}%`
        })

        var celly = row.insertCell(countCol + 1);

    });

    var tabl = $('#test').html()
    tabl = `<table>${tabl}</table>`
    $('#html').val(tabl)
    $('#title').val(datas.coy_name)
    
}

</script>