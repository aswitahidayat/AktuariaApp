<script type="text/javascript">
    $(function () {
        var module = 'CompanyType';
        var table = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function fill_datatable(name = ''){
            table = $(`#table${module}`).DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                        url: "{{ route('searchcompany') }}",
                        type: "POST",
                        data: {
                            name: name
                        }
                    }, 
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                    {name: 'action', orderable: false, searchable: false, data: 'action'},
                    {name: 'coytypehdr_name', data: 'coytypehdr_name'},//
                    {name: 'statusName', data: 'statusName'},//
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
            $('#coytypehdr_id').val('');
            $('#modelHeading'+module).html(`Create New  ${module}`);
            $(`#modal${module}`).modal('show');
        });

        $('body').on('click', `.edit${module}`, function () {
            var id = $(this).data('id');
            $.get("{{ route('company.index') }}" +`/${id}/edit`, (data) => {
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
                url: "{{ route('company.store') }}",
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
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('company.store') }}"+'/'+id,
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