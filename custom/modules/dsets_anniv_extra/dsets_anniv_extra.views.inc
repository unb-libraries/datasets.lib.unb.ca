<?php

/**
 * Implements hook_views_data().
 */
function dsets_anniv_extra_views_data_alter(array &$data) {

  $data['node']['field_dsets_anniv_current'] = [
    'title' => t('Current Anniversary'),
    'help' => t(''),
    'field' => array(
      'id' => 'dsets_anniv_extra_view_field_dsets_anniv_current',
    ),
  ];

  return $data;
}
