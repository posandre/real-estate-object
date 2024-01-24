"use strict";

jQuery(document).ready(function ($) {
  function runRealEstateFilter(page) {
    var buildingNameObject = $('input[name="building-name"]');
    var locationCoordinatesObject = $('input[name="location-coordinates"]');
    var floorsNumberObject = $('select[name="floors-number"]');
    var regionObject = $('select[name="region"]');
    var structureTypeObject = $('input[name="structure-type"]:checked');
    var objectsCountObject = $('input[name="objects-count"]');
    var objectsPerPageObject = $('input[name="objects-per-page"]');
    var filterResultObject = $('#real-estate-objects-filter-results');
    var filterPaginationObject = $('#real-estate-objects-filter-pagination');
    var formData = {
      action: 'real_estate_object_run_filter',
      page: page,
      building_name: buildingNameObject.val(),
      location_coordinates: locationCoordinatesObject.val(),
      floors_number: floorsNumberObject.val(),
      region: regionObject.val(),
      structure_type: structureTypeObject.val(),
      objects_count: objectsCountObject.val(),
      objects_per_page: objectsPerPageObject.val()
    };
    jQuery.ajax({
      method: 'POST',
      dataType: 'json',
      url: realEstateObjectSettings.ajax_url,
      data: formData,
      beforeSend: function beforeSend() {
        $('#real-estate-objects-filter-results').html('<p class="notification">Process started!!!</p>');
      },
      error: function error(xhr) {
        var errorMessage = xhr.responseJSON.message;
        errorMessageObject.text(errorMessage);
      },
      success: function success(responseData) {
        if (responseData.success) {
          if (responseData.data.real_estate_data) {
            filterResultObject.html(responseData.data.real_estate_data);
          }
          if (page == 1) {
            if (responseData.data.pagination_data) {
              filterPaginationObject.html(responseData.data.pagination_data);
              var paginationItemObject = $('#real-estate-objects-filter-pagination .pagination-item');
              if (paginationItemObject.length > 0) {
                $('#real-estate-objects-filter-pagination .pagination-item').on('click', function () {
                  paginationItemObject.removeClass('pagination-item--active');
                  $(this).addClass('pagination-item--active');
                  runRealEstateFilter($(this).text());
                });
              }
            } else {
              filterPaginationObject.html('');
            }
          }
        }
      }
    });
  }
  var realEstateFilterButtonObject = $('#real-estate-objects-filter-button');
  if (realEstateFilterButtonObject.length > 0) {
    realEstateFilterButtonObject.on('click', function () {
      runRealEstateFilter(1);
    });
  }
});