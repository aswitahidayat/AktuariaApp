<!-- BEGIN MODAL SUBDISTRICT -->
<div class="modal fade" id="modalZip"  role="dialog" aria-labelledby="AddZipModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddZipModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Zip</h4>
            </div>
            <div class="modal-body">
                <form id="formZip" name="formZip">
                    <input type="hidden" name="zipcode_id" id="zipcode_id">
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="zip_provid" name="zip_provid" 
                                placeholder="Choose a Province..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control" id="zip_disid" name="zip_disid" 
                                placeholder="Choose a District..." style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Sub District Name:</label>
                        <select class="chosen-select form-control" id="zip_subdisid" name="zip_subdisid" 
                                placeholder="Choose a District..." style="width:100%;"></select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Village Name:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <select class="chosen-select form-control"  id="zip_villid" name="zip_villid" 
                                placeholder="Sub District..." style="width:100%;"></select>                         
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Zip Code:</label>
                        <div class="col-sm-12 p0 pb-20">
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Sub District...">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input id="zip_status_active" name="zip_status" type="radio" class="ace"  value="1"/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input id="zip_status_inactive" name="zip_status" type="radio" class="ace" value="2"/>
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" id="saveBtnZip" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END SUBDistrict MODAL -->