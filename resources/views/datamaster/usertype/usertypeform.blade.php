<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeading"><i class="ace-icon fa fa-user cyan"></i> | New User Type</h4>
            </div>
            <form id="UsertypeForm" name="UsertypeForm" class="form-horizontal">
                <div class="modal-body">
                
                    <input type="hidden" name="usertype_id" id="usertype_id">
                    <div class="form-group">
                        <label for="usertype_name" class="col-form-label bolder">User Type Name :</label>
                        <input type="text" class="form-control" id="usertype_name" name="usertype_name" placeholder="Enter Name" value="" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="usertype_desc" class="col-form-label bolder">User Type Desc :</label>
                        <textarea id="usertype_desc" name="usertype_desc" placeholder="Enter Description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio" id="usertype_status">
                            <label>
                                <input name="usertype_status" id="usertype_status_active" type="radio" class="ace" value="1" checked/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="usertype_status" id="usertype_status_inactive" type="radio" class="ace" value="2" />
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