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
                        <a href="#">Setup Identity</a>
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
                        Setup Identity
                    </h1>
                </div>
                <div align="right">
        <span class="input-icon">
            <a href="javascript:void(0)" id="createNewIdentity" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Identity</a>
        </span>
                </div>
                <br>
                <table class="table table-bordered data-table">
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
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="modelHeading"><i class="ace-icon fa fa-user cyan"></i> | New Identity</h4>
                </div>
                <div class="modal-body">
                    <form id="IdentityForm" name="IdentityForm" class="form-horizontal">
                        <input type="hidden" name="typeid_id" id="typeid_id">
                        <div class="form-group">
                            <label for="typeid_name" class="col-form-label bolder">Identity Name :</label>
                            <input type="text" class="form-control" id="typeid_name" name="typeid_name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label for="identity_desc" class="col-form-label bolder">Identity Desc :</label>
                            <textarea id="typeid_desc" name="typeid_desc" required="" placeholder="Enter Description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Status:</label>
                            <div class="radio">
                                <label>
                                    <input name="typeid_status" type="radio" class="ace" value="1" checked/>
                                    <span class="lbl"> Active</span>
                                </label>
                                <label>
                                    <input name="typeid_status" type="radio" class="ace" value="2" />
                                    <span class="lbl"> Inactive</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal registration form -->

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //show data

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('identity.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {name: 'typeid_name', data: 'typeid_name'},//
                    {name: 'typeid_desc', data: 'typeid_desc'},//
                    {name: 'typeid_status', data: 'typeid_status'},//
                    {name: 'action', orderable: false, searchable: false,data: 'action'},
                ]

            });


            //show modal
            $('#createNewIdentity').click(function () {
                $('#saveBtn').val("create-identity");
                $('#typeid_id').val('');
                $('#IdentityForm').trigger("reset");
                $('#modelHeading').html("Create New Identity");
                $('#ajaxModel').modal('show');
            });

            //ad & ed
            $('body').on('click', '.editIdentity', function () {
                var id = $(this).data('id');
                $.get("{{ route('identity.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Identity");
                    $('#saveBtn').val("edit-identity");
                    $('#ajaxModel').modal('show');
                    $('#typeid_id').val(data.typeid_id);
                    $('#typeid_name').val(data.typeid_name);
                    $('#typeid_desc').val(data.typeid_desc);
                    $('#typeid_status').val(data.typeid_status);
                })
            });
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#IdentityForm').serialize(),
                    url: "{{ route('identity.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#IdentityForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            //delete
            $('body').on('click', '.deleteIdentity', function () {
                var id = $(this).data("id");
                confirm("Are You sure want to delete !");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('identity.store') }}"+'/'+id,
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
