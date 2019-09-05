<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="modalCompanyType">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingCompanyType">
                    New Company Type
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formCompanyType" name="formCompanyType">
                            <input type="hidden" name="coytypehdr_id" id="coytypehdr_id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company Type </label>

                                <div class="col-sm-9">
                                    <input type="text" id="coytypehdr_name" name="coytypehdr_name" placeholder="Username" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description </label>

                                <div class="col-sm-9">
                                    <textarea id="coytypehdr_desc" name="coytypehdr_desc" class="form-control" id="form-field-8" placeholder="Default Text"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="coytypehdr_status" id="coytypehdr_status_active" type="radio" class="ace" value="1" />
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            <input name="coytypehdr_status" id="coytypehdr_statu_inactive" type="radio" class="ace" value="2" />
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
                    <button id="saveBtnCompanyType" class="btn btn-info" type="button">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>