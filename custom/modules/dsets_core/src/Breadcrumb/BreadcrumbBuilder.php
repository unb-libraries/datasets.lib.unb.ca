<?php

namespace Drupal\dsets_core\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\taxonomy\Entity\Term;

/**
 * Custom breadcrumb builder.
 */
class BreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {
    if (preg_match('/^\/admin\//', \Drupal::service('path.current')->getPath())) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $routeName = $route_match->getRouteName();
    $links = [
      new Link('UNB Libraries', Url::fromUri('https://lib.unb.ca')),
    ];

    if (\Drupal::service('path.matcher')->isFrontPage()) {
      $links[] = Link::createFromRoute('Datasets', '<none>');
    }
    else {
      $links[] = Link::createFromRoute('Datasets', '<front>');
    }

    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(['url.path']);

    $breadcrumb->setLinks($links);
    return $breadcrumb;
  }

}
