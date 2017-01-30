<?php

/**
 * @file Contains \Drupal\rateme\Plugin\Field\FieldFormatter\FiveStarFormatter
 */

namespace Drupal\rateme\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\rateme\Plugin\Field\FieldType\ResultItem;

/**
 * @FieldFormatter(
 *     id = "five_star_format",
 *     label = @Translation("Five Stars"),
 *     field_types = {
 *          "result",
 *          "rating",
 *     }
 * )
 */
class FiveStarFormatter extends FormatterBase {
    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];
        foreach ($items as $delta => $item) {
            $elements[$delta] = [
                "#theme" => "five_stars",
                '#attached' => [
                    'library' => ['rateme/fivestar', 'rateme/fontawesome'],
                ],
                "#value" => $item->value,
                "#required" => TRUE,
            ];
            if ($item instanceof ResultItem) {
                // Result item is only available on fieldable nodes, so $node->id() can be pulled safely
                $entity = $item->getEntity();
                $voting = \Drupal::service('rateme.rating');
                $elements[$delta]['#value'] = $voting->getRating($entity->id(), $entity->getEntityTypeId());
            }
        }
        return $elements;
    }
}