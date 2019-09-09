<div id="district" class="tab-pane fade">
    <div class="page-header">
        <h1>
            <small>
                Setup Region Type
            </small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Setup District
        </h1>
    </div>
    <form id="formSearchDistrict" action="javascript:void(0);">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="province-name" class="col-sm-4 control-label no-padding-right">Province Name:</label>
                    <div class="col-sm-8 pb-20">
                        <select class="form-control input-lg select2-single" style="width:100%;" id="search_dis_provid" style="padding: 0px 12px;"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right">District Name:</label>
                    <div class="col-sm-8 pb-20">
                        <input type="text" class="form-control" id="search_dis_name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8 pb-20">
                        <a href="#" id="createDistrict" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add District</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!-- <div class="nav-search" id="nav-search">

            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>

    </div> -->
    <div class="row">
        <table id="tableDistrict" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
            <tr>
                <th width="23px">No</th>
                <th>Province Name</th>
                <th>District Name</th>
                <th>BPS Code</th>
                <th>Status</th>
                <th width="103px">Actions</th>
            </tr>
            </thead>

            <tbody></tbody>
        </table>
    </div>
</div>


<script>
$(function () {
    var module = 'District';
    var table = {};
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fill_datatable(provid = '', name = '') {
        table = $(`#table${module}`).DataTable({
            bLengthChange: true,
            info: false,
            processing: true,
            serverSide: true,
            ordering: true,
            searching: false,
            ajax: {
                url: "{{ route('getdistrict') }}",
                type: "POST",
                data: {
                    provid: provid,
                    name: name
                }
            }, 
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'prov_name', data: 'prov_name'},//
                {name: 'dis_name', data: 'dis_name'},//
                {name: 'dis_bps_code', data: 'dis_bps_code'},//
                {name: 'statusName', data: 'statusName'},//
                {name: 'action', orderable: false, searchable: false, data: 'action'},
            ]
    
        });
    }

    fill_datatable();
    
    $( `#formSearch${module}` ).submit(function() {
        $(`#table${module}`).DataTable().destroy();
        fill_datatable($("#search_dis_provid").val(), $("#search_dis_name").val());
    });

    $(`#create${module}`).click(function () {
        $("#dis_id").val('');
        $(`#saveBtn${module}`).html("Save");
        $(`#form${module}`).trigger("reset");
        $('#modelHeading'+module).html(`Create New  ${module}`);
        $(`#modal${module}`).modal('show');
        $(`#dis_provid`).html("");
        $.ajax({
            url: "{{ route('province.index') }}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                let provHtml = '';
                $.each(data.data, (key, prov) => {
                    provHtml +=  `<option value="${prov.prov_id}" >${prov.prov_name}</option>`
                });
                $(`#dis_provid`).html(provHtml);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#dis_provid').select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#modal${module}`),
        ajax: {
            url: "{{ route('searchprovince') }}",
            dataType: 'json',
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            delay: 250,
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

    $('#search_dis_provid').select2({
        placeholder: 'Cari...',
        ajax: {
            url: "{{ route('searchprovince') }}",
            dataType: 'json',
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            delay: 250,
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
    

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');

        $.get("{{ route('district.index') }}" +`/${id}/edit`, (data) => {
            $(`#form${module}`).trigger("reset");
            $(`#dis_provid`).html("");
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            if(data.dis_status == 1){
                $("#dis_status_active").prop("checked", true);
            } else if(data.dis_status != 1){
                $("#dis_status_inactive").prop("checked", true);
            }

            $.ajax({
                url: "{{ route('province.index') }}",
                type: "GET",
                dataType: 'json',
                success: function (datas) {
                    let provHtml = '';
                    $.each(datas.data, (key, prov) => {
                        provHtml +=  `<option value="${prov.prov_id}" >${prov.prov_name}</option>`
                    });
                    $(`#dis_provid`).html(provHtml);
                    $("#dis_provid").val(data.dis_provid);

                    $(`#modal${module}`).modal('show');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#modal${module}`).modal('show');
                }
            });
        })
    });

    $(`#saveBtn${module}`).click( function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        var data = $(`#form${module}`).serialize();
        debugger;
        $.ajax({
            data: $(`#form${module}`).serialize(),
            url: "{{ route('district.store') }}",
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
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "DELETE",
            url: "{{ route('district.store') }}"+'/'+id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
})
</script>
@include('datamaster.region.district.form') 