/**
 * @file
 */

(function ($, Drupal) {
  Drupal.behaviors.monthYearFormField = {
    attach: function (context, settings) {
      $(".month-year-picker", context)
        .once("monthYearFormField")
        .each(function () {
          var options = {
            pattern: 'yyyy-mm',
            startYear: settings['month_year']['minYear'],
            finalYear: settings['month_year']['maxYear']
          };

          $(this).monthpicker(options);

          $(this).monthpicker("disableMonths", settings['month_year']['disableMonths']);

        });
    }
  };
})(jQuery, Drupal);
