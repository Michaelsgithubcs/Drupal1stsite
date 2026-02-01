<?php

$image_dir = '/Users/mikendlovu/Documents/Drupal Project/drupal-site/web/sites/default/files/sample-images/';
$image_files = glob($image_dir . 'project-*.jpg');

$node_storage = \Drupal::entityTypeManager()->getStorage('node');
$nids = [6, 7, 8]; // Portfolio nodes

$image_index = 0;
foreach ($nids as $nid) {
  $node = $node_storage->load($nid);
  if (!$node) continue;
  
  echo 'Adding images to: ' . $node->getTitle() . PHP_EOL;
  
  $file_ids = [];
  for ($i = 0; $i < 3; $i++) {
    if (!isset($image_files[$image_index])) break;
    
    $source = $image_files[$image_index++];
    $dest = 'public://portfolio/' . basename($source);
    
    $dir = dirname($dest);
    \Drupal::service('file_system')->prepareDirectory($dir, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
    
    $file = \Drupal::service('file.repository')->writeData(
      file_get_contents($source),
      $dest,
      \Drupal\Core\File\FileSystemInterface::EXISTS_REPLACE
    );
    
    if ($file) {
      $file_ids[] = ['target_id' => $file->id()];
      echo '  - Added: ' . $file->getFilename() . PHP_EOL;
    }
  }
  
  if (!empty($file_ids)) {
    $node->set('field_portfolio_images', $file_ids);
    $node->save();
    echo '  ✓ Saved with ' . count($file_ids) . ' images' . PHP_EOL . PHP_EOL;
  }
}
echo '✓ Done!' . PHP_EOL;
