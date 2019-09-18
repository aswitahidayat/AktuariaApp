<script type="text/javascript">
    var module = 'Benefit';
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
                    url: "{{ route('searchBenefit') }}",
                    type: "POST",
                    data: {
                        name: name
                    }
                }, 
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false, name: 'DT_RowIndex'},
                {name: 'action', orderable: false, searchable: false, data: 'action'},
                {name: 'benhdr_desc', data: 'benhdr_desc'},//
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
        $(`#benefitDtl`).html('');
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');
        $(`#benefitDtl`).html('');
        $.get("{{ route('benefit.index') }}" +`/${id}/edit`, (data) => {
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $(`#modal${module}`).modal('show');
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });


            $.ajax({
                data: {
                    bendtl_hdrid: id
                },
                url: "{{ route('searchBenefitDtl') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data){
                        if(data.length > 0){
                            $(`#benhdr_agework`).val(data.length -1)
                            $(`#bendtl_appreciation`).val(data[0].bendtl_appreciation)
                            $(`#bendtl_split`).val(data[0].bendtl_split)
                        }
                    }
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
        $.ajax({
            data: $(`#form${module}`).serialize(),
            url: "{{ route('benefit.store') }}",
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

    
    $( "#benefitAddDtl" ).click(function() {
        getTemplate()
    });

    function getTemplate(vardata ={}){
        var i =$('#benefitDtl .benefit_detail').length ? $('#benefitDtl .benefit_detail').length : 0;
        var varId = vardata.bendtl_id ? vardata.bendtl_id : '';
        var varAgework = vardata.bendtl_agework ? vardata.bendtl_agework : '';
        var varPercentage = vardata.bendtl_percentage ? vardata.bendtl_percentage : 0;

        var varHtml = `
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Detail ${i+1} </label>
            <div class="col-sm-9">
        
                <div id="benefit_detail_${i}" class="benefit_detail form-group">
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

        $(`#benefitDtl`).append(varHtml);
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
        var varresult = $('.benefit_detail');

        if(varresult.length > 0){
            $.each(varresult, function(index, val) {
                if(!document.getElementById(`form_dtl_${index}_id`).value){
                    var obj ={
                        bendtl_agework: document.getElementById(`form_dtl_${index}_agework`) ? document.getElementById(`form_dtl_${index}_agework`).value : 0 ,
                        bendtl_percentage: document.getElementById(`form_dtl_${index}_percentage`) ? document.getElementById(`form_dtl_${index}_percentage`).value : 0,
                    }

                    dataReturn.push(obj);
                }
            });
        }

        return dataReturn
    }
        
</script>