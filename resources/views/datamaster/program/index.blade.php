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
                        <a href="#">Setup Order Program</a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        <small> Data Master</small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Setup Order Program
                    </h1>
                </div>

                <div align="right">
                    <span class="input-icon">
                        <!-- <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i> -->
                        <a href="#" id="createOrderProgram" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Order Program</a>
                    </span>

                </div>
                <br>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="23px">No</th>
                            <th>Order Program Name</th>
                            <th width="17%">Status</th>
                            <th width="103px">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @include('datamaster.program.form') 

    <script type="text/javascript">
        $(function () {
            var module = "OrderProgram";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#search').on('keyup',function(){
                $value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('search')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            });
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            
            var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: "{{ route('program.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {name: 'ordprg_name', data: 'ordprg_name'},//
                        {name: 'ordprg_status', data: 'ordprg_status'},//
                        {name: 'action', orderable: false, searchable: false,data: 'action'},
                    ]

                });
            
            $(`#create${module}`).click(function () {
                $(`#saveBtn${module}`).html("Save");
                $(`#form${module}`).trigger("reset");
                $('#modelHeading'+module).html(`Create New  ${module}`);
                $(`#modal${module}`).modal('show');
            });

            $('body').on('click', `.edit${module}`, function () {
                var id = $(this).data('id');

                $.get("{{ route('program.index') }}" +`/${id}/edit`, (data) => {
                    $('#modelHeading'+module).html(`Edit ${module}`);
                    $(`#saveBtn${module}`).html("Edit");
                    $(`#modal${module}`).modal('show');
                    
                    $.each(data, (key,val) => {
                        $(`#${key}`).val(val);
                    });

                    if(data.ordprg_status == 1){
                        $("#ordprg_status_active").prop("checked", true);
                    } else if(data.ordprg_status != 1){
                        $("#ordprg_status_inactive").prop("checked", true);
                    }
                })
            });

            $(`#saveBtn${module}`).click( function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var data = $(`#form${module}`).serialize();
                $.ajax({
                    data: $(`#form${module}`).serialize(),
                    url: "{{ route('program.store') }}",
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
                    url: "{{ route('program.store') }}"+'/'+id,
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
