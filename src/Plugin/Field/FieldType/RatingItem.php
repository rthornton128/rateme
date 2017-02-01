<?php

/**
 * @file Contains \Drupal\rateme\Plugin\Field\FieldType\RatingItem
 */

/* FIXME 8.4.x slated to use a 'hidden' field for widgets, set this by default as it should not be viewable */

namespace Drupal\rateme\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *     id = "rating",
 *     label = @Translation("Rating"),
 *     description = @Translation("This field stores the rating of an entity"),
 *     default_formatter = "five_star_format",
 *     default_widget = "five_star_widget",
 * )
 */
class RatingItem extends FieldItemBase {
    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('integer')
            ->setLabel(t('Value'))
            ->setDescription('The value of the rating');

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
