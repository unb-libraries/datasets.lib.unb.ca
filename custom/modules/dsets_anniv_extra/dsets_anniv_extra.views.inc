<?php

/**
 * @file
 * Contains dsets_anniv_extra.views.inc.
 */

use Drupal\views\ViewExecutable;

/**
 * Implements hook_views_pre_render().
 */
function dsets_anniv_extra_views_pre_render(ViewExecutable $view) {

  if ($view->storage->id() == 'dsets_browse_anniversaries') {
    kint($view);
    $target_year = (int) $view->args[0];
    $results = $view->result;

    foreach ($results as $row) {
      $nid = $row->nid;
      $node = $row->_entity->load($nid);

      $anniv_date = $node->get('field_dsets_anniv_event_date')
        ->getValue()[0]['value'];
      $anniv_year = (int) substr($anniv_date, 0, 4);
      $anniv_targeted = $target_year - $anniv_year;

      if ($anniv_targeted > 0) {
        $anniv_targeted_x5 = ($anniv_targeted % 5 == 0 ? TRUE : FALSE);
        $node->get('field_dsets_anniv_targeted')->setValue($anniv_targeted);
      }
      else {
        $node->get('field_dsets_anniv_targeted')->setValue(0);
      }

      unset($node);
    }
  }

}
