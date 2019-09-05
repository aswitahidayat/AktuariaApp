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
                <a href="#">Setup User Type</a>
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
                 Setup User Type
             </h1>
        </div>
        <div align="right">
        <span class="input-icon">
            <a href="javascript:void(0)" id="createNewUsertype" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add User Type</a>
        </span>
        </div>
        <br>
        <table id="tableUsertype" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="23px">No</th>
                <th>Name</th>
                <th>Descryption</th>
                <th>Status</th>
                <th width="103px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
 </div>
</div>

<!-- modal registration form -->
@include('datamaster.usertype.form') 
<!-- End modal registration form -->

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //show data

        var table = $('#tableUsertype').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('usertype.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {name: 'usertype_name', data: 'usertype_name'},//
                {name: 'usertype_desc', data: 'usertype_desc'},//
                {name: 'usertype_status', data: 'statusName'},//
                {name: 'action', orderable: false, searchable: false,data: 'action'},
            ]

        });


        //show modal
        $('#createNewUsertype').click(function () {
            $('#saveBtn').val("create-usertype");
            $('#usertype_id').val('');
            $('#UsertypeForm').trigger("reset");
            $('#modelHeading').html("Create New User Type");
            $('#ajaxModel').modal('show');
        });

        //ad & ed
        $('body').on('click', '.editUsertype', function () {
            var id = $(this).data('id');
            $.get("{{ route('usertype.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit User Type");
                $('#saveBtn').val("edit-usertype");
                $('#ajaxModel').modal('show');
                $('#usertype_id').val(data.usertype_id);
                $('#usertype_name').val(data.usertype_name);
                $('#usertype_desc').val(data.usertype_desc);
                if(data.usertype_status == 1){
                    $("#usertype_status_active").prop("checked", true);
                } else if(data.usertype_status != 1){
                    $("#usertype_status_inactive").prop("checked", true);
                }
            })
        });
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#UsertypeForm').serialize(),
                url: "{{ route('usertype.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#UsertypeForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save Changes');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        //delete
        $('body').on('click', '.deleteUsertype', function () {
            var id = $(this).data("id");
            confirm("Are You sure want to delete !");
            $.ajax({
                type: "DELETE",
                url: "{{ route('usertype.store') }}"+'/'+id,
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
