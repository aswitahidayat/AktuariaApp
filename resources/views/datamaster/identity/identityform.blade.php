<div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="modelHeading"><i class="ace-icon fa fa-user cyan"></i> | New Identity</h4>
                </div>
                <form id="formIdentity" name="IdentityForm" class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="typeid_id" id="typeid_id">
                        <div class="form-group">
                            <label for="typeid_name" class="col-form-label bolder">Identity Name :</label>
                            <input type="text" class="form-control" id="typeid_name" name="typeid_name" placeholder="Enter Identity Name" value="" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="identity_desc" class="col-form-label bolder">Identity Desc :</label>
                            <textarea id="typeid_desc" name="typeid_desc" placeholder="Enter Identity Description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Status:</label>
                            <div class="radio">
                                <label>
                                    <input name="typeid_status" id="typeid_status_active" type="radio" class="ace" value="1" />
                                    <span class="lbl"> Active</span>
                                </label>
                                <label>
                                    <input name="typeid_status" id="typeid_status_inactive" type="radio" class="ace" value="2" />
                                    <span class="lbl"> Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>