<div id="zipcode" class="tab-pane fade">
    <div class="page-header">
        <h1>
            <small>
                Setup Region Type
            </small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Setup Zip Code
        </h1>
    </div>

    <form id="formSearchZip" action="javascript:void(0);">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="province-name" class="col-sm-4 control-label no-padding-right">Province Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_zip_provid"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province-name" class="col-sm-4 control-label no-padding-right">District Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_zip_dis"></select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right">Sub District Name:</label>
                    <div class="col-sm-8 pb-20">
                        <!-- <input type="text" class="form-control" id="search_zip_name"> -->
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_zip_subdisid"></select>

                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right">Village Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_zip_vill"></select>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 ">
                        <a href="#" id="createZip" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Zip</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <div class="row" style="margin-top: 34px;">&nbsp;</div>
    <div class="row">
        <table id="tableZip" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
            <tr>
                <th width="23px">No</th>
                <th>Province Name</th>
                <th>District Name</th>
                <th>Sub District Name</th>
                <th>Zip Code</th>
                <th>Status</th>
                <th width="103px">Actions</th>
            </tr>
            </thead>

            <tbody>
            
            </tbody>
        </table>
    </div>
</div>

@include('datamaster.region.zipcode.form') 

<script>
$(function () {
    var module = 'Zip';
    var table ={};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });     

    function fill_datatableZip(provid = '', dis='', name = '') {
        table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('searchzip') }}",
                type: "POST",
                data: {
                    provid: provid,
                    dis: dis,
                    name: name,
                }
            },
            
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'prov_name', data: 'prov_name'},//
                {name: 'dis_name', data: 'dis_name'},//  
                {name: 'subdis_name', data: 'subdis_name'},          
                {name: 'zipcode', data: 'zipcode'},//
                {name: 'statusName', data: 'statusName'},//
                {name: 'action', orderable: false, searchable: false, data: 'action'},
            ]
    
        });
    }

    fill_datatableZip();
    
    $( "#formSearchZip" ).submit(function() {
        $(`#table${module}`).DataTable().destroy();
        fill_datatableZip($("#search_zip_provid").val(), $('#search_zip_dis').val(),$("#search_zip_name").val());
    });

    $(`#create${module}`).click(function () {
        $(`#saveBtn${module}`).html("Save");
        $(`#form${module}`).trigger("reset");
        $('#modelHeading'+module).html(`Create New  ${module}`);
        $(`#modal${module}`).modal('show');
        $(`#zip_provid`).html("");
        $('#zip_id').val('');
        $.ajax({
            url: "{{ route('province.index') }}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                let provHtml = '';
                $.each(data.data, (key, prov) => {
                    provHtml +=  `<option value="${prov.prov_id}" >${prov.prov_name}</option>`
                });
                $(`#zip_provid`).html(provHtml);
                $("#subdis_provid").val(data.dis_provid);

                // getDistrictZip();
                // getSubDistrictZip();
                // getVillageZip();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $( "#zip_provid" ).change(function() {
        getDistrictZip()
    });

    $( "#zip_disid" ).change(function() {
        getSubDistrictZip()
    });

    $( "#zip_subdisid" ).change(function() {
        getVillageZip()
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');

        $.get("{{ route('zip.index') }}" +`/${id}/edit`, (data) => {
            $(`#form${module}`).trigger("reset");
            $(`#zip_provid`).html("");
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            if(data.zip_status == 1){
                $("#zip_status_active").prop("checked", true);
            } else if(data.zip_status != 1){
                $("#zip_status_inactive").prop("checked", true);
            }
            // TODO Edit zip
            $("#zip_provid").val(data.dis_provid);
            $("#zip_disid").val(data.zip_disid);
            
            $(`#modal${module}`).modal('show');

            $.ajax({
                url: "{{ route('province.index') }}",
                type: "GET",
                dataType: 'json',
                success: function (datas) {
                    let provHtml = '';
                    $.each(datas.data, (key, prov) => {
                        provHtml +=  `<option value="${prov.prov_id}" >${prov.prov_name}</option>`
                    });
                    $(`#zip_provid`).html(provHtml);
                    $("#zip_provid").val(data.dis_provid);

                    $(`#modal${module}`).modal('show');
                    getDistrictZip(data.subdis_disid);
                    getSubDistrictZip(data.subdis_id);
                    getVillageZip(data.zip_villid);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#modal${module}`).modal('show');
                }
            });
        })
    });

    $('#zip_provid').select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#modal${module}`),
        ajax: {
            url: "{{ route('searchprovince') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (prov) {
                        return {
                        text: prov.prov_name,
                        id: prov.prov_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#zip_disid').select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#modal${module}`),
        ajax: {
            url: "{{ route('searchdistrict') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    prov: $(`#zip_provid`).val(),
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data, function (dis) {
                        return {
                        text: dis.dis_name,
                        id: dis.dis_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#zip_subdisid').select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#modal${module}`),
        ajax: {
            url: "{{ route('searchsubdistrict') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    name: params.term,
                    prov: $(`#zip_provid`).val(),
                    dis: $(`#zip_disid`).val(),
                    limit: 10
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (subdis) {
                        return {
                        text: subdis.subdis_name,
                        id: subdis.subdis_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#zip_villid').select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#modal${module}`),
        ajax: {
            url: "{{ route('searchvillage') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    name: params.term,
                    prov: $(`#zip_provid`).val(),
                    dis: $(`#zip_disid`).val(),
                    subdis: $(`#zip_subdisid`).val(),
                    limit: 10
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (vill) {
                        return {
                            text: vill.vill_name,
                            id: vill.vill_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#search_zip_provid').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchprovince') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (prov) {
                        return {
                        text: prov.prov_name,
                        id: prov.prov_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#search_zip_dis').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchdistrict') }}",
            dataType: 'json',
            delay: 250,
            type: "POST",
            data: function (params, page){
                return{
                    q: params.term,
                    prov: $(`#search_zip_provid`).val(),
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data, function (dis) {
                        return {
                        text: dis.dis_name,
                        id: dis.dis_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#search_zip_subdisid').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchsubdistrict') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    name: params.term,
                    prov: $(`#search_zip_provid`).val(),
                    dis: $(`#search_zip_dis`).val(),
                    limit: 10
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (subdis) {
                        return {
                        text: subdis.subdis_name,
                        id: subdis.subdis_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#search_zip_vill').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchvillage') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    name: params.term,
                    prov: $(`#search_zip_provid`).val(),
                    dis: $(`#search_zip_disid`).val(),
                    subdis: $(`#search_zip_subdisid`).val(),
                    limit: 10
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (vill) {
                        return {
                            text: vill.vill_name,
                            id: vill.vill_id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $(`#saveBtn${module}`).click( function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $(`#form${module}`).serialize(),
            url: "{{ route('zip.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $(`#form${module}`).trigger("reset");
                $(`#modal${module}`).modal('hide');
                table.draw();
                $(`#saveBtn${module}`).html('Save Changes');
            },
            error: function (data) {
                console.log('Error:', data);
                $(`#saveBtn${module}`).html('Save Changes');
            }
        });
    });

    $('body').on('click', `.delete${module}`, function () {
        var id = $(this).data("id");
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "DELETE",
                url: "{{ route('zip.store') }}"+'/'+id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    function getDistrictZip (val){
        $(`#zip_disid`).html('');
        let varId = $(`#zip_provid`).val();
        $.ajax({
            url: `{{ route('getdistrict') }}`,
            type: "POST",
            data: {
                provid: `${varId}`
            },
            dataType: 'json',
            success: function (data) {
                let disHtml = '';
                $.each(data.data, (key, dis) => {
                    disHtml +=  `<option value="${dis.dis_id}" >${dis.dis_name}</option>`
                });
                $(`#zip_disid`).html(disHtml);
                $("#zip_disid").val(val);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function getSubDistrictZip (val){
        $(`#zip_subdisid`).html('');
        let provid = $(`#zip_provid`).val();
        let disid = $(`#zip_disid`).val();
        $.ajax({
            url: `{{ route('searchsubdistrict') }}`,
            type: "POST",
            data: {
                provid: provid,
                dis: disid,
            },
            dataType: 'json',
            success: function (data) {
                let disHtml = '';
                $.each(data.data, (key, dis) => {
                    disHtml +=  `<option value="${dis.subdis_id}" >${dis.subdis_name}</option>`
                });
                $(`#zip_subdisid`).html(disHtml);
                $("#zip_subdisid").val(val);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function getVillageZip (val){
        $(`#zip_villid`).html('');
        let provid = $(`#zip_provid`).val();
        let disid = $(`#zip_disid`).val();
        let subdis = $(`#zip_subdisid`).val();
        $.ajax({
            url: `{{ route('searchvillage') }}`,
            type: "POST",
            data: {
                provid: provid,
                dis: disid,
                subdis: subdis,
            },
            dataType: 'json',
            success: function (data) {
                let disHtml = '';
                $.each(data.data, (key, dis) => {
                    disHtml +=  `<option value="${dis.vill_id}" >${dis.vill_name}</option>`
                });
                $(`#zip_villid`).html(disHtml);
                $("#zip_villid").val(val);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
})
</script>
