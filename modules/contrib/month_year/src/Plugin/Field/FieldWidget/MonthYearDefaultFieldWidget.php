<?php

namespace Drupal\month_year\Plugin\Field\FieldWidget;

use Drupal\Core\Datetime\DateHelper;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'month_year_widget' widget.
 *
 * @FieldWidget(
 *   id = "month_year_widget",
 *   label = @Translation("Month Year"),
 *   field_types = {
 *    "month_year"
 *   },
 *   settings = {
 *     "min_year" = 2015,
 *     "adjustment" = 5
 *   },
 * )
 */
class MonthYearDefaultFieldWidget extends WidgetBase {

  const MIN_YEAR = 2015;
  const ADJUSTMENT = 5;
  const DISABLED_MONTHS = [2, 3, 5, 6, 7, 8, 10, 11, 12];

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $default_value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $settings = [
      'month_year' => [
        'minYear' => $this->getMinYear(),
        'maxYear' => $this->getMaxYear(),
        'disableMonths' => $this->getDisabledMonths(),
      ],
    ];

    $element['value'] = $element + [
      '#type' => 'textfield',
      '#size' => '7',
      '#max_length' => '7',
      '#default_value' => $default_value,
      '#required' => $element['#required'],
      '#attributes' => ['class' => ['month-year-picker']],
      '#attached' => [
        'library' => ['month_year/month_year'],
        'drupalSettings' => $settings,
      ],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'min_year' => self::MIN_YEAR,
      'adjustment' => self::ADJUSTMENT,
      'disabled_months' => self::DISABLED_MONTHS,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $element['min_year'] = [
      '#type' => 'number',
      '#title' => t('Min year'),
      '#default_value' => $this->getSetting('min_year'),
      '#required' => TRUE,
    ];

    $element['adjustment'] = [
      '#type' => 'number',
      '#title' => t('Adjustment'),
      '#default_value' => $this->getSetting('adjustment'),
      '#description' => t('Max year = Current year + Adjustment'),
      '#required' => TRUE,
    ];

    $element['disabled_months'] = [
      '#type' => 'select',
      '#multiple' => TRUE,
      '#options' => DateHelper::monthNames(TRUE),
      '#title' => t('Disabled months'),
      '#default_value' => $this->getSetting('disabled_months'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = [];

    $summary[] = t('Mix year: @min_year', [
      '@min_year' => $this->getSetting('min_year'),
    ]);

    $summary[] = t('Max year: @max_year', [
      '@max_year' => $this->getMaxYear(),
    ]);

    $summary[] = t('Disabled months: @disabled_months', [
      '@disabled_months' => implode(',', $this->getDisabledMonths()),
    ]);

    return $summary;
  }

  /**
   * The minimum year of available years.
   *
   * @return int
   *   The minimum year.
   */
  protected function getMinYear() {
    return $this->getSetting('min_year');
  }

  /**
   * The maximum year of available years.
   *
   * @return int
   *   The maximum year.
   */
  protected function getMaxYear() {
    /* @var \Drupal\Core\Datetime\DateFormatter $formatter */
    $formatter = \Drupal::service('date.formatter');
    $request_time = \Drupal::time()->getRequestTime();
    $year = (integer) $formatter->format($request_time, 'custom', 'Y');
    return $year + $this->getSetting('adjustment');
  }

  /**
   * The disabled months which are not available.
   *
   * @return array
   *   The disabled months.
   */
  protected function getDisabledMonths() {
    return $this->getSetting('disabled_months');
  }

}
