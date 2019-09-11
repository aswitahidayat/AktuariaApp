<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="modalCompanyTypeDetail">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingCompanyTypeDetail">
                    New Company Type
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formCompanyTypeDetail" name="formCompanyTypeDetail">
                            <input type="hidden" name="coytypedtl_id" id="coytypedtl_id">
                            <input type="hidden" name="coytypedtl_hdrid" id="coytypedtl_hdrid" value= {{ $id }}>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tingkat Cacat </label>

                                <div class="col-sm-9">
                                    <input type="text" id="coytypedtl_assumpt_value" name="coytypedtl_assumpt_value" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="coytypedtl_status" id="coytypedtl_status_active" type="radio" class="ace" value="1" />
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            <input name="coytypedtl_status" id="coytypedtl_status_inactive" type="radio" class="ace" value="2" />
                                            <span class="lbl"> Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                          
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn" data-dismiss="modal" type="button">
                        Cancel
                    </button>
                    &nbsp; &nbsp; &nbsp;
                    <button id="saveBtnCompanyTypeDetail" class="btn btn-info" type="button">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>