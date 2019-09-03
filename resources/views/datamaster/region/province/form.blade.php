<div class="modal fade" id="AddProvinceModal" tabindex="-1" role="dialog" aria-labelledby="AddProvinceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddProvinceModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Province</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Province Name:</label>
                        <input type="text" class="form-control" id="province-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>