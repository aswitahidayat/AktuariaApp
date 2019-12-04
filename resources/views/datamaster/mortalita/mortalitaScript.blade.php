<script type="text/javascript">
    var module = 'Mortalita';
    var table = {};
    var varresult = {};

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fill_datatable();

        $('body').on('click', `.delete${module}`, function () {
            var id = $(this).data("id");
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('companytype.store') }}"+'/'+id,
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

    function fill_datatable(name = ''){
        table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            searching: false,
            ajax: {
                    url: "{{ route('searchmortalita') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'action', orderable: false, searchable: false, data: 'action'},
                {name: 'mortalitahdr_name', data: 'mortalitahdr_name'},//
                {name: 'statusName', data: 'statusName'},//
            ]

        });
    }

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
        $(`#mortalitaDtl`).html('');
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');
        $(`#mortalitaDtl`).html('');
        $.get("{{ route('mortalita.index') }}" +`/${id}/edit`, (data) => {
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $(`#modal${module}`).modal('show');
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            if(data.mortalitahdr_status == 1){
                $("#mortalitahdr_status_active").prop("checked", true);
            } else if(data.mortalitahdr_status != 1){
                $("#mortalitahdr_status_inactive").prop("checked", true);
            }

            getTemplate(data.detail)
            data.detailCount ? $("#agework").val(data.detailCount - 1) :  $("#agework").val(0);
            
        })
    });

    $( `#form${module}` ).submit(function( e ) {
        $(`#saveBtn${module}`).html('Sending..');
        $(`#saveBtn${module}`).attr("disabled", true);
        var data = {};

        var formdata = $(`#form${module}`).serializeArray();
        $(formdata).each(function(index, obj){
            data[obj.name] = obj.value;
        });
        data.detail = normalize();
        $.ajax({
            data: data,
            url: "{{ route('mortalita.store') }}",
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

    /*
    $( "#mortalitaAddDtl" ).click(function() {
        getTemplate()
    });
    */

    $( "#jml_thn_proc" ).click(function() {
        getTemplate()
    });

    function getTemplate(vardata ={}){
        $(`#mortalitaDtl`).html('');
        var varHtml = '';
        let num = vardata.length ? vardata.length - 1 : parseInt($("#agework").val())
        var countData = 0;

        for (i = 1; i <= num+1; i++) {

            var agework = vardata[countData] ? vardata[countData].mortalitadtl_agework : countData
            var mortalitadtl_id = vardata[countData] ? vardata[countData].mortalitadtl_id : '';
            var percentage = vardata[countData] ? vardata[countData].mortalitadtl_percentage : 0;
            varHtml += `
                <tr class="mortalita_detail">
                    <td>
                        <input type="hidden" name="mortalitadtl_id" id="mortalitadtl_id" value="${mortalitadtl_id}" />
                        <input type="hidden" name="mortalitadtl_agework" id="mortalitadtl_agework" value="${agework}" />
                        ${countData + 1}
                    </td>
                    <td >
                        ${agework} Tahun
                    </td>
                    <td>
                        <div class="col-xs-10">
                            <input type="number" class="form-control" id="mortalitadtl_percentage" name="mortalitadtl_percentage"
                                class="col-xs-10 col-xs-5" value=${percentage} required/>
                        </div>
                        <div class="col-xs-2"> % </div>
                    </td>

                </tr>`
                countData++
        }

        $(`#mortalitaDtl`).html(varHtml)
    }

    function dataSetter(vardata){

        $.each(vardata, (key,val) => {
            if(val.coytypedtl_assumpt_sp.toUpperCase()  == "P" ){
                var setData ={
                    value:val.coytypedtlsub_value ? val.coytypedtlsub_value : 0,
                    min: val.coytypedtlsub_amt_min ? val.coytypedtlsub_amt_min : 0,
                    max: val.coytypedtlsub_amt_max ? val.coytypedtlsub_amt_max : 0,
                }
                changeAssumption(Math.ceil((key+1)/6), val.coytypedtl_assumpt_code, 'P', setData);

            }
        });
    }

    function normalize(){
        var dataReturn = [];
        
        var myEle = document.getElementsByClassName("mortalita_detail")
        if(myEle.length > 0){
            for (let data of myEle){
                var dataObj = {}
                dataObj[data.getElementsByTagName('input')[0].name] = data.getElementsByTagName('input')[0].value
                dataObj[data.getElementsByTagName('input')[1].name] = data.getElementsByTagName('input')[1].value
                dataObj[data.getElementsByTagName('input')[2].name] = data.getElementsByTagName('input')[2].value

                dataReturn.push(dataObj)
            }
        }
        return dataReturn
    }
        
</script>