<script type="text/javascript">
    $(function () {
        var module ='Partner';
        var table = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //show data
        function fill_datatable(name = '') {
            table = $(`#table${module}`).DataTable({
                ajax: {
                    url: "{{ route('searchpartner') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {name: 'action', orderable: false, searchable: false,data: 'action'},
                    {name: 'bizpart_coy_name', data: 'bizpart_coy_name'},//
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
            $('#bizpart_id').val('');
            $('#partnerForm').trigger("reset");
            $('#modelHeading').html("Create Partner");
            $('#saveBtn').removeAttr("disabled");
            $('#modelPartner').modal('show');
            searchProv('#bizpart_coy_provid', '', 'modelPartner')
            searchCompanyType('#bizpart_coytype_hdr', '', 'modelPartner')
            searchIdType('#bizpart_pic_typeid', '', 'modelPartner')
        });

        //ad & ed
        $('body').on('click', `.edit${module}`, function () {
            var id = $(this).data('id');
            $.get("{{ route('partner.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit Partner");
                $('#saveBtn').html("Edit");
                $('#modelPartner').modal('show');

                $.each(data, (key,val) => {
                    if($(`#${key}`).length) $(`#${key}`).val(val);
                });

                searchProv('#bizpart_coy_provid', data.bizpart_coy_provid, 'modelPartner')
                searchCompanyType('#bizpart_coytype_hdr', data.bizpart_coytype_hdr, 'modelPartner')
                searchIdType('#bizpart_pic_typeid', data.bizpart_pic_typeid, 'modelPartner')

                searchKota('#bizpart_coy_disid', data.bizpart_coy_disid, 'modelPartner', data.bizpart_coy_provid)
                searchKecamatan('#bizpart_coy_subdisid', data.bizpart_coy_subdisid, 'modelPartner', data.bizpart_coy_disid)
                searchPost('#bizpart_coy_zipcode', data.bizpart_coy_zipcode, 'modelPartner', data.bizpart_coy_subdisid)
                

                if(data.bizpart_status == 1){
                    $("#bizpart_status_active").prop("checked", true);
                } else if(data.bizpart_status != 1){
                    $("#bizpart_status_inactive").prop("checked", true);
                }
            })
        });

        $( "#partnerForm" ).submit(function( e ) {
            e.preventDefault();

            $('#saveBtn').html('Sending..');
            $("#saveBtn").attr("disabled", true);
            $.ajax({
                data: $('#partnerForm').serialize(),
                url: "{{ route('partner.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#partnerForm').trigger("reset");
                    $('#modelPartner').modal('hide');
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

        $( "#bizpart_coy_provid" ).change(function() {
            searchKota('#bizpart_coy_disid', '', 'modelPartner', $('#bizpart_coy_provid').val())
        });

        $( "#bizpart_coy_disid" ).change(function() {
            searchKecamatan('#bizpart_coy_subdisid', '', 'modelPartner', $('#bizpart_coy_disid').val())
        });

        $( "#bizpart_coy_subdisid" ).change(function() {
            searchPost('#bizpart_coy_zipcode', '', 'modelPartner', $('#bizpart_coy_subdisid').val())
        });

    });
</script>