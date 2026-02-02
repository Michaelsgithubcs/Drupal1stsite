<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Entity\Entity\EntityViewDisplay;

echo "Adding Paragraphs field to Page content type...\n\n";

// Create paragraphs field storage if it doesn't exist
if (!FieldStorageConfig::loadByName('node', 'field_page_paragraphs')) {
  FieldStorageConfig::create([
    'field_name' => 'field_page_paragraphs',
    'entity_type' => 'node',
    'type' => 'entity_reference_revisions',
    'cardinality' => -1,
    'settings' => [
      'target_type' => 'paragraph',
    ],
  ])->save();
  echo "✓ Created field storage\n";
}

// Add field to Page content type
if (!FieldConfig::loadByName('node', 'page', 'field_page_paragraphs')) {
  FieldConfig::create([
    'field_name' => 'field_page_paragraphs',
    'entity_type' => 'node',
    'bundle' => 'page',
    'label' => 'Page Content',
    'settings' => [
      'handler' => 'default:paragraph',
      'handler_settings' => [
        'negate' => 0,
        'target_bundles' => [
          'image_slider' => 'image_slider',
          'two_column_layout' => 'two_column_layout',
          'three_column_layout' => 'three_column_layout',
          'hero_banner' => 'hero_banner',
          'text_with_image' => 'text_with_image',
        ],
        'target_bundles_drag_drop' => [
          'image_slider' => ['enabled' => TRUE],
          'two_column_layout' => ['enabled' => TRUE],
          'three_column_layout' => ['enabled' => TRUE],
          'hero_banner' => ['enabled' => TRUE],
          'text_with_image' => ['enabled' => TRUE],
        ],
      ],
    ],
  ])->save();
  echo "✓ Added field to Page content type\n";
}

// Configure form display with Layout Paragraphs
$form_display = EntityFormDisplay::load('node.page.default');
if ($form_display) {
  $form_display->setComponent('field_page_paragraphs', [
    'type' => 'layout_paragraphs',
    'weight' => 10,
    'settings' => [
      'preview_view_mode' => 'default',
      'nesting_depth' => 0,
      'require_layouts' => 0,
    ],
  ])->save();
  echo "✓ Configured form display with Layout Paragraphs\n";
}

// Configure view display
$view_display = EntityViewDisplay::load('node.page.default');
if ($view_display) {
  $view_display->setComponent('field_page_paragraphs', [
    'type' => 'entity_reference_revisions_entity_view',
    'weight' => 10,
    'label' => 'hidden',
  ])->save();
  echo "✓ Configured view display\n";
}

// Hide body field (optional - we'll use paragraphs instead)
if ($form_display) {
  $form_display->removeComponent('body')->save();
  echo "✓ Hidden body field (using paragraphs instead)\n";
}

echo "\n✓ Page content type now uses Paragraphs!\n";
echo "\nYou can now:\n";
echo "  - Edit any page at /node/[id]/edit\n";
echo "  - Add Image Sliders, Hero Banners, and layout components\n";
echo "  - Drag and drop to reorder paragraphs\n";
echo "  - Mix and match different content types\n";
