<script type="text/javascript">
    function test(){
        console.log('test');
        
    }
    
    function dateFormat(varDate = ''){
        return new Date(varDate).toISOString().slice(0,10);
    }
    
    function searchProgram(div, selected = ''){
        debugger;
        $.ajax({
            url: "{{ route('searchprogram') }}",
            type: "POST",
            dataType: 'json',
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.ordprg_id}" >${item.ordprg_name}</option>`
                });
                $(div).html(varHtml);
                if(selected){
                    $(div).val(selected);
                }
            },
            error: function (data) {
                console.log('Error:', data);
                // $(`#modal${module}`).modal('show');
            }
        });
    }
    </script>