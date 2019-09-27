<script type="text/javascript">
    var module = 'Vb';
    var table = {};
    
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
                    url: "{{ route('searchvbayar') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'action', orderable: false, searchable: false, data: 'action'},
                {name: 'ordhdr_ordnum', data: 'ordhdr_ordnum'},//
                {name: 'ordprg_name', data: 'ordprg_name'},//
                {name: 'ordhdr_period_lastyear', data: 'ordhdr_period_lastyear'},//
                {name: 'ordhdr_pay_status', data: 'ordhdr_pay_status'},//
            ]

        });
    }

    $( `#formSearch${module}` ).submit(function() {
        $(`#table${module}`).DataTable().destroy();
        fill_datatable($("#search_name").val());
    });

    function verifrder(id){
        $.get("{{ route('order.index') }}" +`/${id}/edit`, (data) => {
            if(data.ordhdr_date){
                data.ordhdr_date = dateFormat(data.ordhdr_date)
            }

            if(data.ordhdr_pay_date){
                data.ordhdr_pay_date = dateFormat(data.ordhdr_pay_date)
            }

            $.each(data, (key,val) => {
                $(`#com_${key}`).val(val);
            });

            var img = "{{ url('/order_upload/') }}/"+data.ordhdr_ordnum+".jpg"
            $(`#vbImage`).attr({ "src": img });   
            $(`#comfirmOrder`).modal('show');
        })
    }

    

    $( `#formComfirmOrder` ).submit(function() {
        $.ajax({
            data: {
                id: $('#com_ordhdr_id').val()
            },
            url: "{{ route('verificationOrder') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                // $(`#form${module}`).trigger("reset");
                // $(`#modal${module}`).modal('hide');
                $(`#comfirmOrder`).modal('hide');
                table.draw();
                // $(`#saveBtn${module}`).html('Save');
                // $(`#saveBtn${module}`).removeAttr("disabled");
            },
            error: function (data) {
                $(`#modal${module}`).modal('hide');
                console.log('Error:', data);
                // $(`#saveBtn${module}`).html('Save');
                // $(`#saveBtn${module}`).removeAttr("disabled");

            }
        });
    })


    function submitComfirmOrder(e){
        var formData = new FormData(); // Currently empty
        // formData.append('id', $('#com_ordhdr_id').val());
        // formData.append('num', $('#com_ordhdr_ordnum').val());
        // formData.append('file', $('#com_fileupload').prop('files')[0] );

        // // var id = $('#com_ordhdr_id').val();
        // // var num = $('#com_ordhdr_ordnum').val();
        // // var file = $('#com_fileupload').prop('files')[0];
        // debugger;

        

        // var
        // var gambar = fileGambar
    }


</script>