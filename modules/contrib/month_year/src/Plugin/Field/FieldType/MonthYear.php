<?php

namespace Drupal\month_year\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'month_year' field type.
 *
 * @FieldType(
 *   id = "month_year",
 *   label = @Translation("Month Year"),
 *   default_widget = "month_year_widget",
 *   default_formatter = "month_year_formatter"
 * )
 */
class MonthYear extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    return [
      'columns' => [
        'value' => [
          'type' => 'char',
          'length' => 7,
          'not null' => TRUE,
          'description' => 'To store the month year.',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Month Year'));
    return $properties;
  }

}
