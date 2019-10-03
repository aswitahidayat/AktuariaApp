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
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td>No Order</td>
                        <td>Nama</td>
                        <td>Tahun</td>
                        <td>Gender</td>
                    </tr>
                    <tbody id="orderHasilHdr">

                    </tbody>

                </table>

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td>Masa Kerja Tahun</td>
                        <td>Pesangaon</td>
                        <td>Past Serv</td>
                        <td>Future Serv</td>
                        <td>Salary</td>
                    </tr>
                    <tbody id="orderHasilDtl"></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
            </div>
        </div>
    </div>
</div>    