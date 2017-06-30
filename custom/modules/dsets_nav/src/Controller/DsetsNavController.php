<?php

namespace Drupal\dsets_nav\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\TrustedRedirectResponse;

/**
 * Controller for Datasets navigation.
 */
class DsetsNavController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function archives() {
    return new TrustedRedirectResponse('https://www.lib.unb.ca/archives/');
  }

  public function home() {
    $element = array(
      '#markup' => '<p>Welcome to UNB Libraries Datasets. Please
      select from the following content sets:</p>',
    );
    return $element;
  }
}
