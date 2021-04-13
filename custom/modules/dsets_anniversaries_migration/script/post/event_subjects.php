<?php

/**
 * @file
 * Post-migration script to link anniversary events to their subject(s).
 */

use Drupal\node\Entity\Node;

// Fetch events.
$query = \Drupal::entityQuery('node')
  ->condition('type', 'dsets_anniversary_event');
$events = $query->execute();

// Iterate through events.
foreach ($events as $event) {

  // Get OLD event ID from migrated node.
  $ev_node = Node::load($event);
  $ev_id = $ev_node->get('field_dsets_anniv_old_id')
    ->getValue()[0]['value'];

  // Get IDs of corresponding subjects from event_subjects table.
  $qstring = "SELECT subject_id
              FROM {event_subjects}
              WHERE event_id = :ev_id";

  $qresult = \Drupal::database()->query($qstring, [':ev_id' => $ev_id]);
  $sub_ids = $qresult->fetchAll();

  // Append each subject ID to node reference field.
  foreach ($sub_ids as $sub_id) {

    if ($sub_id) {
      $sub_id_ref = ['target_id' => $sub_id->subject_id];
      $ev_node->field_dsets_anniv_event_subject->appendItem($sub_id_ref);
    }

  }

  // Save changes to event node then close.
  $ev_node->save();
  unset($ev_node);

}

drush_print_r("Script completed.");
