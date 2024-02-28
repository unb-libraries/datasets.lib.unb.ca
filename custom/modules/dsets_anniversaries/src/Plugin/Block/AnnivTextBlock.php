<?php

namespace Drupal\dsets_anniversaries\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom Anniversary Year form block.
 *
 * @Block(
 *   id = "anniv_text_block",
 *   admin_label = @Translation("Anniversaries description text block"),
 *   category = @Translation("DSETS"),
 * )
 */
class AnnivTextBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $text = "<p>This dataset contains important dates in UNB history, taken from a variety of sources. 
    Searching can be done in 5-year increments or can be done for a certain date.</p>";

    return [
      '#markup' => $this->t($text),
    ];  
  }

}
