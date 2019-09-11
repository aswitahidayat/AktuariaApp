<div id="subdistrict" class="tab-pane fade">
    <div class="page-header">
        <h1>
            <small>
                Setup Region Type
            </small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Setup Sub District
        </h1>
    </div>

    <form id="formSearchSubDistrict" action="javascript:void(0);">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="province-name" class="col-sm-4 control-label no-padding-right">Province Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_subdis_provid"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province-name" class="col-sm-4 control-label no-padding-right">District Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_subdis_dis"></select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 ">
                        <a href="#" id="createSubDistrict" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Sub District</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right">Sub District Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="search_subdis_name">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
        </div>

    </form>

    <div class="nav-search" id="nav-search">

            <span class="input-icon">
                <!-- <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                <i class="ace-icon fa fa-search nav-search-icon"></i> -->
            </span>

    </div>
    <div class="row" style="margin-top: 34px;">&nbsp;</div>
    <div class="row">
        <table id="tableSubDistrict" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
            <tr>
                <th width="23px">No</th>
                <th>Province Name</th>
                <th>District Name</th>
                <th>Sub District Name</th>
                <th>BPS Code</th>
                <th>Status</th>
                <th width="103px">Actions</th>
            </tr>
            </thead>

            <tbody>
           
            </tbody>
        </table>
    </div>
</div>


<script>
$(function () {
    var module = 'SubDistrict';
    var table = {};
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fill_datatableSubDis(provid = '', dis='', name = '') {
        table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searching: false,
            ajax: {
                url: "{{ route('searchsubdistrict') }}",
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
                {name: 'subdis_name', data: 'subdis_name'},//
                {name: 'subdis_bps_code', data: 'subdis_bps_code'},//
                {name: 'statusName', data: 'statusName'},//
                {name: 'action', orderable: false, searchable: false, data: 'action'},
            ]
    
        });
    }

    fill_datatableSubDis();
    
    $( "#formSearchSubDistrict" ).submit(function() {
        $(`#table${module}`).DataTable().destroy();
        fill_datatableSubDis($("#search_subdis_provid").val(), $('#search_subdis_dis').val(),$("#search_subdis_name").val());
    });


    $(`#create${module}`).click(function () {
        $(`#saveBtn${module}`).html("Save");
        $(`#form${module}`).trigger("reset");
        $('#modelHeading'+module).html(`Create New  ${module}`);
        $(`#modal${module}`).modal('show');
        $(`#subdis_provid`).html("");
        $('#subdis_id').val('');
        $.ajax({
            url: "{{ route('province.index') }}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                let provHtml = '';
                $.each(data.data, (key, prov) => {
                    provHtml +=  `<option value="${prov.prov_id}" >${prov.prov_name}</option>`
                });
                $(`#subdis_provid`).html(provHtml);
                getDistrict();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $( "#subdis_provid" ).change(function() {
        getDistrict()
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');

        $.get("{{ route('subdistrict.index') }}" +`/${id}/edit`, (data) => {
            $(`#form${module}`).trigger("reset");
            $(`#subdis_provid`).html("");
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            if(data.subdis_status == 1){
                $("#subdis_status_active").prop("checked", true);
            } else if(data.subdis_status != 1){
                $("#subdis_status_inactive").prop("checked", true);
            }

            $("#subdis_provid").val(data.dis_provid);
            $("#subdis_disid").val(data.subdis_disid);
            
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
                    $(`#subdis_provid`).html(provHtml);
                    $("#subdis_provid").val(data.dis_provid);

                    $(`#modal${module}`).modal('show');
                    getDistrict(data.subdis_disid);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#modal${module}`).modal('show');
                }
            });
        })
    });

    $('#subdis_provid').select2({
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

    $('#subdis_disid').select2({
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
                    prov: $(`#subdis_provid`).val(),
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

    $('#search_subdis_provid').select2({
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

    $('#search_subdis_dis').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchdistrict') }}",
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    q: params.term,
                    prov: $(`#search_subdis_provid`).val(),
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

    $(`#saveBtn${module}`).click( function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $(`#form${module}`).serialize(),
            url: "{{ route('subdistrict.store') }}",
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
        if( confirm("Are You sure want to delete !")){
            $.ajax({
                type: "DELETE",
                url: "{{ route('subdistrict.store') }}"+'/'+id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    function getDistrict (val){
        $(`#subdis_disid`).html('');
        let varId = $(`#subdis_provid`).val();
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
                $(`#subdis_disid`).html(disHtml);
                $("#subdis_disid").val(val);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
})
</script>

@include('datamaster.region.subdistrict.form') 