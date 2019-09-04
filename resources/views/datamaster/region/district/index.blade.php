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

    <div class="nav-search" id="nav-search">

            <span class="input-icon">
                <!-- <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                <i class="ace-icon fa fa-search nav-search-icon"></i> -->
                <a href="#" data-toggle="modal" id="createDistrict" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add District</a>
            </span>

    </div>
    <div class="row" style="margin-top: 34px;">&nbsp;</div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $(`#table${module}`).DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: "{{ route('district.index') }}",
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
            {name: 'dis_provid', data: 'dis_provid'},//
            {name: 'dis_name', data: 'dis_name'},//
            {name: 'dis_bps_code', data: 'dis_bps_code'},//
            {name: 'dis_status', data: 'dis_status'},//
            {name: 'action', orderable: false, searchable: false, data: 'action'},
        ]

    });

    $(`#create${module}`).click(function () {
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
                debugger;
                $(`#dis_provid`).html(provHtml);
            },
            error: function (data) {
                console.log('Error:', data);
                // $(`#saveBtn${module}`).html('Save Changes');
            }
        });
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');

        $.get("{{ route('district.index') }}" +`/${id}/edit`, (data) => {
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $(`#modal${module}`).modal('show');
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            if(data.prov_status == 1){
                $("#prov_status_active").prop("checked", true);
            } else if(data.prov_status != 1){
                $("#prov_status_inactive").prop("checked", true);
            }
        })
    });

    $(`#saveBtn${module}`).click( function(e) {
        e.preventDefault();
        $(this).html('Sending..');
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
            url: "{{ route('province.store') }}"+'/'+id,
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