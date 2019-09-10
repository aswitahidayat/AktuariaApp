<script type="text/javascript">
    $(function () {
        var module = 'Identity';
        var table = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //show data
        function fill_datatable(name = '') {
            table = $(`#table${module}`).DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                searching: false,
                ajax: {
                    url: "{{ route('searchidentity') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {name: 'action', orderable: false, searchable: false,data: 'action'},
                    {name: 'typeid_name', data: 'typeid_name'},//
                    {name: 'statusName', data: 'statusName'},//
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
            $('#typeid_id').val('');
            $(`#form${module}`).trigger("reset");
            $('#modelHeading').html("Create New Identity");
            $('#saveBtn').removeAttr("disabled");
            $('#ajaxModel').modal('show');
        });

        //ad & ed
        $('body').on('click', '.editIdentity', function () {
            var id = $(this).data('id');
            $.get("{{ route('identity.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit Identity");
                $('#saveBtn').html("Edit");
                $('#ajaxModel').modal('show');
                $.each(data, (key,val) => {
                    if($(`#${key}`).length) $(`#${key}`).val(val);
                });
                if(data.typeid_status == 1){
                    $("#typeid_status_active").prop("checked", true);
                } else if(data.typeid_status != 1){
                    $("#typeid_status_inactive").prop("checked", true);
                }
            })
        });

        $( `#form${module}` ).submit(function( e ) {
            e.preventDefault();
            $('#saveBtn').html('Sending..');
            $("#saveBtn").attr("disabled", true);

            $.ajax({
                data: $(`#form${module}`).serialize(),
                url: "{{ route('identity.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $(`#form${module}`).trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('Save');
                    table.draw();
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
        $('body').on('click', '.deleteIdentity', function () {
            var id = $(this).data("id");
            if(confirm("Are You sure want to delete !")){
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
            }
        });
    });
</script>