<?php

/**
 * @file Contains \Drupal\rateme\Plugin\Field\FieldType\ResultItem
 */

namespace Drupal\rateme\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *     id = "result",
 *     label = @Translation("Rating Result"),
 *     description = @Translation("The result of votes for an entity type"),
 *     default_formatter = "five_star_format",
 *     default_widget = "five_star_widget",
 * )
 */
class ResultItem extends FieldItemBase {
    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('integer')
            ->setLabel(t('Value'))
            ->setDescription('Value of the rating');

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return [
            'columns' => [
                'value' => [
                    'type' => 'int',
                    'unsigned' => TRUE,
                    'not null' => TRUE,
                ],
            ],
        ];
    }
}
