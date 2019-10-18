<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="modalBenefit">
        <div class="modal-dialog  modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingBenefit">
                        New Benefit Type
                    </h4>
                </div>
                <form class="form-horizontal" role="form" id="formBenefit" name="formBenefit" action="javascript:void(0);">
    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <input type="hidden" name="benhdr_id" id="benhdr_id">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Desc</label>
    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="benhdr_desc" name="benhdr_desc" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Start Date</label>
    
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="benhdr_start_date" name="benhdr_start_date" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit End Date</label>
    
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="benhdr_end_date" name="benhdr_end_date" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                {{--  <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Agework</label>
    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="benhdr_agework" name="benhdr_agework" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Severance</label>
    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bendtl_severance" name="bendtl_bendtl_severance" placeholder="Enter Severance Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Appreciation</label>
    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bendtl_appreciation" name="bendtl_appreciation" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Benefit Split</label>
    
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bendtl_split" name="bendtl_split" placeholder="Enter Benefit Name" class="col-xs-10 col-sm-5" required/>
                                    </div>
                                </div>  --}}
    
                                {{-- <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> </label>
                                    <div class="col-sm-9">
                                        <a id="mortalitaAddDtl" href="#"" class="btn btn-info">
                                            Tambah Detail
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
    
                                    </div>
                                </div>  --}}

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
                                
                            </div>
                        </div>

                        <div style="overflow-x:scroll;" class="mb-20">
                            <table class="table table-responsive table-striped table-bordered table-hover" style="width: 1700px;">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Masa Kerja</td>
                                        <td>Uang Pesangon</td>
                                        <td>UPMK</td>
                                        <td>UPH</td>
                                        <td>Perminttan Sendiri (Undur Diri)</td>
                                        <td>Imbalan saat di Usia Pensun</td>
                                        <td>Kenaikan Imbalan</td>
                                        <td>Imbalan Per Unit Masakerja</td>
                                        <td>Imbalan pada saat Meninggal Dunia</td>
                                        <td>Imbalan pada saat menderita Cacad</td>
                                    </tr>
                                </thead>
                                <tbody id="benefitDtl">
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
                            <button id="saveBtnBenefit" class="btn btn-info" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
    
            </div>
        </div>
    </div>