<?php

namespace Drupal\month_year\Plugin\Field\FieldFormatter;

use Drupal\Core\Datetime\DateHelper;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'month_year_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "month_year_formatter",
 *   label = @Translation("Month Year"),
 *   field_types = {
 *     "month_year"
 *   }
 * )
 */
class MonthYearDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $element = [];

    foreach ($items as $delta => $item) {
      $element[$delta] = ['#markup' => $item->value];
    }
    return $element;
  }

}
