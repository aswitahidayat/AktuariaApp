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
                        <a href="#">Setup Order Service</a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        <small>
                        Data Master
                        </small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Setup Order Service
                    </h1>
                </div>

                <form id="formSearchOrderService" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Order Service Name:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="text" class="form-control" id="search_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 pb-20">
                                    <a href="#" id="createOrderService" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Order Service</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="tableOrderService" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Service Name</th>
                                <th>Price</th>
                                <th width="17%">Status</th>
                                <th width="13%">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('datamaster.service.form') 

    <script type="text/javascript">
        $(function () {
            var module = 'OrderService';
            var table = {};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function fill_datatable(name = '') {
                table = $(`#table${module}`).DataTable({
                    bLengthChange: true,
                    info: false,
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('searchservice') }}",
                        type: "POST",
                        data: {
                            name: name
                        }
                    }, 
                    columns: [
                        {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                        {name: 'ordsrvhdr_name', data: 'ordsrvhdr_name'},//
                        {name: 'ordsrvhdr_price', data: 'ordsrvhdr_price'},//
                        {name: 'statusName', data: 'statusName'},//
                        {name: 'action', orderable: false, searchable: false, data: 'action'},
                    ]
            
                });
            }

            fill_datatable();
            
            $( `#formSearch${module}` ).submit(function() {
                $(`#table${module}`).DataTable().destroy();
                fill_datatable($("#search_name").val());
            });

            $(`#create${module}`).click(function () {
                $(`#saveBtn${module}`).html("Save");
                $(`#form${module}`).trigger("reset");
                $('#ordsrvhdr_id').val('');
                $('#modelHeading'+module).html(`Create New  ${module}`);
                $(`#modal${module}`).modal('show');
            });

            $('body').on('click', `.edit${module}`, function () {
                var id = $(this).data('id');

                $.get("{{ route('service.index') }}" +`/${id}/edit`, (data) => {
                    $('#modelHeading'+module).html(`Edit ${module}`);
                    $(`#saveBtn${module}`).html("Edit");
                    $(`#modal${module}`).modal('show');
                    
                    $.each(data, (key,val) => {
                        $(`#${key}`).val(val);
                    });

                    if(data.ordsrvhdr_status == 1){
                        $("#ordsrvhdr_status_active").prop("checked", true);
                    } else if(data.ordsrvhdr_status != 1){
                        $("#ordsrvhdr_status_inactive").prop("checked", true);
                    }
                })
            });

            $(`#saveBtn${module}`).click( function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var data = $(`#form${module}`).serialize();
                $.ajax({
                    data: $(`#form${module}`).serialize(),
                    url: "{{ route('service.store') }}",
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
                    url: "{{ route('service.store') }}"+'/'+id,
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
