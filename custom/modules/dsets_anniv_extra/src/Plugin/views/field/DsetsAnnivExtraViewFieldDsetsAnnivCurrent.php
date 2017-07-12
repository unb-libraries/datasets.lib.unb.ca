<?php

namespace Drupal\dsets_anniv_extra\Plugin\views\field;

use Drupal\views\ResultRow;
use Drupal\views\Plugin\views\field\FieldPluginBase;

/**
 * A handler to provide proper displays for current anniversary field.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("dsets_anniv_extra_view_field_dsets_anniv_current")
 */
class DsetsAnnivExtraViewFieldDsetsAnnivCurrent extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $anniv = $values->_entity;
    $anniv_date = $anniv->get('field_dsets_anniv_event_date')->getValue;
    $anniv_year = $anniv_date->format("Y");
    $anniv_current = date("Y") - $anniv_year;

    return $anniv_current;
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // This function exists to override parent query function.
    // Do nothing.
  }
}
