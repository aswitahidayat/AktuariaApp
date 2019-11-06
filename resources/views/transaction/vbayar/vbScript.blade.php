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
                    url: "{{ route('searchverify') }}",
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
                $(`#comfirmOrder`).modal('hide');
                table.draw();
            },
            error: function (data) {
                $(`#modal${module}`).modal('hide');
                console.log('Error:', data);
            }
        });
    })


</script>