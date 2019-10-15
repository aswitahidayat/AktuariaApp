<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="modalCompanyType">
    <div class="modal-dialog  modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingCompanyType">
                    New Company Type
                </h4>
            </div>
            <form class="form-horizontal" role="form" id="formCompanyType" name="formCompanyType" action="javascript:void(0);">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <input type="hidden" name="coytypehdr_id" id="coytypehdr_id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company Type </label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="coytypehdr_name" name="coytypehdr_name" placeholder="Enter Company Name" class="col-xs-10 col-sm-5" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description </label>

                                <div class="col-sm-9">
                                    <textarea id="coytypehdr_desc" name="coytypehdr_desc" class="form-control" id="form-field-8" placeholder="Enter Company Description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="coytypehdr_status" id="coytypehdr_status_active" type="radio" class="ace" value="1" required/>
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            <input name="coytypehdr_status" id="coytypehdr_statu_inactive" type="radio" class="ace" value="2" required/>
                                            <span class="lbl"> Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jumlah tahun hitung  </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" 
                                            id="coytypehdr_count_year" name="coytypehdr_count_year" placeholder="Enter Company Name" 
                                            class="col-xs-10 col-sm-5" value="0"/>
                                            <a href="#"" class="input-group-addon"><span id="jml_thn_proc" >
                                                <i class="fa fa-arrow-right"></i></span>
                                            </a>
                                    </div>

                                </div>
                            </div> 
                            <div id="assumption">
                            </div> --}}
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn" data-dismiss="modal" type="button">
                            Cancel
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button id="saveBtnCompanyType" class="btn btn-info" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>