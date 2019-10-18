<script type="text/javascript">
    var module = 'Order';
    var table = {};
    var fileData = [];
    var fileGambar = '';

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fill_datatable();
        // selectProgram();
        // selectService();

        $( "#subModalOrderAssumption" ).on('hidden.bs.modal', function(){
            $('#modalOrderAssumption').modal('show');
        });

        /*
        $('#ordhdr_service_hdr').change(function(){
        
            selectServiceDet()
        })*/
        selectServiceDet()
    });

    function fill_datatable(name = ''){
        table = $(`#table${module}`).DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                    url: "{{ route('searchorder') }}",
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
                {name: 'paymentStatusName', data: 'paymentStatusName'},//
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
        $('#userUploadTbl').html('');
        $('#ordhdr_service_dtl').html('');
        $('#fileupload').val('');
        
        searchProgram(`#ordhdr_program`, '', `modal${module}`);
        // searchService(`#ordhdr_service_hdr`, '', `modal${module}`)
        selectServiceDet()
    });

    $('body').on('click', `.edit${module}`, function () {
        var id = $(this).data('id');

        $.get("{{ route('order.index') }}" +`/${id}/edit`, (data) => {
            $(`#form${module}`).trigger("reset");
            $(`#subdis_provid`).html("");
            $('#modelHeading'+module).html(`Edit ${module}`);
            $(`#saveBtn${module}`).html("Edit");
            $('#ordhdr_service_dtl').html('');
            $('#fileupload').val('');

            if(data.ordhdr_date){
                data.ordhdr_date = dateFormat(data.ordhdr_date)
            }

            if(data.ordhdr_pay_date){
                data.ordhdr_pay_date = dateFormat(data.ordhdr_pay_date)
            }
            
            $.each(data, (key,val) => {
                $(`#${key}`).val(val);
            });

            $.ajax({
                url: "{{ route('getorderdetail') }}",
                type: "POST",
                data: {
                    ordhdr_id: id
                },
                success: function (datas) {
                    setTemplateTableUser(datas);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

            searchProgram(`#ordhdr_program`, data.ordhdr_program, `modal${module}`);

            selectServiceDet()

            $(`#modal${module}`).modal('show');

        })
    });

    $('body').on('click', `.assumption${module}`, function () {
        var id = $(this).data('id');

        $.ajax({
            url: "{{ route('getassumption') }}",
            type: "POST",
            data: {
                ordhdr_id: id
            },
            success: function (datas) {
                let varHtml = ''                
                getTemplate(datas.assumtionData, datas.periodCount)
                $(`#modalOrderAssumption`).modal('show')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#fileupload').change(function(){
        var input = this;
        var url = $(this).val();

        if (this.files && this.files[0]) {
            var myFile = this.files[0];
            var reader = new FileReader();
            
            reader.addEventListener('load', function (e) {
                
                let csvdata = e.target.result; 
                var data =csvFormatter(csvdata)
                fileData = data.data;
            });
            
            reader.readAsBinaryString(myFile);

            var fileName = url.split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        }

    });

    $('#com_fileupload').change(function(){
        var input = this;
        var url = $(this).val();

        if (this.files && this.files[0]) {
            var myFile = this.files[0];
            var reader = new FileReader();
            
            reader.addEventListener('load', function (e) {
                fileGambar = e.target.result;
            });
            
            var a = reader.readAsBinaryString(myFile);
            var fileName = url.split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        }

    });

    $('#btnUpload').click(function(){
        $('#userUploadTbl').html('');
        setTemplateTableUser(fileData)
        
    })

    $( `#form${module}` ).submit(function( e ) {
        $(`#saveBtn${module}`).html('Sending..');
        $(`#saveBtn${module}`).attr("disabled", true);
        
        var formdata = $(`#form${module}`).serializeArray();
        var dataall = {};
        $(formdata ).each(function(index, obj){
            dataall[obj.name] = obj.value;
        });
        
        dataall.detail = fileData;

        $.ajax({
            data: dataall,
            url: "{{ route('order.store') }}",
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


    function selectServiceDet(){
        $('#ordhdr_service_dtl').select2({
            placeholder: 'Cari...',
            dropdownParent: $(`#modal${module}`),
            ajax: {
                url: "{{ route('servicedetail') }}",
                dataType: 'json',
                delay: 250,
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.ordsrvdtl_price,
                                id: item.ordsrvdtl_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

    function setTemplateTableUser(varData){
        var tblHtml = '';

        varData.forEach(function(item, index){
            tblHtml += '<tr>';
            tblHtml += `<td> ${index + 1} </td>`;
            tblHtml += `<td> ${item.NPK ? item.NPK : '-'} </td>`;
            tblHtml += `<td> ${item.Name ? item.Name : '-'} </td>`;
            tblHtml += `<td> ${item.Gender ? item.Gender.toUpperCase() : '-'} </td>`;
            tblHtml += `<td> ${item.Birthdate ? formatHumanDate(item.Birthdate) : '-'} </td>`;
            tblHtml += `<td> ${item.KTP ? item.KTP : '-'} </td>`;
            tblHtml += `<td> ${item.NPWP ? item.NPWP : '-'} </td>`;
            tblHtml += `<td> ${item.Address ? item.Address : '-'} </td>`;
            tblHtml += `<td> ${item.HP ? item.HP : '-'} </td>`;

            tblHtml += `<td> ${item.Startdate ? item.Startdate : '-'} </td>`;
            tblHtml += `<td> ${item.Salery ? formatHumanCurrency(item.Salery) : '-'} </td>`;

            tblHtml += '</tr>';
        });
        var varHtml = ` <table id="tableUserUpload" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPK</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>KTP</th>
                    <th>NPWP</th>
                    <th>Address</th>
                    <th>HP</th>
                    <th>Startdate</th>
                    <th>Salery</th>

                </tr>
            </thead>

            <tbody>
                ${tblHtml}
            </tbody>
        </table>`;

        $('#userUploadTbl').html(varHtml);
    }

    function getTemplate(vardata ={}, periodeCount){
        $(`#assumption`).html('');            
        let provHtml = '';
                
        var countData = 0;

        var periode = '0';
        $.each(vardata, (key, ass) => {
            var opsi = '';
            var title = '';
            var input = ''
            if(ass.ordass_sp == 'P'){
                opsi =`<option value="S" >Single</option>
                            <option value="P" selected>Progresive</option>`;
                input = `<input type="button" name="ordass_value" class="btn btn-secondary btn-sm" value="Edit Progresive" onclick="showSubModal('${ass.ordass_id}')"/>`
            } else {
                opsi =`<option value="S" selected>Single</option>
                            <option value="P" >Progresive</option>`;
                input = `<input type="number" name="ordass_value" class="form-control" id="form_assumption_${ass.assump_templ_code}_val"
                                class="col-xs-10 col-xs-5" value=${ass.ordass_value} required/>`
            }

            if (periode != ass.ordass_periode){
                title = `<div class="form-group"><h2>Detail ${ass.ordass_periode}</h2></div>`;
                periode = ass.ordass_periode
            }

            if(ass.mortarita_flag == 'Y'){

            } else {    
                provHtml +=  `
                        ${title}
                        <div class="form-group" style="display: flex;">
                            <label class="control-label col-sm-2" for="form-field-1"> ${ass.assump_templ_desc}</label>
                            <div class="col-sm-10">
                                <form class="form-assumption">
                                    <div class="col-xs-3">
                                        <input type="hidden" name="ordass_id" id="ordass_id" value="${ass.ordass_id}" />
                                        <select class="form-control select2-single" style="width:100%;" 
                                            onchange="changeAssumption('${ass.ordass_id}', this.value)" 
                                            id="form_assumption_${ass.ordass_id}_sp"
                                            name="coytypedtl_assumpt_sp">
                                            ${opsi}
                                        </select>
                                    </div>
                                    <div class="col-xs-9" id="form_assumption_${ass.ordass_id}_div">
                                        ${input}
                                    </div>
                                </form>
                            </div>

                        </div>`;
            }
            
            countData++;
            
        });
        
        $(`#assumption`).html(provHtml);
    }

    function showSubModal(id = 0){
        $('#modalOrderAssumption').modal('hide');
        $(`#subModalOrderAssumption`).modal('show');
        getProgressive(id)
    }

    function getProgressive(id){
        $.ajax({
            url: "{{ route('getprogressive') }}",
            type: "POST",
            data: {
                ordpro_assid: id
            },
            success: function (datas) {
                let varHtml = '';

                $.each(datas, (key, ass) => {
                    var varid = ass.ordpro_id ? ass.ordpro_id : '';
                    var varvalue = ass.ordpro_value ? ass.ordpro_value : 0;
                    var varmin = ass.ordpro_amt_min ? ass.ordpro_amt_min : 0;
                    var varmax = ass.ordpro_amt_max ? ass.ordpro_amt_max : 0;
                    varHtml +=  `
                    <form class="progresive_form" style="display: flex;" >
                        <input type="hidden" name="ordpro_id" value ="${varid}" />
                        <input type="hidden" name="ordpro_assid" value ="${id}" />
                        <div class="col-xs-4">
                            <label class="control-label no-padding-right" for="form-field-1">Min</label>
                            <input type="number" min="0" class="form-control" name="ordpro_amt_min"
                            class="col-xs-10 col-xs-5" required value="${varmin}"/>
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label no-padding-right" for="form-field-1">Max</label>
                            <input type="number" min="0" class="form-control" name="ordpro_amt_max"
                            class="col-xs-10 col-xs-5" required value="${varmax}"/>
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label no-padding-right" for="form-field-1">Value</label>
                            <input type="number" min="0" class="form-control" name="ordpro_value"
                            class="col-xs-10 col-xs-5" required value="${varvalue}" />
                        </div>
                    </form>`;

                })

                $(`#subAssumption`).html(varHtml);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function addProgressive(){
        let varHtml = '';
        var id =  $(`#ordhdr_id`).val();
        varHtml +=  `
            <form class="progresive_form" style="display: flex;" >
                <input type="hidden" name="ordpro_id" value ="" />
                <input type="hidden" name="ordpro_assid" value ="${id}" />
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Min</label>
                    <input type="number" min="0" class="form-control" name="ordpro_amt_min"
                    class="col-xs-10 col-xs-5" required value=""/>
                </div>
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Max</label>
                    <input type="number" min="0" class="form-control" name="ordpro_amt_max"
                    class="col-xs-10 col-xs-5" required value=""/>
                </div>
                <div class="col-xs-4">
                    <label class="control-label no-padding-right" for="form-field-1">Value</label>
                    <input type="number" min="0" class="form-control" name="ordpro_value"
                    class="col-xs-10 col-xs-5" required value="" />
                </div>
            </form>`;

        $("#subAssumption").append(varHtml);
    }

    function changeAssumption(key, typ){
        varHtml= '';
        $(`#assumption_${key}_div`).html('');
        
        if(typ == 'S'){
            varHtml = `
                <label class="control-label no-padding-right" for="form-field-1">&nbsp;</label> 
                <input type="number" min="0" class="form-control" id="form_assumption_${key}_val"
                    class="col-xs-10 col-xs-5" required/>`;
        } else if (typ == 'P') {
            varHtml = `
            <input type="button" class="btn btn-secondary btn-sm" value="Edit Progresive" onclick="showSubModal('${key}')"/>

            `;
        }

        $(`#form_assumption_${key}_div`).html(varHtml);
    }

    function comfirmOrder(id){
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
            $(`#comfirmOrder`).modal('show');
        })
        
    }

    function viewComfirm(id){
        $.get("{{ route('order.index') }}" +`/${id}/edit`, (data) => {
            if(data.ordhdr_date){
                data.ordhdr_date = dateFormat(data.ordhdr_date)
            }

            if(data.ordhdr_pay_date){
                data.ordhdr_pay_date = dateFormat(data.ordhdr_pay_date)
            }

            $.each(data, (key,val) => {
                $(`#vc_${key}`).val(val);
            });
            $(`#viewComfirm`).modal('show');
        })
        
    }
    
    $("#submitSubModal").click(function(){
        var dataReturn =[]
        $(".progresive_form").each(function(index, data){
            var dataObj = {}
            dataObj[data[0].name] = data[0].value
            dataObj[data[1].name] = data[1].value
            dataObj[data[2].name] = data[2].value
            dataObj[data[3].name] = data[3].value
            dataObj[data[4].name] = data[4].value
            dataReturn.push(dataObj);
        })
        console.log(dataReturn);

        $.ajax({
            url: "{{ route('setprogressive') }}",
            type: "POST",
            data: {
                dataProgressive: dataReturn
            },
            success: function (datas) {
                alert("Progresive berhasil disimpan");
                $('#modalOrderAssumption').modal('show');
                $(`#subModalOrderAssumption`).modal('hide');
            },
            error: function (data) {
                console.log(data)
            }
        })
    })

    $( `#submitModal` ).click(function( e ) {
        var dataReturn =[]
        $(".form-assumption").each(function(index, data){
            if(data[1].value == "S"){    
                var dataObj = {}
                dataObj[data[0].name] = data[0].value
                dataObj[data[1].name] = data[1].value
                dataObj[data[2].name] = data[2].value
                dataReturn.push(dataObj);
            }
        })        

        $.ajax({
            url: "{{ route('setassumption') }}",
            type: "POST",
            data: {
                dataAssumption: dataReturn
            },
            success: function (datas) {
                alert("Assumption berhasil disimpan");
                $('#modalOrderAssumption').modal('hide');
            },
            error: function (data) {
                console.log(data)
            }
        })
    })

    function submitComfirmOrder(e){
        var formData = new FormData(); // Currently empty
        formData.append('id', $('#com_ordhdr_id').val());
        formData.append('num', $('#com_ordhdr_ordnum').val());
        formData.append('file', $('#com_fileupload').prop('files')[0] );

        $.ajax({
            data: formData,
            url: "{{ route('comfirmorder') }}",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                $(`#comfirmOrder`).modal('hide');
                table.draw();
            },
            error: function (data) {
                $(`#modal${module}`).modal('hide');
                console.log('Error:', data);
            }
        });
    }
    
</script>