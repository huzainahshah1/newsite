<?php

namespace Drupal\month_year\Plugin\Field\FieldFormatter;

use Drupal\Core\Datetime\DateHelper;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'month_year_abbr_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "month_year_abbr_formatter",
 *   label = @Translation("Abbr."),
 *   field_types = {
 *     "month_year"
 *   }
 * )
 */
class MonthYearAbbrFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $months = DateHelper::monthNamesAbbr(TRUE);

    $element = [];

    foreach ($items as $delta => $item) {
      list($year, $month) = explode('-', $item->value);
      $month = $month ? $months[(integer) $month] : '';
      $element[$delta] = ['#markup' => $this->t("$month $year")];
    }
    return $element;
  }

}
