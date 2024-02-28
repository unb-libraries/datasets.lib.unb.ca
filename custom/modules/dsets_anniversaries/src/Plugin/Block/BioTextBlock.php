<?php

namespace Drupal\dsets_anniversaries\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom Anniversary Year form block.
 *
 * @Block(
 *   id = "bio_text_block",
 *   admin_label = @Translation("Biographies description text block"),
 *   category = @Translation("DSETS"),
 * )
 */
class BioTextBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $text = "<p>This is a dataset that points to the location of information about a UNB-related 
    person found in various articles and clippings files maintained at Archives & Special Collections, 
    UNB Libraries. Please contact archives@unb.ca if you would like to access these resources.</p>";

    return [
      '#markup' => $this->t($text),
    ];
  }

}
