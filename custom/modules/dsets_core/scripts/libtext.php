<?php

/**
 * @file
 * Contains libtext.php.
 *
 * Set all node text fields to use unb_libraries text format.
 */

// Search for all anniversary node ids.
$nids = Drupal::entityQuery('node')
  ->condition('type', 'dsets_anniversary_event')->execute();

echo "\nStarting unb_libraries text format override...\n\n";
$i = 1;

// Load and update all anniversaries.
foreach ($nids as $nid) {
  $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
  $node->field_dsets_anniv_note->format = 'unb_libraries';
  $node->field_dsets_anniv_source->format = 'unb_libraries';
  $node->save();
  echo "$i anniversary records updated.\r";
  $i++;
}

echo "\n";
$i = 1;

// Search for all biography node ids.
$nids = Drupal::entityQuery('node')
  ->condition('type', 'dsets_biography')->execute();

// Load and update all biographies.
foreach ($nids as $nid) {
  $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
  $node->field_dsets_bio_illus->format = 'unb_libraries';
  $node->field_dsets_bio_location->format = 'unb_libraries';
  $node->field_dsets_bio_note->format = 'unb_libraries';
  $node->save();
  echo "$i biography records updated.\r";
  $i++;
}

echo "\nDone.\n\n";
