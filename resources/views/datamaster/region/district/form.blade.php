<!-- BEGIN MODAL DISTRICT -->
<div class="modal fade" id="AddDistrictModal" tabindex="-1" role="dialog" aria-labelledby="AddDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddDistrictModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New District</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="chosen-select form-control" id="province-name" data-placeholder="Choose a State...">
                            <option value="">  </option>
                            <option value="AL">Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">District Name:</label>
                        <input type="text" class="form-control" id="district-name">
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
<!-- END District MODAL -->