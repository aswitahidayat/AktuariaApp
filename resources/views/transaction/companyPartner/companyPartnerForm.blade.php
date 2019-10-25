<div class="modal fade" id="modelPartner" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeading"><i class="ace-icon fa fa-user cyan"></i> | New User Type</h4>
            </div>
            <form id="partnerForm" name="partnerForm" class="form-horizontal">
                <div class="modal-body">
                
                    <div class="row">
                        <div class="col-xs-6" style="padding-right: 20px;padding-left: 20px;">
                            <input type="hidden" name="bizpart_id" id="bizpart_id">
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Partner Name :</label>
                                <input type="text" class="form-control" id="bizpart_coy_name" name="bizpart_coy_name" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Partner Type :</label>
                                <div class="col-sm-12 p0">
                                    <select class="chosen-select form-control"  
                                        id="bizpart_coytype_hdr" name="bizpart_coytype_hdr" placeholder="Company Type" style="width:100%;">                            
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Partner NPWP :</label>
                                <input type="text" class="form-control" id="bizpart_coy_npwp" name="bizpart_coy_npwp" placeholder="Enter VPWP" value="" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Alamat :</label>
                                <input type="text" class="form-control" id="bizpart_coy_addr" name="bizpart_coy_addr" placeholder="Enter Address" value="" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Prov :</label>
                                <div class="col-sm-12 p0">
                                    <select id="bizpart_coy_provid" name="bizpart_coy_provid" class="form-control input-lg select2-single" 
                                        placeholder="Provinsi" style="width:100%;" ></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Kab/Kota :</label>
                                <div class="col-sm-12 p0">
                                    <select class="chosen-select form-control" 
                                        id="bizpart_coy_disid" name="bizpart_coy_disid" placeholder="Kota/Kabupaten" >
                                        <option value="" disabled selected>Kota/Kabupaten</option>            
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Kecamatan :</label>
                                <div class="col-sm-12 p0">
                                    <select class="chosen-select form-control" 
                                        id="bizpart_coy_subdisid" name="bizpart_coy_subdisid" placeholder="Kota/Kabupaten" >
                                        <option value="" disabled selected>Kecamatan</option>
            
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Pos :</label>
                                <div class="col-sm-12 p0">
                                    <select class="chosen-select form-control" 
                                        id="bizpart_coy_zipcode" name="bizpart_coy_zipcode" placeholder="Kota/Kabupaten" />
                                        <option value="" disabled selected>Pos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Tlp :</label>
                                <input type="text" class="form-control" id="bizpart_coy_phone1" name="bizpart_coy_phone1" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
        
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Tlp2 :</label>
                                <input type="text" class="form-control" id="bizpart_coy_phone2" name="bizpart_coy_phone2" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
        
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Email :</label>
                                <input type="text" class="form-control" id="bizpart_coy_email" name="bizpart_coy_email" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
        
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Fax :</label>
                                <input type="text" class="form-control" id="bizpart_coy_fax" name="bizpart_coy_fax" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
        
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">Web :</label>
                                <input type="text" class="form-control" id="bizpart_coy_web" name="bizpart_coy_web" placeholder="Enter Name" value="" maxlength="50" required>
                            </div>
        
                            <div class="form-group">
                                <label for="message-text" class="col-form-label bolder">Status:</label>
                                <div class="radio" id="bizpart_status">
                                    <label>
                                        <input name="bizpart_status" id="bizpart_status_active" type="radio" class="ace" value="1" />
                                        <span class="lbl"> Active</span>
                                    </label>
                                    <label>
                                        <input name="bizpart_status" id="bizpart_status_inactive" type="radio" class="ace" value="2" />
                                        <span class="lbl"> Inactive</span>
                                    </label>
                                </div>
                            </div>  
                        </div>
                        <div class="col-xs-6" style="padding-right: 20px;padding-left: 20px;">

                            <div class="form-group">
                            
                                <label for="usertype_name" class="col-form-label bolder">PIC Nama :</label>
                                <input id="bizpart_pic_name" name="bizpart_pic_name" type="text" class="form-control" required/>
                            </div>
                        
                                
                            <div class="form-group">
                                <label for="usertype_name" class="col-form-label bolder">PIC Email :</label>
                                <input id="bizpart_pic_email" name="bizpart_pic_email" type="email" class="form-control"/>
                            </div>
                            
                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                    <label for="usertype_name" class="col-form-label bolder">PIC Type Id :</label>

                                    <select class="chosen-select form-control" 
                                        id="bizpart_pic_typeid" name="bizpart_pic_typeid" >
                                    </select>
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                    <label for="usertype_name" class="col-form-label bolder">PIC Id Number :</label>
                                    <input id="bizpart_pic_idnum" name="bizpart_pic_idnum" type="text" class="form-control" />
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                    <label for="usertype_name" class="col-form-label bolder">PIC Phone :</label>
                                    <input id="bizpart_pic_hp" name="bizpart_pic_hp" type="text" class="form-control" />
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                        <label for="usertype_name" class="col-form-label bolder">PIC Birthplace :</label>
                                    <input id="bizpart_pic_birthplace" name="bizpart_pic_birthplace" type="text" class="form-control"  />
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                    <label for="usertype_name" class="col-form-label bolder">PIC Birthdate :</label>
                                    <input id="bizpart_pic_birthdate" name="bizpart_pic_birthdate" type="date" class="form-control" placeholder="Birth Date" />
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="block input-icon input-icon-right">
                                    <label for="usertype_name" class="col-form-label bolder">PIC NPWP :</label>
                                    <input id="bizpart_pic_npwp" name="bizpart_pic_npwp" type="text" class="form-control" placeholder="NPWP" />
                                    <i class="ace-icon fa fa-barcode"></i>
                                </span>
                            </div>

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