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

                    if (responseData.data.pagination_data && page ===1) {
                        filterPaginationObject .html(responseData.data.pagination_data);

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
        });
    }

    const realEstateFilterButtonObject = $('#real-estate-objects-filter-button');

    if (realEstateFilterButtonObject.length > 0) {
        realEstateFilterButtonObject.on('click', function () {
            runRealEstateFilter(1);
        });
    }
});

// jQuery(document).ready(function ($) {
//   const spcCalculateButtonObject = $('.school-price-calculator__button');
//
//   if ( spcCalculateButtonObject.length > 0 ) {
//       spcCalculateButtonObject.on('click', function () {
//           const buttonObject = $(this);
//           const oldButtonLabel = buttonObject.text();
//           const newButtonLabel = buttonObject.attr('data-label');
//           const calculatorObject = buttonObject.parent().parent().parent();
//           const errorMessageObject = calculatorObject.find('.school-price-calculator__error-message').first();
//           const perMonthObject = calculatorObject.find('.per-month i').first();
//           const perYearObject = calculatorObject.find('.per-year i').first();
//
//           if (buttonObject.hasClass('school-price-calculator__button--recalculate')) {
//               buttonObject
//                   .html(newButtonLabel)
//                   .attr('data-label', oldButtonLabel)
//                   .removeClass('school-price-calculator__button--recalculate');
//
//               calculatorObject
//                   .removeClass('school-price-calculator--end-calculation')
//                   .removeClass('school-price-calculator--error-api');
//
//               errorMessageObject.text('');
//               perMonthObject.text('');
//               perYearObject.text('');
//           } else {
//
//
//               const withoutAid = calculatorObject.find('input[name="without_aid"]').first().is(':checked');
//               const studentsNumberObject = calculatorObject.find('input[name="students_number"]');
//               const householdIncomeObject = calculatorObject.find('input[name="household_income"]');
//
//               let $formData = {};
//               let $route = (typeof spcSettings !== 'undefined' && typeof spcSettings.mainSiteUrl !== 'undefined')
//                   ? spcSettings.mainSiteUrl
//                   : window.location.origin
//
//               calculatorObject.find('input').removeClass('error');
//
//               if ($(calculatorObject).hasClass('school-price-calculator--start-calculation')) return;
//
//               if (!studentsNumberObject.val()) {
//                   studentsNumberObject.addClass('error');
//                   return;
//               }
//
//               if (!householdIncomeObject.val() && !withoutAid) {
//                   householdIncomeObject.addClass('error');
//                   return;
//               }
//
//               if (withoutAid) {
//                   $formData = {
//                       students_number: studentsNumberObject.val()
//                   };
//
//                   $route += '/wp-json/school-price-calculator/v1/education-prices-without-aid';
//               } else {
//                   $formData = {
//                       students_number: studentsNumberObject.val(),
//                       household_income: householdIncomeObject.val()
//                   };
//
//                   $route += '/wp-json/school-price-calculator/v1/education-prices';
//
//               }
//
//               jQuery.ajax({
//                   method: 'GET',
//                   dataType: 'json',
//                   url: $route,
//                   data: $formData,
//                   beforeSend: function () {
//                       buttonObject
//                           .html(newButtonLabel)
//                           .attr('data-label', oldButtonLabel)
//                           .addClass('school-price-calculator__button--recalculate')
//
//                       $(calculatorObject).addClass('school-price-calculator--start-calculation');
//                   },
//                   error: function (xhr) {
//                       const errorMessage = xhr.responseJSON.message;
//
//                       $(calculatorObject).removeClass('school-price-calculator--start-calculation');
//                       $(calculatorObject)
//                           .removeClass('school-price-calculator--start-calculation')
//                           .addClass('school-price-calculator--end-calculation')
//                           .addClass('school-price-calculator--error-api');
//
//                       errorMessageObject.text(errorMessage);
//                   },
//                   success: function (responseData) {
//                       buttonObject
//                           .html(newButtonLabel)
//                           .attr('data-label', oldButtonLabel)
//                           .addClass('school-price-calculator__button--recalculate')
//                       $(calculatorObject)
//                           .removeClass('school-price-calculator--start-calculation')
//                           .addClass('school-price-calculator--end-calculation');
//
//                       perMonthObject.text(responseData.price_per_month);
//                       perYearObject.text(responseData.price_per_year);
//                   }
//               });
//           }
//
//       })
//   }
//
//   const spcWithoutAidObject = $('input[name="without_aid"]');
//
//   if ( spcWithoutAidObject.length > 0 ) {
//       spcWithoutAidObject.on('click', function () {
//           const householdIncome = $(this).parent().parent().find('input[name="household_income"]');
//
//           if ( householdIncome.length > 0 ) {
//               const householdIncomeRowObject = householdIncome.first().parent();
//
//               householdIncomeRowObject.toggleClass('school-price-calculator__row--disabled');
//
//               householdIncome.removeClass('error');
//
//               if (householdIncome.attr('readonly')) {
//                   householdIncome.removeAttr('readonly');
//               } else {
//                   householdIncome.attr('readonly', 'readonly');
//               }
//           }
//       })
//   }
//
//   const spcOnlyDigits = $('.school-price-calculator__input-text--only-numbers');
//
//   if ( spcOnlyDigits.length > 0 ) {
//       spcOnlyDigits.on('input', function (e) {
//           const str = $( this ).val();
//           const newStr = str.replace(/[^0-9]/gi,'')
//
//           if ( str === newStr ) {
//               $(this).removeClass('error');
//               return true;
//           } else {
//               $(this)
//                   .addClass('error')
//                   .val(newStr);
//               return false;
//           }
//       });
//   }
//
//   const spcOnlyFloat = $('.school-price-calculator__input-text--only-float');
//
//   if ( spcOnlyFloat.length >0 ) {
//       spcOnlyFloat.on('input', function(e) {
//           const str = $(this).val();
//           const commaCount = str.split('.').length - 1;
//           let $newStr = str.replace(/[^0-9|^.]/gi,'');
//
//           if ( commaCount > 1) {
//               $newStr = $newStr.replace(/.$/, '');
//           }
//
//           if ( str === $newStr ) {
//               $(this).removeClass('error');
//               return true;
//           } else {
//               $(this)
//                   .addClass('error')
//                   .val($newStr);
//               return false;
//           }
//       });
//   }
//
//
// })