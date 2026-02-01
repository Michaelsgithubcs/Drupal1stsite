<?php

/**
 * Script to add images to existing portfolio items
 */

use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;

// Bootstrap Drupal
$autoloader = require_once 'vendor/autoload.php';
$kernel = \Drupal\Core\DrupalKernel::createFromRequest(
  \Symfony\Component\HttpFoundation\Request::createFromGlobals(),
  $autoloader,
  'prod'
);
$kernel->boot();
$kernel->prepareLegacyRequest(\Symfony\Component\HttpFoundation\Request::createFromGlobals());

// Get all portfolio nodes
$node_storage = \Drupal::entityTypeManager()->getStorage('node');
$query = $node_storage->getQuery()
  ->condition('type', 'portfolio')
  ->accessCheck(FALSE);
$nids = $query->execute();

$image_dir = '/Users/mikendlovu/Documents/Drupal Project/drupal-site/web/sites/default/files/sample-images/';
$image_files = glob($image_dir . 'project-*.jpg');

$image_index = 0;

foreach ($nids as $nid) {
  $node = $node_storage->load($nid);
  
  if ($node && empty($node->get('field_portfolio_images')->getValue())) {
    echo "Adding images to: " . $node->getTitle() . "\n";
    
    // Add 2-3 images per portfolio item
    $num_images = rand(2, 3);
    $file_ids = [];
    
    for ($i = 0; $i < $num_images; $i++) {
      if (!isset($image_files[$image_index])) {
        $image_index = 0; // Reset if we run out
      }
      
      $source_file = $image_files[$image_index];
      $image_index++;
      
      // Copy file to public files directory
      $destination = 'public://portfolio/' . basename($source_file);
      
      // Create directory if needed
      $directory = dirname($destination);
      \Drupal::service('file_system')->prepareDirectory($directory, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
      
      // Copy the file
      $file = \Drupal::service('file.repository')->writeData(
        file_get_contents($source_file),
        $destination,
        \Drupal\Core\File\FileSystemInterface::EXISTS_REPLACE
      );
      
      if ($file) {
        $file_ids[] = ['target_id' => $file->id()];
        echo "  - Added image: " . $file->getFilename() . "\n";
      }
    }
    
    if (!empty($file_ids)) {
      $node->set('field_portfolio_images', $file_ids);
      $node->save();
      echo "  ✓ Saved node with " . count($file_ids) . " images\n\n";
    }
  }
}

echo "\n✓ Portfolio images updated successfully!\n";
