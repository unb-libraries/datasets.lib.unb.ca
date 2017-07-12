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
    $anniv_date_field = $anniv->get('field_dsets_anniv_event_date')->getValue();
    $anniv_date_str = $anniv_date_field[0]['value'];
    $anniv_year_str = substr($anniv_date_str, 0, 4);
    $anniv_year_int = (int)$anniv_year_str;
    $current_year_str = date("Y");
    $current_year_int = (int)$current_year_str;
    $anniv_current = $current_year_int - $anniv_year_int;

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
