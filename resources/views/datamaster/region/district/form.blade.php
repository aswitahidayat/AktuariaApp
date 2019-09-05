<!-- BEGIN MODAL DISTRICT -->
<div class="modal fade" id="modalDistrict" tabindex="-1" role="dialog" aria-labelledby="AddDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingDistrict"><i class="ace-icon fa fa-globe cyan"></i> | New District</h4>
            </div>
            <div class="modal-body">
                <form id="formDistrict" name="formDistrict">
                <input type="hidden" name="dis_id" id="dis_id">
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="form-control input-lg select2-single" style="width:500px;" id="dis_provid" name="dis_provid"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">District Name:</label>
                        <input type="text" class="form-control" id="dis_name" name="dis_name" >
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="dis_bps_code" name="dis_bps_code">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input id="dis_status_active" name="dis_status" type="radio" class="ace"  value="1"/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input id="dis_status_inactive" name="dis_status" type="radio" class="ace" value="2"/>
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnDistrict" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>

<!-- END District MODAL -->