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
        $(`#benefitDtl`).html('');
        $("#agework").val(0);
        $(`#modal${module}`).modal('show');
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
            data.detailCount ? $("#agework").val(data.detailCount) :  $("#agework").val(0);
            getTemplate(data.detail)
        })
    });

    $(`#form${module}` ).submit(function( e ) {
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

    function normalize(){
        var dataReturn = [];
        
        var myEle = document.getElementsByClassName("benefit_detail");
        if(myEle.length > 0){
            for (let data of myEle){
                var dataObj = {}
                dataObj[data.getElementsByTagName('input')[0].name] = data.getElementsByTagName('input')[0].value
                dataObj[data.getElementsByTagName('input')[1].name] = data.getElementsByTagName('input')[1].value
                dataObj[data.getElementsByTagName('input')[2].name] = data.getElementsByTagName('input')[2].value
                dataObj[data.getElementsByTagName('input')[3].name] = data.getElementsByTagName('input')[3].value
                dataObj[data.getElementsByTagName('input')[4].name] = data.getElementsByTagName('input')[4].value

                dataReturn.push(dataObj);
            }
        }
        return dataReturn
    }
    
    

    $( "#jml_thn_proc" ).click(function() {
        getTemplate()
    });

    function getTemplate(vardata ={}){
        $(`#benefitdtl`).html('');            
        let provHtml = '';
        let num = vardata.length ? vardata.length : $("#agework").val();
        var countData = 0;

        for (i = 1; i <= num; i++) {
            var agework = vardata[countData] ? vardata[countData].bendtl_agework_year : countData
            var bendtl_id = vardata[countData] ? vardata[countData].bendtl_id : ''
            var bendtl_severance = vardata[countData] ? vardata[countData].bendtl_severance : 0
            var bendtl_appreciation = vardata[countData] ? vardata[countData].bendtl_appreciation : 0
            var bendtl_split = vardata[countData] ? vardata[countData].bendtl_split : 0
            var bendtl_withdraw = vardata[countData] ? vardata[countData].bendtl_withdraw : ''
            var bendtl_pension = vardata[countData] ? vardata[countData].bendtl_pension : ''
            var bendtl_death = vardata[countData] ? vardata[countData].bendtl_death : ''
            var bendtl_disability = vardata[countData] ? vardata[countData].bendtl_disability  : ''
            var bendtl_increase_reward = vardata[countData] ? vardata[countData].bendtl_increase_reward  : ''
            var bendtl_agework_reward = vardata[countData] ? vardata[countData].bendtl_agework_reward  : ''

            var a =  `
                <div class="form-group">
                    <div class="">
                        <label class="control-label no-padding-right" for="form-field-1">Agework ${agework}:</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="benefit_detail">
                        <div class="col-xs-4">
                            <input type="hidden" name="bendtl_id" id="bendtl_id" value="${bendtl_id}" />
                            <input type="hidden" name="bendtl_agework_year" id="bendtl_agework_year" value="${agework}" />
                            
                            <label class="control-label no-padding-right" for="form-field-1">Benefit Severance</label>
                            <input type="text" class="form-control" id="bendtl_severance" name="bendtl_severance"
                                class="col-xs-10 col-xs-5" value=${bendtl_severance} required/>
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label no-padding-right" for="form-field-1">Benefit Appreciation</label> 
                            <input type="text" class="form-control" id="bendtl_appreciation" name ="bendtl_appreciation"
                                class="col-xs-10 col-xs-5" value=${bendtl_appreciation} required/>
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label no-padding-right" for="form-field-1">Benefit Split</label> 
                            <input type="text" class="form-control" id="bendtl_split" name="bendtl_split"
                                class="col-xs-10 col-xs-5" value=${bendtl_split} required/>
                        </div>
                    </div>
                </div><hr>`;
                
                provHtml +=  `
                    <tr class="benefit_detail">
                        <td>
                            <input type="hidden" name="bendtl_id" id="bendtl_id" value="${bendtl_id}" />
                            <input type="hidden" name="bendtl_agework_year" id="bendtl_agework_year" value="${agework}" />
                            ${countData + 1}
                        </td>
                        <td >
                            ${agework} Tahun
                        </td>
                        <td>
                            <input type="numbber" class="form-control" id="bendtl_severance" name="bendtl_severance"
                                class="col-xs-10 col-xs-5" value=${bendtl_severance} required/>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="bendtl_appreciation" name ="bendtl_appreciation"
                                class="col-xs-10 col-xs-5" value=${bendtl_appreciation} required/>
                        </td>
                        <td style="">
                            <div class="col-xs-10">
                                <input type="text" class="form-control" id="bendtl_split" name="bendtl_split"
                                    class="col-xs-10 col-xs-5" value=${bendtl_split} required/> 
                            </div>
                            <div class="col-xs-2"> % </div>
                        </td>
                        <td> ${bendtl_withdraw} </td>
                        <td> ${bendtl_pension} </td>
                        <td> ${bendtl_increase_reward} </td>
                        <td> ${bendtl_agework_reward} </td>
                        <td> ${bendtl_death} </td>
                        <td> ${bendtl_disability} </td>

                    </tr>`
                countData++;
        }
        
        $(`#benefitDtl`).html(provHtml);
    }
        
</script>