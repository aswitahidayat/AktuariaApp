
$(function () {
    $("img").on("error", function () {
        $(this).attr("src", "/noimageavailable.png");
    });

    $.extend( true, $.fn.dataTable.defaults, {
        searching: false,
        ordering: false,
        bLengthChange: true,
        info: false,
        processing: true,
        serverSide: true,
        preDrawCallback: ( settings ) => {             
            $('#modalLoading').fadeIn(300);
        },
        drawCallback: ( settings ) => {
            $('#modalLoading').fadeOut(300);
        }
    });

    jQuery.ajaxSetup({
    beforeSend: function() {
        $('#modalLoading').fadeIn(300);
    },
    complete: function(){
        $('#modalLoading').fadeOut(300);
    },
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

function searchPartner(div, selected = '', modal){
    $(div).html('');

    if(selected){
        $.ajax({
            url: "/getpartner",
            type: "POST",
            dataType: 'json',
            success: function (datas) {
                let varHtml = '';
                $.each(datas, (key, item) => {
                    varHtml +=  `<option value="${item.bizpart_id}" >${item.bizpart_coy_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearch2(div, modal, 'getpartner', 'bizpart_id', 'bizpart_coy_name')

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearch2(div, modal, 'getpartner', 'bizpart_id', 'bizpart_coy_name')
    }
}

function searchProv(div, selected = '', modal){
    if(selected){
        $.ajax({
            url: "/searchprovince",
            type: "POST",
            dataType: 'json',
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.prov_id}" >${item.prov_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearch2(div, modal, 'getpartner', 'prov_id', 'prov_name')

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearch2(div, modal, 'searchprovince', 'prov_id', 'prov_name', nest = true)
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


function selectSearch2(div = '', modal = '', route = '', id = '', name = '', nest=false){
    // debugger;
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
            processResults: function (datas) {
                var varloop = nest ? datas.data : datas;
                return {
                    results:  $.map(varloop, function (item) {
                        return {
                        text: item[`${name}`],
                        id: item[`${id}`]
                        }
                    })
                };
            },
            cache: true
        }
    });
}

function searchKota(div, selected = '', modal, dataProv){
    if(selected){
        $.ajax({
            url: "/searchdistrict",
            type: "POST",
            dataType: 'json',
            data: function (params, page){
                return{
                    name: params.term,
                    prov: dataProv,
                }
            },
            success: function (datas) {
                let varHtml = '';
                $.each(datas, (key, item) => {
                    varHtml +=  `<option value="${item.dis_id}" >${item.dis_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearchKota(div, modal, 'searchdistrictpub', 'dis_id', 'dis_name', true, dataProv)

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearchKota(div, modal, 'searchprovince', 'dis_id', 'dis_name', true, dataProv)
    }
}

function selectSearchKota(div = '', modal = '', route = '', id = '', name = '', nest=false, dataProv=''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/searchdistrict`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                    prov: dataProv,
                }
            },
            processResults: function (datas) {
                var varloop = nest ? datas : data;
                return {
                    results:  $.map(datas, function (item) {
                        return {
                        text: item[`${name}`],
                        id: item[`${id}`]
                        }
                    })
                };
            },
            cache: true
        }
    });
}

function searchKecamatan(div, selected = '', modal, dataDis){
    if(selected){
        $.ajax({
            url: "/searchsubdistrict",
            type: "POST",
            dataType: 'json',
            data: function (params, page){
                return{
                    name: params.term,
                    dis: dataDis,
                }
            },
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.dis_id}" >${item.dis_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearchKecamatan(div, modal, 'searchdistrictpub', 'subdis_id', 'subdis_name', true, dataDis)

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearchKecamatan(div, modal, 'searchprovince', 'subdis_id', 'subdis_name', true, dataDis)
    }
}

function selectSearchKecamatan(div = '', modal = '', route = '', id = '', name = '', nest=false, dataDis=''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/searchsubdistrict`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                    dis: dataDis,
                }
            },
            processResults: function (datas) {
                var varloop = nest ? datas : data;
                return {
                    results:  $.map(datas.data, function (item) {
                        return {
                        text: item[`${name}`],
                        id: item[`${id}`]
                        }
                    })
                };
            },
            cache: true
        }
    });
}

function searchPost(div, selected = '', modal, dataSubDis){
    if(selected){
        $.ajax({
            url: "/searchzip",
            type: "POST",
            dataType: 'json',
            data: function (params, page){
                return{
                    name: params.term,
                    subdis: dataSubDis,
                }
            },
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.zipcode}" >${item.zipcode+' - '+ item.zip_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectSearchKota(div, modal, 'searchdistrictpub', 'zipcode', 'zipcode', true, dataSubDis)

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectSearchPost(div, modal, 'searchprovince', 'zipcode', 'zipcode', true, dataSubDis)
    }
}

function selectSearchPost(div = '', modal = '', route = '', id = '', name = '', nest=false, dataSubDis=''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/searchzip`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                    subdis: dataSubDis,
                }
            },
            processResults: function (datas) {
                var varloop = nest ? datas : data;
                return {
                    results:  $.map(datas.data, function (item) {
                        return {
                        text: item.zipcode+' - '+ item.zip_name,
                        id: item[`${id}`]
                        }
                    })
                };
            },
            cache: true
        }
    });
}

function searchCompanyType(div, selected = '', modal, dataSubDis){
    if(selected){
        $.ajax({
            url: "/searchcompanytype",
            type: "POST",
            dataType: 'json',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.coytypehdr_id}" >${item.coytypehdr_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectCompanyType(div, modal, 'searchdistrictpub', 'zipcode', 'zipcode', true, dataSubDis)

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectCompanyType(div, modal, 'searchprovince', 'zipcode', 'zipcode', true, dataSubDis)
    }
}

function selectCompanyType(div = '', modal = '', route = '', id = '', name = '', nest=false, dataSubDis=''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/searchcompanytype`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            processResults: function (datas) {
                var varloop = nest ? datas : data;
                return {
                    results:  $.map(datas.data, function (item) {
                        return {
                        text: item.coytypehdr_name,
                        id: item.coytypehdr_id
                        }
                    })
                };
            },
            cache: true
        }
    });
}


function searchIdType(div, selected = '', modal, dataSubDis){
    if(selected){
        $.ajax({
            url: "/searchidentity",
            type: "POST",
            dataType: 'json',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            success: function (datas) {
                let varHtml = '';
                $.each(datas.data, (key, item) => {
                    varHtml +=  `<option value="${item.typeid_id}" >${item.typeid_name}</option>`
                });
                $(div).html(varHtml);
                $(div).val(selected);
                selectCompanyType(div, modal, 'searchdistrictpub', 'zipcode', 'zipcode', true, dataSubDis)

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        selectIdType(div, modal, 'searchprovince', 'zipcode', 'zipcode', true, dataSubDis)
    }
}

function selectIdType(div = '', modal = '', route = '', id = '', name = '', nest=false, dataSubDis=''){
    $(div).select2({
        placeholder: 'Cari...',
        dropdownParent: $(`#${modal}`),
        ajax: {
            url: `/searchidentity`,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params, page){
                return{
                    name: params.term,
                }
            },
            processResults: function (datas) {
                var varloop = nest ? datas : data;
                return {
                    results:  $.map(datas.data, function (item) {
                        return {
                        text: item.typeid_name,
                        id: item.typeid_id
                        }
                    })
                };
            },
            cache: true
        }
    });
}
