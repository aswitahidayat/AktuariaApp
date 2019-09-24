<div class="modal fade" id="modalService"  role="dialog" aria-labelledby="AddServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingService"><i class="ace-icon fa fa-balance-scale cyan"></i> | New Order Service</h4>
            </div>
            <div class="modal-body">
                <form id="formService" name="formService">
                    <input type="hidden" name="ordsrvhdr_id" id="ordsrvhdr_id">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Order Service Name:</label>
                        <input type="text" class="form-control" id="ordsrvhdr_name" name="ordsrvhdr_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Description:</label>
                        <textarea class="form-control" id="ordsrvhdr_desc" name="ordsrvhdr_desc"></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Price:</label>
                        <input type="text" class="form-control" id="ordsrvhdr_price" name="ordsrvhdr_price" placeholder="999.999.999">
                    </div> --}}
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                                <label>
                                    <input name="ordsrvhdr_status" id="ordsrvhdr_status_active" type="radio" class="ace" value="1"/>
                                    <span class="lbl"> Active</span>
                                </label>
                                <label>
                                    <input name="ordsrvhdr_status" id="ordsrvhdr_status_inactive" type="radio" class="ace" value="2"/>
                                    <span class="lbl"> Inactive</span>
                                </label>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Order Service Detail:</label>
                        <div id="serviceDtl"></div>
                        <button type="button" class="btn btn-secondary" onclick="addServiceDtl()">Add Service Detail</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnService" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>