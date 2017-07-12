<?php

/**
 * @file
 * Contains dsets_anniv_extra.views.inc.
 */

/**
 * Implements hook_views_data_alter().
 */
function dsets_anniv_extra_views_data_alter(array &$data) {

  $data['node']['field_dsets_anniv_current'] = [
    'title' => t('Current Anniversary'),
    'field' => [
      'id' => 'dsets_anniv_extra_view_field_dsets_anniv_current',
    ],
  ];

}
