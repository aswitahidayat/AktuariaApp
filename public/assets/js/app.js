
$(function () {
    $("img").on("error", function () {
        $(this).attr("src", "/noimageavailable.png");
    });
})

function dateFormat(varDate = ''){
    return new Date(varDate).toISOString().slice(0,10);
}

function formatHumanDate(date) {
    date = new Date(date)
    var monthNames = [
      "Januari", "Februari", "Maret",
      "April", "Mei", "Juni", "Juli",
      "Agustus", "September", "Oktober",
      "November", "Desember"
    ];
  
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
  
    return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function formatHumanCurrency(cur){
    cur = cur ? cur : 0
	return (parseInt(cur)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');  // 12,345.67
}
function formatCompCurrency(cur){
	return Number(cur.replace(/[^0-9.-]+/g,""));
}

function csvFormatter(csvdata){
	return Papa.parse(csvdata, {
		header: true,
		quoteChar: "'",
		escapeChar: "'",
		skipEmptyLines: true,
	});
}

function searchProgram(div, selected = '', modal){
    $(div).html('');
    if(selected){
        $.ajax({
            url: "/searchprogram",
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
                selectSearch(div, modal, 'searchprogram', 'ordprg')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearch(div, modal, 'searchprogram', 'ordprg')
    }
}

function searchService(div, selected = '', modal){
    $(div).html('');

    if(selected){
        $.ajax({
            url: "/searchservice",
            type: "POST",
            dataType: 'json',
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.ordsrvhdr_id}" >${item.ordsrvhdr_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearch(div, modal, 'searchservice', 'ordsrvhdr')

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearch(div, modal, 'searchservice', 'ordsrvhdr')
    }
}

function searchServiceDtl(div, selected = '', modal){
    $(div).html('');

    if(selected){
        $.ajax({
            url: "/searchservice",
            type: "POST",
            dataType: 'json',
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.ordsrvhdr_id}" >${item.ordsrvhdr_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearch(div, modal, 'searchservice', 'ordsrvhdr')

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearch(div, modal, 'searchservice', 'ordsrvhdr')
    }
}

function selectSearch(div = '', modal = '', route = '', mod = ''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/${route}`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            processResults: function (data) {
                return {
                    results:  $.map(data.data, function (item) {
                        return {
                        text: item[`${mod}_name`],
                        id: item[`${mod}_id`]
                        }
                    })
                };
            },
            cache: true
        }
    });
}
