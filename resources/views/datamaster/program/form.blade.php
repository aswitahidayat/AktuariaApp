<div class="modal fade" id="modalOrderProgram" tabindex="-1" role="dialog" aria-labelledby="AddProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingOrderProgram"><i class="ace-icon fa fa-television cyan"></i> | New Order Program</h4>
                </div>
                <div class="modal-body">
                    <form id="formOrderProgram" name="formOrderProgram">
                        <input type="hidden" name="ordprg_id" id="ordprg_id">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label bolder">Order Service Name:</label>
                            <input type="text" class="form-control" name="ordprg_name" id="ordprg_name">
                        </div>
                        <!-- <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Description:</label>
                            <textarea class="form-control" name="ordprg_name" id="ordprg_name"></textarea>
                        </div> -->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Status:</label>
                            <div class="radio">
                                <label>
                                    <input name="ordprg_status" id="ordprg_status_active" type="radio" class="ace" value="1"/>
                                    <span class="lbl"> Active</span>
                                </label>
                                <label>
                                    <input name="ordprg_status" id="ordprg_status_inactive" type="radio" class="ace" value="2"/>
                                    <span class="lbl"> Inactive</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button type="button" id="saveBtnOrderProgram" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            </div>
        </div>
    </div>