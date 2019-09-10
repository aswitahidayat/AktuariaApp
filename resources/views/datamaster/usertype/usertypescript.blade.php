<script type="text/javascript">
    $(function () {
        var module ='UserType';
        var table = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //show data
        function fill_datatable(name = '') {
            table = $(`#table${module}`).DataTable({
                bLengthChange: true,
                    info: false,
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searching: false,
                ajax: {
                        url: "{{ route('searchusertype') }}",
                        type: "POST",
                        data: {
                            name: name
                        }
                    }, 
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {name: 'action', orderable: false, searchable: false,data: 'action'},
                    {name: 'usertype_name', data: 'usertype_name'},//
                    {name: 'usertype_status', data: 'statusName'},//
                ]
            });
        }

        fill_datatable();
 
        $( `#formSearch${module}` ).submit(function() {
            $(`#table${module}`).DataTable().destroy();
            fill_datatable($("#search_name").val());
        });


        //show modal
        $(`#create${module}`).click(function () {
            $('#saveBtn').html('Save');
            $('#usertype_id').val('');
            $('#UsertypeForm').trigger("reset");
            $('#modelHeading').html("Create New User Type");
            $('#saveBtn').removeAttr("disabled");
            $('#ajaxModel').modal('show');
        });

        //ad & ed
        $('body').on('click', '.editUsertype', function () {
            var id = $(this).data('id');
            $.get("{{ route('usertype.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit User Type");
                $('#saveBtn').html("Edit");
                $('#ajaxModel').modal('show');

                $.each(data, (key,val) => {
                    if($(`#${key}`).length) $(`#${key}`).val(val);
                });
                if(data.usertype_status == 1){
                    $("#usertype_status_active").prop("checked", true);
                } else if(data.usertype_status != 1){
                    $("#usertype_status_inactive").prop("checked", true);
                }
            })
        });

        $( "#UsertypeForm" ).submit(function( e ) {
            e.preventDefault();

            $('#saveBtn').html('Sending..');
            $("#saveBtn").attr("disabled", true);
            $.ajax({
                data: $('#UsertypeForm').serialize(),
                url: "{{ route('usertype.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#UsertypeForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                    $('#saveBtn').removeAttr("disabled");
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                    $('#saveBtn').removeAttr("disabled");
                }
            });
        });

        //delete
        $('body').on('click', '.deleteUsertype', function () {
            var id = $(this).data("id");
            if(confirm("Are You sure want to delete !")){
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
            }
        });
    });
</script>