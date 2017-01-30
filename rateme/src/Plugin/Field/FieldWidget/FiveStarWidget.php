<?php

/**
 * @file
 * Contains \Drupal\rateme\Plugin\Field\FieldWidget\FiveStarWidget
 */

namespace Drupal\rateme\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *     id = "five_star_widget",
 *     label = @Translation("Five Stars"),
 *     field_types = {
 *          "result",
 *          "rating",
 *     }
 * )
 */

class FiveStarWidget extends WidgetBase implements WidgetInterface {
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
    {
        $element['value'] = [
            '#type' => 'radios',
            '#title' => t('Five Star Rating'),
            '#attached' => [
                'library' => ['rateme/fivestar', 'rateme/fontawesome'],
            ],
            '#attributes' => [
                'class' => ['five-star'],
            ],
            '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : 1,
            '#options' => [1 => ' ', 2 => ' ', 3 => ' ', 4 => ' ', 5 => ' '],
        ];

        return $element;
    }
}