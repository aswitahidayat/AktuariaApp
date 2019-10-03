<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingOrder"><i class="ace-icon fa fa-shopping-cart cyan"></i> | New Order</h4>
            </div>
            <form id="formOrder" action="javascript:void(0);">
                <div class="modal-body">
                    <input type="hidden"  id="ordhdr_id" name="ordhdr_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Order Number:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="text" class="form-control" id="ordhdr_ordnum" name="ordhdr_ordnum" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agent-email" class="col-sm-4 control-label no-padding-right bolder">Program:</label>
                                <div class="col-sm-8 pb-20">
                                    <select class="chosen-select form-control" id="ordhdr_program" name="ordhdr_program" 
                                        placeholder="Choose a Program..." style="width:100%;"></select>
                                    {{-- <input type="number" class="form-control" id="ordhdr_program" name="ordhdr_program" required> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type-identity" class="col-sm-4 control-label no-padding-right bolder">Service:</label>
                                <div class="col-sm-8 pb-20">
                                    <select class="chosen-select form-control" id="ordhdr_service_hdr" name="ordhdr_service_hdr" 
                                        placeholder="Choose a Program..." style="width:100%;"></select>
                                    {{-- <input type="number" class="form-control" id="ordhdr_service_hdr" name="ordhdr_service_hdr" required> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="identity-number" class="col-sm-4 control-label no-padding-right bolder">Period Count:</label>
                                <div class="col-sm-8 pb-20">
                                    
                                    <input type="number" min="2" class="form-control" id="ordhdr_period_count" name="ordhdr_period_count" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agent-phone" class="col-sm-4 control-label no-padding-right bolder">Period Last Year:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="number" class="form-control" id="ordhdr_period_lastyear" name="ordhdr_period_lastyear" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="birth-place" class="col-sm-4 control-label no-padding-right bolder">Min Age:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="number" class="form-control" id="ordhdr_work_age_min" name="ordhdr_work_age_min" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birth-place" class="col-sm-4 control-label no-padding-right bolder">Pension Age:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="number" class="form-control" id="ordhdr_pension_age" name="ordhdr_pension_age" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birth-date" class="col-sm-4 control-label no-padding-right bolder">AVG Salary Increase:</label>
                                <div class="col-sm-6 pb-20">
                                    <input type="number" class="form-control" id="ordhdr_sal_increase" name="ordhdr_sal_increase" required>
                                </div>
                                <div class="col-sm-2 pb-20">
                                    %
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="npwp" class="col-sm-4 control-label no-padding-right bolder">Order Date:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="date" class="form-control" id="ordhdr_date" name="ordhdr_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="valuation-date" class="col-sm-4 control-label no-padding-right bolder">Valuation Date:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="date" class="form-control" id="ordhdr_pay_date" name="ordhdr_pay_date" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="service-amount" class="col-sm-4 control-label no-padding-right bolder">Service Amount:</label>
                                <div class="col-sm-8 pb-20">
                                    {{-- <input type="number" class="form-control" id="ordhdr_amount" name="ordhdr_amount"> --}}
                                    <select class="chosen-select form-control" id="ordhdr_service_dtl" name="ordhdr_service_dtl" 
                                        placeholder="Choose Service Amount..." style="width:100%;"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="order-number" class="col-sm-2 control-label no-padding-right bolder">Upload Employe Data:</label>
                        <div class="col-sm-8 pb-20" id="tombol_upload">
                            {{-- <input type="file" name="fileupload" id="fileupload" class="form-control-file" />
                            <button type="button" class="btn btn-secondary" id="btnUpload" >Upload</button> --}}
                            <div class="col-sm-8 pb-20">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileupload" id="fileupload" style="padding-left: 24px;" >
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                            <div class="col-sm-4 pb-20">
                                <button type="button" id="btnUpload" class="btn btn-secondary btn-sm">Upload</button>
                            </div>

                        </div>
                    </div>
                    <div class="row" id="userUploadTbl"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="saveBtnOrder" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>