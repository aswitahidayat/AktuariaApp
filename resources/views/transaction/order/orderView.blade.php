<div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id=""><i class="ace-icon fa fa-shopping-cart cyan"></i> | New Order</h4>
            </div>
            <div class="modal-body">
                <input type="hidden"  id="viewordhdr_id" name="o">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order-number" class="col-sm-4 control-label no-padding-right bolder">Order Number:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_ordnum" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agent-email" class="col-sm-4 control-label no-padding-right bolder">Program:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_program" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type-identity" class="col-sm-4 control-label no-padding-right bolder">Service:</label>
                            <div class="col-sm-8 pb-20">
                                {{--  <select class="chosen-select form-control" id="ordhdr_service_hdr" name="ordhdr_service_hdr" 
                                    placeholder="Choose a Program..." style="width:100%;"></select>
                                        --}}
                                <label id="view_ordhdr_service_hdr" ></label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="identity-number" class="col-sm-4 control-label no-padding-right bolder">Period Count:</label>
                            <div class="col-sm-8 pb-20">
                                
                                <label id="view_ordhdr_period_count" ></label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agent-phone" class="col-sm-4 control-label no-padding-right bolder">Period Last Year:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_period_lastyear" ></label>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="birth-place" class="col-sm-4 control-label no-padding-right bolder">Min Age:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_work_age_min" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth-place" class="col-sm-4 control-label no-padding-right bolder">Pension Age:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_pension_age" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth-date" class="col-sm-4 control-label no-padding-right bolder">AVG Salary Increase:</label>
                            <div class="col-sm-6 pb-20">
                                <label id="view_ordhdr_sal_increase" ></label>
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
                                <label id="view_ordhdr_date" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="valuation-date" class="col-sm-4 control-label no-padding-right bolder">Valuation Date:</label>
                            <div class="col-sm-8 pb-20">
                                <label id="view_ordhdr_pay_date" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service-amount" class="col-sm-4 control-label no-padding-right bolder">Service Amount:</label>
                            <div class="col-sm-8 pb-20">
                                {{-- <input type="number" class="form-control" id="ordhdr_amount" name="ordhdr_amount"> --}}
                                {{--  <select class="chosen-select form-control" id="ordhdr_service_dtl" name="ordhdr_service_dtl" 
                                    placeholder="Choose Service Amount..." style="width:100%;"></select>  --}}
                                <label id="view_ordhdr_amount" ></label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="userUploadTbl"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
            </div>
        </div>
    </div>
</div>