<div class="modal fade" id="modalProvince" tabindex="-1" role="dialog" aria-labelledby="AddProvinceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingProvince"><i class="ace-icon fa fa-globe cyan"></i> | New Province</h4>
            </div>
            <div class="modal-body">
                <form id="formProvince" name="formProvince">
                    <input type="hidden" name="prov_id" id="prov_id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Province Name:</label>
                        <input type="text" class="form-control" name="prov_name" id="prov_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="prov_bps_code" name="prov_bps_code">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="prov_status" id="prov_status_active" type="radio" class="ace" value="1" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="prov_status" id="prov_status_active" type="radio" class="ace" value="1" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnProvince" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>