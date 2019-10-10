@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-money cogs-icon"></i>
                        <a href="#">Transaction</a>
                    </li>

                    <li>
                        <a href="#">Register Agent</a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        <small>
                            Transaction
                        </small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Register Agent
                    </h1>
                </div>

                <form id="formSearchAgent" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Agent Name:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="text" class="form-control" id="search_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 pb-20">
                                    <a href="#" id="createAgent" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Agent</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="row">
                    <table id="tableAgent" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="13%">No</th>
                            <th width="13%">Actions</th>
                            <th>Agent Name</th>
                            <th>Email</th>
                            <th width="15%">Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
    @include('transaction.agent.agentForm')

    <script type="text/javascript">
        var module = 'Agent';
        var table = {};
        var varresult = {};

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fill_datatable();
        });

        function fill_datatable(name = ''){
            table = $(`#table${module}`).DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ordering: false,
                ajax: {
                        url: "{{ route('searchagent') }}",
                        type: "POST",
                        data: {
                            name: name
                        }
                    }, 
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                    {name: 'action', orderable: false, searchable: false, data: 'action'},
                    {name: 'regis_name', data: 'regis_name'},//
                    {name: 'user_email', data: 'user_email'},//

                    {name: 'statusName', data: 'statusName'},//
                ]

            });
        }

        $( `#formSearch${module}` ).submit(function() {
            $(`#table${module}`).DataTable().destroy();
            fill_datatable($("#search_name").val());
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
        })

        $(`#create${module}`).click(function () {
            $(`#saveBtn${module}`).html("Save");
            $(`#form${module}`).trigger("reset");
            $('#coytypehdr_id').val('');
            $('#modelHeading'+module).html(`Create New  ${module}`);
            $(`#modal${module}`).modal('show');
            $(`#assumption`).html('');
            selectIdentity()
        });

        $( `#form${module}` ).submit(function( e ) {
            $(`#saveBtn${module}`).html('Sending..');
            $(`#saveBtn${module}`).attr("disabled", true);
            
            var dataall = $(`#form${module}`).serialize();

            $.ajax({
                data: dataall,
                url: "{{ route('agent.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $(`#form${module}`).trigger("reset");
                    $(`#modal${module}`).modal('hide');
                    table.draw();
                    $(`#saveBtn${module}`).html('Save');
                    $(`#saveBtn${module}`).removeAttr("disabled");
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#saveBtn${module}`).html('Save');
                    $(`#saveBtn${module}`).removeAttr("disabled");

                }
            });
        });

        $('body').on('click', `.edit${module}`, function () {
            var id = $(this).data('id');
            $.get("{{ route('agent.index') }}" +`/${id}/edit`, (data) => {
                $('#modelHeading'+module).html(`Edit ${module}`);
                $(`#saveBtn${module}`).html("Edit");
                $(`#modal${module}`).modal('show');
                
                $(`#user_id`).val(`${data.user_id}`);
                $(`#regis_id`).val(`${data.regis_id}`);
                $(`#bizpart_id`).val(`${data.bizpart_id}`);

                $(`#agent_name`).val(`${data.regis_name}`);
                $(`#agent_email`).val(`${data.regis_email}`);
                // $(`#type_identity`).val(`${data.regis_typeid}`);
                $(`#identity_number`).val(`${data.regis_id_num}`);
                $(`#agent_phone`).val(`${data.regis_hp}`);
                $(`#agent_birth_place`).val(`${data.regis_birthplace}`);
                $(`#agent_birth_date`).val(`${data.regis_birthdate}`);
                $(`#npwp`).val(`${data.regis_npwp}`);

                selectIdentity(data.regis_typeid);

                if(data.user_status == 1){
                    $("#agent_status_active").prop("checked", true);
                } else {
                    $("#agent_status_inactive").prop("checked", true);
                }
            })
        });

        $("#agent_email").blur(function() {
            if($("#agent_email").val() != ""){
                $.ajax({
                    data: {
                        email: $("#agent_email").val(),
                    },
                    url: "{{ route('emailchecker') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(!data.success){
                            $( "#email_err" ).show();
                            $("#agent_email").val('')
                        } else {
                            $( "#email_err" ).hide();
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $(`#saveBtn${module}`).html('Save');
                        $(`#saveBtn${module}`).removeAttr("disabled");

                    }
                });   
            }
        });

        function selectIdentity(val){
            $.ajax({
                url: "{{ route('searchidentity') }}",
                type: "POST",
                dataType: 'json',
                success: function (datas) {
                    let provHtml = '';
                    $.each(datas.data, (key, identity) => {
                        provHtml +=  `<option value="${identity.typeid_id}" >${identity.typeid_name}</option>`
                    });
                    $(`#type_identity`).html(provHtml);
                    $("#type_identity").val(val);

                    $(`#modal${module}`).modal('show');
                    $('#type_identity').select2();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#modal${module}`).modal('show');
                }
            });
        }
    
    </script>
@endsection
