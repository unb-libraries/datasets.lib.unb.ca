<?php

namespace Drupal\dsets_anniversaries_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for address content.
 *
 * @MigrateSource(
 *   id = "subject"
 * )
 */
class Subject extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('subjects', 's')
      ->fields('s', ['subject_id', 'subject']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'subject_id'  => $this->t('Subject ID'),
      'subject'     => $this->t('Subject')
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'subject_id' => [
        'type' => 'integer',
        'alias' => 's',
      ],
    ];
  }
}
