<?php

namespace Drupal\dsets_anniversaries_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for event content.
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

}
