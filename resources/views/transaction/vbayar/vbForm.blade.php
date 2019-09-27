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
                        <input type="hidde" class="form-control" id="com_ordhdr_id" name="com_ordhdr_id" />                        
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
                                {{-- <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="com_fileupload" id="com_fileupload" style="padding-left: 24px;" required>
                                    <label class="custom-file-label" for="customFile"></label>
                                </div> --}}
                                <img id="vbImage" width="150px" src="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="submitSubModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Verifikasi</button>
                </div>
            </div>
        </form>
    </div>
</div>