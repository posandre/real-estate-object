jQuery(document).ready(function ($) {
    function runRealEstateFilter(page) {
        const buildingNameObject = $('input[name="building-name"]');
        const locationCoordinatesObject = $('input[name="location-coordinates"]');
        const floorsNumberObject = $('select[name="floors-number"]');
        const regionObject = $('select[name="region"]');
        const structureTypeObject = $('input[name="structure-type"]:checked');
        const objectsCountObject = $('input[name="objects-count"]');
        const objectsPerPageObject = $('input[name="objects-per-page"]');

        const filterResultObject = $('#real-estate-objects-filter-results');
        const filterPaginationObject = $('#real-estate-objects-filter-pagination');


        const formData = {
            action: 'real_estate_object_run_filter',
            page: page,
            building_name: buildingNameObject.val(),
            location_coordinates: locationCoordinatesObject.val(),
            floors_number: floorsNumberObject.val(),
            region: regionObject.val(),
            structure_type: structureTypeObject.val(),
            objects_count: objectsCountObject.val(),
            objects_per_page: objectsPerPageObject.val(),
        };

        jQuery.ajax({
            method: 'POST',
            dataType: 'json',
            url: realEstateObjectSettings.ajax_url,
            data: formData,
            beforeSend: function () {
                $('#real-estate-objects-filter-results').html('<p class="notification">Process started!!!</p>')
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON.message;

                errorMessageObject.text(errorMessage);
            },
            success: function (responseData) {
                if (responseData.success) {
                    if (responseData.data.real_estate_data) {
                        filterResultObject.html(responseData.data.real_estate_data);
                    }

                    if (page == 1) {
                        if (responseData.data.pagination_data) {
                            filterPaginationObject.html(responseData.data.pagination_data);
                            const paginationItemObject = $('#real-estate-objects-filter-pagination .pagination-item');

                            if (paginationItemObject.length > 0) {
                                $('#real-estate-objects-filter-pagination .pagination-item').on('click', function () {
                                    paginationItemObject.removeClass('pagination-item--active');

                                    $(this).addClass('pagination-item--active');
                                    runRealEstateFilter($(this).text());
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    const realEstateFilterButtonObject = $('#real-estate-objects-filter-button');

    if (realEstateFilterButtonObject.length > 0) {
        realEstateFilterButtonObject.on('click', function () {
            const filterPaginationObject = $('#real-estate-objects-filter-pagination');

            filterPaginationObject.html('');

            runRealEstateFilter(1);
        });
    }
});