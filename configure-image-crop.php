<?php

use Drupal\crop\Entity\CropType;
use Drupal\Core\Entity\Entity\EntityFormDisplay;

echo "Setting up Image Cropping...\n\n";

// Create crop types
if (!CropType::load('16_9')) {
  CropType::create([
    'id' => '16_9',
    'label' => '16:9 (Landscape)',
    'description' => 'Landscape 16:9 ratio',
    'aspect_ratio' => '16:9',
  ])->save();
  echo "✓ Created 16:9 crop type\n";
}

if (!CropType::load('square')) {
  CropType::create([
    'id' => 'square',
    'label' => '1:1 (Square)',
    'description' => 'Square 1:1 ratio',
    'aspect_ratio' => '1:1',
  ])->save();
  echo "✓ Created square crop type\n";
}

// Update portfolio images field to use image widget crop
$form_display = EntityFormDisplay::load('node.portfolio.default');
if ($form_display) {
  $component = $form_display->getComponent('field_portfolio_images');
  if ($component) {
    $component['type'] = 'image_widget_crop';
    $component['settings'] = [
      'preview_image_style' => 'thumbnail',
      'crop_preview_image_style' => 'crop_thumbnail',
      'crop_list' => ['16_9', 'square'],
      'crop_types_required' => [],
      'show_default_crop' => TRUE,
      'warn_multiple_usages' => TRUE,
    ];
    $form_display->setComponent('field_portfolio_images', $component);
    $form_display->save();
    echo "✓ Portfolio images now use crop widget\n";
  }
}

// Update article image field
$article_form_display = EntityFormDisplay::load('node.article.default');
if ($article_form_display) {
  $component = $article_form_display->getComponent('field_image');
  if ($component) {
    $component['type'] = 'image_widget_crop';
    $component['settings'] = [
      'preview_image_style' => 'thumbnail',
      'crop_preview_image_style' => 'crop_thumbnail',
      'crop_list' => ['16_9', 'square'],
      'crop_types_required' => [],
      'show_default_crop' => TRUE,
      'warn_multiple_usages' => TRUE,
    ];
    $article_form_display->setComponent('field_image', $component);
    $article_form_display->save();
    echo "✓ Article images now use crop widget\n";
  }
}

echo "\n✓ Image cropping ready!\n";
echo "Now when you upload images:\n";
echo "  - Portfolio items → Crop interface appears\n";
echo "  - Article images → Crop interface appears\n";
echo "  - Choose 16:9 or Square ratios\n";
