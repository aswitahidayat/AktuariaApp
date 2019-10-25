<script type="text/javascript">
    var module = 'CompanyType';
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
            ordering: true,
            searching: false,
            ajax: {
                    url: "{{ route('searchcompanytype') }}",
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
        $(`#assumption`).html('');
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');
        $.get("{{ route('companytype.index') }}" +`/${id}/edit`, (data) => {
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

            /*
            $.ajax({
                data: {
                    coytypehdr_id: id
                },
                url: "{{ route('getcompanydtl') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    getTemplate(data);
                },
                error: function (data) {
                    console.log('Error:', data);;
                }
            });
            */
        })
    });

    $( `#form${module}` ).submit(function( e ) {
        $(`#saveBtn${module}`).html('Sending..');
        $(`#saveBtn${module}`).attr("disabled", true);
        
        var dataall = {
            header: {
                coytypehdr_id: $("#coytypehdr_id").val(),
                coytypehdr_name: $("#coytypehdr_name").val(),
                coytypehdr_desc: $("#coytypehdr_desc").val(),
                coytypehdr_status: $("#coytypehdr_status").val(),
                coytypehdr_count_year: $("#coytypehdr_count_year".val())
            },
            detail: normalize(),
        }

        $.ajax({
            data: dataall,
            url: "{{ route('companytype.store') }}",
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

    
    $( "#jml_thn_proc" ).click(function() {
        getTemplate()
    });

    function getTemplate(vardata ={}){
        $(`#assumption`).html('');            
        $.ajax({
            url: "{{ route('getTemplate') }}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                let provHtml = '';
                varresult = data;
                let num = vardata.length ? vardata.length/6 : $("#coytypehdr_count_year").val();
                for (i = 1; i <= num; i++) {
                    var countData = 0;
                    provHtml +=  `
                    <h2>Detail ${i}</h2>
                    <div class="form_assumption form_assumption_${i}">`
                    $.each(data, (key, ass) => {
                        var setVal = vardata[countData] ? vardata[countData].coytypedtl_assumpt_value : 0;
                        provHtml +=  `
                        <div class="form-group">
                            <div class="">
                            <label class="control-label no-padding-right" for="form-field-1"> ${ass.assump_templ_desc}</label>
                            </div>
                            <div class="">
                                <div class="col-xs-3">
                                    <input type="hidden" name="coytypedtl_assumpt_code" value="${ass.assump_templ_code}" />
                                    <label class="control-label no-padding-right" for="form-field-1">&nbsp;</label>
                                    <select class="form-control select2-single" style="width:100%;" 
                                        onchange="changeAssumption('${i}', '${ass.assump_templ_code}', this.value)" 
                                        id="form_assumption_${i}_${ass.assump_templ_code}_l"
                                        name="coytypedtl_assumpt_sp">
                                        <option value="S" >Single</option>
                                        <option value="P" >Progresive</option>
                                    </select>
                                </div>
                                <div class="col-xs-9" id="assumption_${i}_${ass.assump_templ_code}_div">
                                    <label class="control-label no-padding-right" for="form-field-1">&nbsp;</label> 
                                    <input type="text" class="form-control" id="form_assumption_${i}_${ass.assump_templ_code}_val"
                                        class="col-xs-10 col-xs-5" value=${setVal} required/>
                                </div>
                            </div>

                        </div>`;
                        
                        countData++;
                    });
                    provHtml +=  `</div>`
                }
                $(`#assumption`).html(provHtml);
                if(vardata){
                    dataSetter(vardata);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function disableBtnJml(val =true){
        if(val){
            $(`#jml_thn_proc`).attr("disabled", true);
            $(`#jml_thn_proc`).html('<i class="fa fa-spinner fa-spin"></i>');
        } else {
            $(`#jml_thn_proc`).removeAttr("disabled");
            $(`#jml_thn_proc`).html(`<i class="fa fa-search"></i>`);
        }
    }

    function changeAssumption(key, code, typ, val = {}){
        varHtml= '';
        $(`#assumption_${key}_${code}_div`).html('');

        var setValue = val.value ? val.value : 0;
        var setMin = val.min ? val.min : 0;
        var setMax = val.max ? val.max : 0;
        
        if(typ == 'S'){
            varHtml = `
                <label class="control-label no-padding-right" for="form-field-1">&nbsp;</label> 
                <input type="number" min="0" class="form-control" id="form_assumption_${key}_${code}_val"
                    class="col-xs-10 col-xs-5" value=${setValue} required/>`;
        } else if (typ == 'P') {
            varHtml = `
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Min</label>
                    <input type="number" min="0" class="form-control" id="form_assumption_${key}_${code}_min"
                    class="col-xs-10 col-xs-5" value="${setValue}" required/>
                </div>
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Max</label>
                    <input type="number" min="0" class="form-control" id="form_assumption_${key}_${code}_max"
                    class="col-xs-10 col-xs-5" value="${setMax}" required/>
                </div>
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Value</label>
                    <input type="number" min="0" class="form-control" id="form_assumption_${key}_${code}_val"
                    class="col-xs-10 col-xs-5" value="${setMin}" required/>
                </div>
            `;
        }

        $(`#assumption_${key}_${code}_div`).html(varHtml);
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
        let num = $("#coytypehdr_count_year").val();
        var dataReturn = [];
        for (i = 1; i <= num; i++) {
            $.each(varresult, function(index, val) {
                var obj ={
                    coytypedtl_assumpt_code: val.assump_templ_code,
                    coytypedtl_assumpt_sp: document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_l`).value,
                    value: document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_val`) ? document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_val`).value : 0,
                    max: document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_max`) ? document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_max`).value : 0,
                    min: document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_min`) ? document.getElementById(`form_assumption_${i}_${val.assump_templ_code}_min`).value : 0,

                }

                dataReturn.push(obj);
            });
            
        }

        return dataReturn
    }
        
</script>