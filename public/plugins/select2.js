
function country_select2(modal_parent = ''){

    $(".country_id_select2").select2({
        placeholder: "Select a country",
        allowClear: false,
        dropdownAutoWidth: true,
        closeOnSelect:true,
        dropdownParent: modal_parent != '' ? modal_parent  : '',

        ajax: {
            url: __url +'/country-select',
            type : "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search_term: params.term, // search term
                    page: params.page || 1,
                };
            },
            processResults: function (data, params) {

                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
//                            more: data.total_count != 0 ? params.page : 0
                  }
                };
            },
            cache: false
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    }).on('select2:select', function (e) {
            var select_data = e.params.data;
    });
}

function city_select2(modal_parent = ''){

    $(".city_id_select2").select2({
        placeholder: "Select a city",
        allowClear: false,
        dropdownAutoWidth: true,
        closeOnSelect:true,
        dropdownParent: modal_parent != '' ? modal_parent  : '',

        ajax: {
            url: __url +'/city-select',
            type : "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search_term: params.term, // search term
                    page: params.page || 1,
                    country_id: $('#filter_country_id').val(),
                };
            },
            processResults: function (data, params) {

                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
//                            more: data.total_count != 0 ? params.page : 0
                  }
                };
            },
            cache: false
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    }).on('select2:select', function (e) {
            var select_data = e.params.data;
    });
}
