<?php

namespace Drupal\dsets_nav\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Always deny access to '/user/password'.
    // Note that the second parameter of setRequirement() is a string.
    if ($route = $collection->get('user.pass')) {
      $route->setRequirement('_access', 'FALSE');
    }

  }

}
