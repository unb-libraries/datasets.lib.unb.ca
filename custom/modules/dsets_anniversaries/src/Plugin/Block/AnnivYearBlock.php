<?php

namespace Drupal\dsets_anniversaries\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom Anniversary Year form block.
 *
 * @Block(
 *   id = "anniv_year_block",
 *   admin_label = @Translation("Anniversary Year"),
 *   category = @Translation("DSETS"),
 * )
 */
class AnnivYearBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()
      ->getForm('Drupal\dsets_anniversaries\Form\AnnivYearForm');
    $form['#cache']['max-age'] = 0;
    return $form;
  }

}
