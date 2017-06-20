<?php

namespace Drupal\dsets_anniversaries_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for address content.
 *
 * @MigrateSource(
 *   id = "event"
 * )
 */
class Event extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('events', 'e')
      ->fields('e', ['event_id', 'event', 'source', 'event_date', 'note']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'event_id'    => $this->t('Event ID'),
      'event'       => $this->t('Event'),
      'source'      => $this->t('Source'),
      'event_date'  => $this->t('Event Date'),
      'note'        => $this->t('Note'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'event_id' => [
        'type' => 'integer',
        'alias' => 'e',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    /**
     * prepareRow runs after a row is fetched.
     */

    /**
     * Process fields that will be translated into taxonomy term indexes.
     */

    $ev_id = $row->getSourceProperty('event_id');

    $qstring = "SELECT subject_id
                FROM {event_subjects}
                WHERE event_id = :ev_id";

    $qsubs = db_query($qstring, array(
      ':ev_id' => $ev_id
    ));

    $sub_ids = $qsubs->fetchAll();
    $sub_refs = array();

    foreach ($sub_ids as $sub_id) {
      $sub_id_ref = array('target_id' => $sub_id);
      $sub_refs->appendItem($sub_id_ref);
    }

    drush_print_r($sub_refs);
  }

}
