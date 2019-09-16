<div class="modal fade" id="modalAgent" tabindex="-1" role="dialog" aria-labelledby="AddAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingAgent"><i class="ace-icon fa fa-user-secret cyan"></i> | Register Agent</h4>
                </div>
                <form id="formAgent" action="javascript:void(0);">
                        <input type="hidden" class="form-control" name="agent_id" id="agent_id" >
                        <input type="hidden" class="form-control" name="regis_id" id="regis_id" >
                        <input type="hidden" class="form-control" name="bizpart_id" id="bizpart_id" >

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="agent-name" class="col-form-label bolder">Agent Name:</label>
                            <input type="text" class="form-control" name="agent_name" id="agent_name" required>
                        </div>
                        <div class="form-group">
                            <label for="agent-email" class="col-form-label bolder">Agent Email:</label>
                            <input type="email" class="form-control" name="agent_email" id="agent_email" required>
                            <small id="email_err" class="text-danger" style="display: none"> Email Exists</small>   
                        </div>
                        <div class="form-group">
                            <label for="type-identity" class="col-form-label bolder">Type Identity:</label>
                            <select class="chosen-select form-control" name="type_identity" id="type_identity" 
                                        style="width:100%;" required></select>
                        </div>
                        <div class="form-group">
                            <label for="identity-number" class="col-form-label bolder">Identity Number:</label>
                            <input type="number" class="form-control" name="identity_number" id="identity_number">
                        </div>
                        <div class="form-group">
                            <label for="agent-phone" class="col-form-label bolder">Agent Phone:</label>
                            <input type="number" class="form-control" name="agent_phone" id="agent_phone" required>
                        </div>
                        <div class="form-group">
                            <label for="birth-place" class="col-form-label bolder">Birth Place:</label>
                            <input type="text" class="form-control" name="agent_birth_place" id="agent_birth_place" required>
                        </div>
                        <div class="form-group">
                            <label for="birth-date" class="col-form-label bolder">Birth Date:</label>
                            <input type="date" class="form-control" name="agent_birth_date" id="agent_birth_date" required>
                        </div>
                        <div class="form-group">
                            <label for="npwp" class="col-form-label bolder">NPWP Number:</label>
                            <input type="number" class="form-control" name="npwp" id="npwp">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Status:</label>
                            <div class="radio">
                                <label>
                                    <input name="form-field-radio" type="radio"  name="agent_status" id="agent_status_active" value="1" class="ace" />
                                    <span class="lbl"> Active</span>
                                </label>
                                <label>
                                    <input name="form-field-radio" type="radio" class="ace" name="agent_status" id="agent_status_inactive" value="2" />
                                    <span class="lbl"> Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                        <button id="saveBtnAgent" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>