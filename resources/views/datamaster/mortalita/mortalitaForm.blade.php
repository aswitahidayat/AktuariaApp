<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="modalMortalita">
    <div class="modal-dialog  modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingMortalita">
                    New Mortalita Type
                </h4>
            </div>
            <form class="form-horizontal" role="form" id="formMortalita" name="formMortalita" action="javascript:void(0);">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <input type="hidden" name="mortalitahdr_id" id="mortalitahdr_id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mortalita Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mortalitahdr_name" name="mortalitahdr_name" placeholder="Enter Mortalita Name" class="col-xs-10 col-sm-5" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="mortalitahdr_status" id="mortalitahdr_status_active" type="radio" class="ace" value="1" required/>
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            <input name="mortalitahdr_status" id="mortalitahdr_statu_inactive" type="radio" class="ace" value="2" required/>
                                            <span class="lbl"> Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agework  </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" 
                                            id="agework" name="agework" placeholder="Enter Company Name" 
                                            class="col-xs-10 col-sm-5" value="0"/>
                                            <a href="#" class="input-group-addon">
                                                <span id="jml_thn_proc" >
                                                    <i class="fa fa-arrow-right"></i>
                                                </span>
                                            </a>
                                    </div>

                                </div>
                            </div>


                            {{-- <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> </label>
                                <div class="col-sm-9">
                                    <a id="mortalitaAddDtl" href="#"" class="btn btn-info">
                                        Tambah Detail
                                        <i class="fa fa-arrow-right"></i>
                                    </a>

                                </div>
                            </div>  --}}
                            
                        </div>
                    </div>
                    <div style="overflow-x:scroll;" class="mb-20">
                        <table class="table table-responsive table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Masa Kerja</td>
                                    <td>Persentasi</td>
                                </tr>
                            </thead>
                            <tbody id="mortalitaDtl">
                                <tr>
                                    <td colspan="100%">-</td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn" data-dismiss="modal" type="button">
                            Cancel
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button id="saveBtnMortalita" class="btn btn-info" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>