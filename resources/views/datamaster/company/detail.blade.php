@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-cogs cogs-icon"></i>
                        <a href="#">Data Master</a>
                    </li>

                    <li>
                        <a href="#">Setup Company Type</a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        <small> Data Master </small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <small>Setup Company Type</small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Setup Company Type Detail
                    </h1>
                </div>

                <div class="nav-search" id="nav-search">
                    <span class="input-icon">
                        <!-- <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i> -->
                        <a href="#" id="createCompanyTypeDetail" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Company Type Detail</a>
                    </span>
                </div>
                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="tableCompanyTypeDetail" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="23px">No</th>
                                <th width="180px">Actions</th>
                                <th>Tingkat Cacat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <!-- modal registration form -->
        @include('datamaster.company.formDetail') 

        <!-- End modal registration form -->
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        var module = 'CompanyTypeDetail';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{ route('company.index') }}/getdetail/{{ $id }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'action', orderable: false, searchable: false, data: 'action'},
                {name: 'coytypedtl_assumpt_value', data: 'coytypedtl_assumpt_value'},//
                {name: 'statusName', data: 'statusName'},//
            ]

        });

        $(`#create${module}`).click(function () {
            $(`#saveBtn${module}`).html("Save");
            $(`#form${module}`).trigger("reset");
            $('#coytypedtl_id').val('');
            $('#modelHeading'+module).html(`Create New  ${module}`);
            $(`#modal${module}`).modal('show');
        });

        $('body').on('click', `.edit${module}`, function () {
            var id = $(this).data('id');
            $.get("{{ route('detail.index') }}" +`/${id}/edit`, (data) => {
                $('#modelHeading'+module).html(`Edit ${module}`);
                $(`#saveBtn${module}`).html("Edit");
                $(`#modal${module}`).modal('show');
                $.each(data, (key,val) => {
                    $(`#${key}`).val(val);
                });

                if(data.coytypehdr_status == 1){
                    $("#coytypehdr_status_active").prop("checked", true);
                } else if(data.coytypehdr_status != 1){
                    $("#coytypehdr_status_inactive").prop("checked", true);
                }
            })
        });

        $(`#saveBtn${module}`).click( function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $(`#form${module}`).serialize(),
                url: "{{ route('detail.store') }}",
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
                url: "{{ route('detail.store') }}"+'/'+id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

    
</script>
@endsection
