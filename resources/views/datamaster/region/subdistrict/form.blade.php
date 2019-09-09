<!-- BEGIN MODAL SUBDISTRICT -->
<div class="modal fade" id="modalSubDistrict"  role="dialog" aria-labelledby="AddSubDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddSubDistrictModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Sub District</h4>
            </div>
            <div class="modal-body">
                <form id="formSubDistrict" name="formSubDistrict">
                    <input type="hidden" name="subdis_id" id="subdis_id">
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="subdis_provid" name="subdis_provid" 
                                placeholder="Choose a Province..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="subdis_disid" name="subdis_disid" 
                                placeholder="Choose a District..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Sub District Name:</label>
                        <input type="text" class="form-control" id="subdis_name" name="subdis_name" placeholder="Sub District...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="subdis_bps_code" name="subdis_bps_code" placeholder="BPSCODE...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input id="subdis_status_active" name="subdis_status" type="radio" class="ace"  value="1"/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input id="subdis_status_inactive" name="subdis_status" type="radio" class="ace" value="2"/>
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnSubDistrict" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END SUBDistrict MODAL -->