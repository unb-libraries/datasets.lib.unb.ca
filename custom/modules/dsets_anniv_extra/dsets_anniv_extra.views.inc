<?php

/**
 * @file
 * Contains dsets_anniv_extra.views.inc.
 */

use Drupal\Node\Entity\Node;

/**
 * Implements hook_views_pre_render().
 */
function dsets_anniv_extra_views_pre_render($view) {

  if ($view->storage->id() == 'dsets_browse_anniversaries') {
    $target_yr = (int) $view->args[0];

    $events = \Drupal::entityQuery('node')
      ->condition('type', 'dsets_anniversary_event')
      ->execute();

    foreach ($events as $event) {
      $node = Node::load($event);
      $date = $node->get('field_dsets_anniv_event_date')
        ->getValue()[0]['value'];
      $year = (int) substr($date, 0, 4);
      $anniv = ($target_yr - $year > 0 ? $target_yr - $year : 0);
      $anniv_pre = (int) $node->get('field_dsets_anniv_targeted')
        ->getValue()[0]['value'];

      $anniv_x5 = ($anniv % 5 == 0);
      $node->get('field_dsets_anniv_target')->setValue($target_yr);
      $node->get('field_dsets_anniv_targeted')->setValue($anniv);
      $node->get('field_dsets_anniv_targeted_x5')->setValue($anniv_x5);

      $node->save();
    }

    unset($node);
    unset($event);
    unset($events);

    drupal_flush_all_caches();
  }
}
