<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeading"><i class="ace-icon fa fa-user cyan"></i> | New User Type</h4>
            </div>
            <form id="MenuForm" name="MenuForm" class="form-horizontal">
                <div class="modal-body">
                
                    <input type="hidden" name="mn_id" id="mn_id">
                    <div class="form-group">
                        <label for="usertype_name" class="col-form-label bolder">Menu Name :</label>
                        <input type="text" class="form-control" id="mn_name" name="mn_name" placeholder="Enter Name" value="" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="usertype_name" class="col-form-label bolder">Menu Link :</label>
                        <input type="text" class="form-control" id="mn_link" name="mn_link" placeholder="Enter Name" value="" maxlength="50" >
                    </div>

                    <div class="form-group">
                        <label for="usertype_name" class="col-form-label bolder">Menu Order :</label>
                        <input type="text" class="form-control" id="mn_order" name="mn_order" placeholder="Enter Name" value="" maxlength="50" >
                    </div>

                    <div class="form-group" id="menuPremitDiv">
                    </div>

                    <div class="form-group">
                        <label for="usertype_name" class="col-form-label bolder">Menu Parent :</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control"  id="mn_parent" name="mn_parent" 
                                placeholder="Menu Parent..." style="width:100%;">
                            </select>                         
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio" id="mn_status">
                            <label>
                                <input name="mn_status" id="mn_status_active" type="radio" class="ace" value="1" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="mn_status" id="mn_status_inactive" type="radio" class="ace" value="2" />
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