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

    function fill_datatable(name = ''){
        table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
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

            $.ajax({
                data: {
                    mortalitahdr_id: id
                },
                url: "{{ route('searchMortalitaDtl') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $(`#mortalitahdr_agework`).val(data.length)
                },
                error: function (data) {
                    console.log('Error:', data);;
                }
            });
        })
    });

    $( `#form${module}` ).submit(function( e ) {
        $(`#saveBtn${module}`).html('Sending..');
        $(`#saveBtn${module}`).attr("disabled", true);
        var data = {};
        // var formdata = $(`#form${module}`).serializeArray();
        // $(formdata).each(function(index, obj){
        //     data[obj.name] = obj.value;
        // });
        data.detail = normalize();
        // debugger;
        $.ajax({
            data: $(`#form${module}`).serialize(),
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

    
    $( "#mortalitaAddDtl" ).click(function() {
        getTemplate()
    });

    function getTemplate(vardata ={}){
        var i =$('#mortalitaDtl .mortalita_detail').length ? $('#mortalitaDtl .mortalita_detail').length : 0;
        var varId = vardata.mortalitadtl_id ? vardata.mortalitadtl_id : '';
        var varAgework = vardata.mortalitadtl_agework ? vardata.mortalitadtl_agework : '';
        var varPercentage = vardata.mortalitadtl_percentage ? vardata.mortalitadtl_percentage : 0;

        var varHtml = `
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Detail ${i+1} </label>
            <div class="col-sm-9">
        
                <div id="mortalita_detail_${i}" class="mortalita_detail form-group">
                    <div class="col-xs-6">
                            <input type="hidden" class="form-control" id="form_dtl_${i}_id"
                        class="col-xs-10 col-xs-5" value="${varId}" required/>

                        <label class="control-label no-padding-right" for="form-field-1">Agework</label>
                        <input type="text" class="form-control" id="form_dtl_${i}_agework"
                        class="col-xs-10 col-xs-5" value="${varAgework}" required/>
                    </div>
                    <div class="col-xs-6">
                        <label class="control-label no-padding-right" for="form-field-1">Percentage</label>
                        <input type="number" min="0" class="form-control" id="form_dtl_${i}_percentage"
                        class="col-xs-10 col-xs-5" value="${varPercentage}" required/>
                    </div>
                </div>
            </div>
        </div>`;

        $(`#mortalitaDtl`).append(varHtml);
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
        // let num = $("#jml_thn").val();
        var dataReturn = [];
        var varresult = $('.mortalita_detail');

        if(varresult.length > 0){
            // debugger;
            $.each(varresult, function(index, val) {
                // debugger;
                if(!document.getElementById(`form_dtl_${index}_id`).value){
                    // debugger;
                    var obj ={
                        mortalitadtl_agework: document.getElementById(`form_dtl_${index}_agework`) ? document.getElementById(`form_dtl_${index}_agework`).value : 0 ,
                        mortalitadtl_percentage: document.getElementById(`form_dtl_${index}_percentage`) ? document.getElementById(`form_dtl_${index}_percentage`).value : 0,
                    }

                    dataReturn.push(obj);
                }
            });
        }

        return dataReturn
    }
        
</script>