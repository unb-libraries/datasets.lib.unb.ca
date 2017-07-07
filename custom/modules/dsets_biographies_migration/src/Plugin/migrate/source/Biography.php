<?php

namespace Drupal\dsets_biographies_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for biography content.
 *
 * @MigrateSource(
 *   id = "biography"
 * )
 */
class Biography extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('biographies', 'b')
      ->fields('b', ['biography_id', 'name', 'location', 'illus', 'notes']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'name' => $this->t('Name'),
      'location' => $this->t('Location'),
      'illus' => $this->t('Illus'),
      'notes' => $this->t('Notes'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'biography_id' => [
        'type' => 'integer',
        'alias' => 'b',
      ],
    ];
  }

}
