<div class="modal fade" id="modalOrderAssumption" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingOrderAssumption"><i class="ace-icon fa fa-shopping-cart cyan"></i> | Order Assumption</h4>
            </div>
            {{-- <form id="formOrderAssumption" action="javascript:void(0);"> --}}
                <div class="modal-body">
                    <input type="hidden" class="form-control" required>
                    <div id="assumption"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="submitModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="subModalOrderAssumption" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="subModelHeadingOrderAssumption"><i class="ace-icon fa fa-shopping-cart cyan"></i> | Assumption Progressive</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" required>
                <div id="subAssumption" class="pb-20"></div>
                <button type="button" class="btn btn-secondary" onclick="addProgressive()">addProgressive</button>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button id="submitSubModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="comfirmOrder" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="formComfirmOrder" onsubmit="submitComfirmOrder()" action="javascript:void(0);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="subModelHeadingOrderAssumption"><i class="ace-icon fa fa-shopping-cart cyan"></i> | Assumption Progressive</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control" id="com_ordhdr_id" name="com_ordhdr_id" />                        
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Order Number:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_ordnum" name="com_ordhdr_ordnum" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Order Date:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_date" name="com_ordhdr_date" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Valuation Date:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_pay_date" name="com_ordhdr_pay_date" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Program:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordprg_name" name="com_ordprg_name"disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Service:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordsrvhdr_name" name="com_ordsrvhdr_name" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Service Amount:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordsrvdtl_price" name="com_ordsrvdtl_price" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Period Count:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_period_count" name="com_ordhdr_period_count" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Period Last Year:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_period_lastyear" name="com_ordhdr_period_lastyear" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Pension Age:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_pension_age" name="com_ordhdr_pension_age" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">AVG Salary Increase:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="com_ordhdr_sal_increase" name="com_ordhdr_sal_increase" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Bukti Bayar:</label>
                            <div class="col-sm-8 pb-20">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="com_fileupload" id="com_fileupload" style="padding-left: 24px;" required>
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="submitSubModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="orderHasil" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="">Hasil Hitung</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="formCariHasil()" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Karyawan:</label>
                                <div class="col-sm-8 pb-20">
                                    <select class="chosen-select form-control" id="search_hasil_karyawan" name="search_hasil_karyawan" 
                                    placeholder="" style="width:100%;"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Tahun:</label>
                                <div class="col-sm-8 pb-20">
                                    <select class="chosen-select form-control" id="search_hasil_tahun" name="search_hasil_tahun" 
                                    placeholder="" style="width:100%;"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 pb-20">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div style="overflow-x:auto;" class="mb-20">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td rowspan="2">No</td>
                                <td rowspan="2">NIK</td>
                                <td rowspan="2">Name</td>
                                <td rowspan="2">Sex</td>
                                <td rowspan="2">Work</td>
                                <td rowspan="2">Salary at Valuation Date</td>
                                <td rowspan="2">Salary at Pension Date</td>
                                <td rowspan="2">Age At Valuation Date</td>
                                <td colspan="3">Basis-10</td>
                                <td colspan="4">Faktor Imbalan Saat</td>
                                <td rowspan="2">Faktor Kenaikan Gaji</td>
                                <td colspan="4">Expected Benefit at</td>
                                <td colspan="4">Tingkat Peluang Kejadiannya</td>
                                <td rowspan="2">Tingkat Diskonto</td>
                                <td rowspan="2">Imbalan per unit masakerja</td>
                                <td rowspan="2">Nilai Kini Kewajiban</td>
                                <td rowspan="2">BS Valuasi</td>
                            </tr>
                            <tr>
                                <td>Past Service</td>
                                <td>Future Service</td>
                                <td>Total Service</td>
        
                                <td>Meninggal Dunia</td>
                                <td>Menderita Cacad</td>
                                <td>Berhenti (Undur Diri)</td>
                                <td>Pensiun Haritua</td>
                                
                                <td>Death</td>
                                <td>Total Permanent Disability</td>
                                <td>Resign</td>
                                <td>Pension</td>
        
                                <td>Karena Meninggal</td>
                                <td>Karena Menderita Cacad</td>
                                <td>Karena Berhenti</td>
                                <td>Karena Pensiun</td>
                            </tr>
                        </thead>
                        <tbody id="orderHasilHdr">
    
                        </tbody>
    
                    </table>
                </div>

                <div style="overflow-x:auto;" class="mb-20">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td rowspan="2">No. urut</td>
                                <td rowspan="2">usia peserta</td>
                                <td rowspan="2">masakerja lampau</td>
                                <td rowspan="2">masakerja mendatang</td>
                                
                                <td colspan="5">faktor imbalan saat terjadi (due date)</td>
                                
                                <td rowspan="2">faktor kenaikan gaji</td>
                                <td colspan="5">besar imbalan (expected benefit amount) yang diterima, karena</td>
                                
                                <td colspan="4">Tingkat peluang kejadiannya</td>
                                
                                <td colspan="5">Total Nilai Kini Kewajiban (PVDBO)</td>
                                
                                <td colspan="5">Biaya jasa kini</td>
                                
                                <td colspan="5">Nilai Kini Kewajiban (PBO)</td>
                                <td rowspan="2">Jumlah</td>
                                <td rowspan="2">Potensi BS</td>
                            </tr>
                            
                            <tr>
                                <td>total masa kerja</td>
                                <td>meninggal dunia</td>
                                <td>menderita cacad</td>
                                <td>undur diri (berhenti)</td>	
                                <td>pensiun normal</td>
                                
                                <td>gaji sebulan</td>
                                <td>meninggal dunia</td>
                                <td>menderita cacad</td>
                                <td>undur diri (berhenti)</td>
                                <td>pensiun haritua</td>
                                
                                <td>meninggal dunia</td>	
                                <td>menderita cacad</td>
                                <td>berhenti (undur diri)</td>
                                <td>pensiun haritua</td>
                                
                                <td>Tingkat Diskonto</td>
                                <td>meninggal dunia</td>
                                <td>menderita cacad</td>
                                <td>berhenti (undur diri)</td>	
                                <td>karena pensiun</td>
                                
                                <td>Jumlah TNKK</td>
                                <td>meninggal dunia</td>
                                <td>menderita cacad</td>
                                <td>berhenti (undur diri)</td>	
                                <td>karena pensiun</td>
                                
                                <td>(Imbalan per unit masakerja)</td>
                                <td>meninggal dunia</td>
                                <td>menderita cacad</td>
                                <td>berhenti (undur diri)</td>	
                                <td>karena pensiun</td>
                            </tr>
                        </thead>
                        <tbody id="orderHasilDtl">
                            <tr>
                                <td colspan="100%">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
            </div>
        </div>
    </div>
</div>    