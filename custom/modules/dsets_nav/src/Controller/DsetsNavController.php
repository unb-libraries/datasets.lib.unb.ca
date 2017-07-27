<?php

namespace Drupal\dsets_nav\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

  /**
   * {@inheritdoc}
   */
  public function anniversaries() {
    return new RedirectResponse("/anniversaries/" . date('Y') . "/all");
  }

  /**
   * {@inheritdoc}
   */
  public function home() {
    $element = [
      '#theme' => 'dsets_intro',
      '#attributes' => [],
    ];
    return $element;
  }

}
