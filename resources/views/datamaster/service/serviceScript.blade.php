<script type="text/javascript">
    $(function () {
        var module = 'Service';
        var table = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fill_datatable(name = '') {
            table = $(`#table${module}`).DataTable({
                bLengthChange: true,
                info: false,
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('searchservice') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                    {name: 'ordsrvhdr_name', data: 'ordsrvhdr_name'},//
                    {name: 'statusName', data: 'statusName'},//
                    {name: 'action', orderable: false, searchable: false, data: 'action'},
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
            $('#ordsrvhdr_id').val('');
            $('#modelHeading'+module).html(`Create New  ${module}`);
            $(`#modal${module}`).modal('show');
            $("#serviceDtl").html("")

        });

        $('body').on('click', `.edit${module}`, function () {
            var id = $(this).data('id');

            $.get("{{ route('service.index') }}" +`/${id}/edit`, (data) => {
                $('#modelHeading'+module).html(`Edit ${module}`);
                $(`#saveBtn${module}`).html("Edit");
                $(`#modal${module}`).modal('show');
                $("#serviceDtl").html("")
                
                $.each(data, (key,val) => {
                    $(`#${key}`).val(val);
                });

                getDetail(id)

                if(data.ordsrvhdr_status == 1){
                    $("#ordsrvhdr_status_active").prop("checked", true);
                } else if(data.ordsrvhdr_status != 1){
                    $("#ordsrvhdr_status_inactive").prop("checked", true);
                }
            })
        });

        $(`#saveBtn${module}`).click( function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            // var data = $(`#form${module}`).serialize();
            var formdata = $(`#form${module}`).serializeArray();
            var dataall = {};
            $(formdata ).each(function(index, obj){
                dataall[obj.name] = obj.value;
            });
            
            dataall.detail = getFormDetail();
            $.ajax({
                data: dataall,
                url: "{{ route('service.store') }}",
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
        $( `#form${module}` ).submit(function( e ) {

        });
      
    });

    function addServiceDtl(varData = [{}]){
        let varHtml = '';
        var id =  $(`#ordsrvhdr_id`).val();
        varData.forEach(function(item, index) {
            var price = item.ordsrvdtl_price  ||  0
            var startDate = item.ordsrvdtl_startdate  ||  ''
            var endDate = item.ordsrvdtl_enddate  ||  ''
            var id = item.ordsrvdtl_id || ''
            
            varHtml +=  `
                <form class="service_form pb-20" style="display: flex;" >
                        <input type="hidden" min="0" class="form-control" name="ordsrvdtl_id" value="${id}" />
                    <div class="col-xs-4">
                        <label class="control-label no-padding-right" for="form-field-1">Price</label>
                        <input type="number" min="0" class="form-control" name="ordsrvdtl_price"
                        class="col-xs-10 col-xs-5" required value="${price}"/>
                    </div>
                    <div class="col-xs-4">
                        <label class="control-label no-padding-right" for="form-field-1">Start Date</label>
                        <input type="date" class="form-control" name="ordsrvdtl_startdate"
                        class="col-xs-10 col-xs-5" required value="${startDate}"/>
                    </div>
                    <div class="col-xs-4">
                        <label class="control-label no-padding-right" for="form-field-1">End Date</label>
                        <input type="date" class="form-control" name="ordsrvdtl_enddate"
                        class="col-xs-10 col-xs-5" required value="${endDate}" />
                    </div>
                </form>`;
        });


        $("#serviceDtl").append(varHtml);
    }

    function setTemplate(){

    }

    function getDetail(id){
        $.ajax({
            data: {
                ordsrvhdr_id: id
            },
            url: "{{ route('servicedetail') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data){
                    addServiceDtl(data)
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function getFormDetail(){
        var dataReturn =[]
        $(".service_form").each(function(index, data){
            var dataObj = {}
            dataObj[data[0].name] = data[0].value
            dataObj[data[1].name] = data[1].value
            dataObj[data[2].name] = data[2].value
            dataObj[data[3].name] = data[3].value
            dataReturn.push(dataObj);
        })
        return dataReturn;
    }
</script>