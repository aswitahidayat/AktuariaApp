<!-- BEGIN MODAL SUBDISTRICT -->
<div class="modal fade" id="modalVillage"  role="dialog" aria-labelledby="AddVillageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddVillageModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Village</h4>
            </div>
            <div class="modal-body">
                <form id="formVillage" name="formVillage">
                    <input type="hidden" name="vill_id" id="vill_id">
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="vill_provid" name="vill_provid" 
                                placeholder="Choose a Province..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="vill_disid" name="vill_disid" 
                                placeholder="Choose a District..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Sub District Name:</label>
                        <select class="chosen-select form-control" id="vill_subdisid" name="vill_subdisid" 
                                placeholder="Choose a District..." style="width:100%;"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Village Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <input type="text" class="form-control" id="vill_name" name="vill_name" placeholder="Sub District...">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="vill_bps_code" name="vill_bps_code" placeholder="BPSCODE...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input id="vill_status_active" name="vill_status" type="radio" class="ace"  value="1"/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input id="vill_status_inactive" name="vill_status" type="radio" class="ace" value="2"/>
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnVillage" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END SUBDistrict MODAL -->