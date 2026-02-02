<?php

use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Entity\Entity\EntityViewDisplay;

echo "Creating paragraph types...\n\n";

// 1. Image Slider Paragraph Type
if (!ParagraphsType::load('image_slider')) {
  $slider = ParagraphsType::create([
    'id' => 'image_slider',
    'label' => 'Image Slider',
    'description' => 'A carousel/slider with multiple images',
  ]);
  $slider->save();
  echo "✓ Created Image Slider paragraph type\n";

  // Add image field (multi-value)
  if (!FieldStorageConfig::loadByName('paragraph', 'field_slider_images')) {
    FieldStorageConfig::create([
      'field_name' => 'field_slider_images',
      'entity_type' => 'paragraph',
      'type' => 'image',
      'cardinality' => -1,
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_slider_images',
    'entity_type' => 'paragraph',
    'bundle' => 'image_slider',
    'label' => 'Slider Images',
    'required' => TRUE,
    'settings' => [
      'file_directory' => 'sliders',
      'file_extensions' => 'png jpg jpeg gif',
      'max_filesize' => '2 MB',
      'alt_field' => TRUE,
      'alt_field_required' => FALSE,
    ],
  ])->save();

  // Add caption field
  if (!FieldStorageConfig::loadByName('paragraph', 'field_slider_caption')) {
    FieldStorageConfig::create([
      'field_name' => 'field_slider_caption',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_slider_caption',
    'entity_type' => 'paragraph',
    'bundle' => 'image_slider',
    'label' => 'Caption',
  ])->save();

  // Configure form display
  $form_display = EntityFormDisplay::load('paragraph.image_slider.default');
  if (!$form_display) {
    $form_display = EntityFormDisplay::create([
      'targetEntityType' => 'paragraph',
      'bundle' => 'image_slider',
      'mode' => 'default',
      'status' => TRUE,
    ]);
  }
  $form_display
    ->setComponent('field_slider_images', ['type' => 'image_image'])
    ->setComponent('field_slider_caption', ['type' => 'text_textarea'])
    ->save();

  // Configure view display with Slick formatter
  $view_display = EntityViewDisplay::load('paragraph.image_slider.default');
  if (!$view_display) {
    $view_display = EntityViewDisplay::create([
      'targetEntityType' => 'paragraph',
      'bundle' => 'image_slider',
      'mode' => 'default',
      'status' => TRUE,
    ]);
  }
  $view_display
    ->setComponent('field_slider_images', [
      'type' => 'slick',
      'settings' => [
        'optionset' => 'default',
        'image_style' => 'large',
      ],
    ])
    ->setComponent('field_slider_caption', ['type' => 'text_default'])
    ->save();
}

// 2. Two Column Layout Paragraph Type
if (!ParagraphsType::load('two_column_layout')) {
  $two_col = ParagraphsType::create([
    'id' => 'two_column_layout',
    'label' => 'Two Column Layout',
    'description' => 'Content split into two columns',
  ]);
  $two_col->save();
  echo "✓ Created Two Column Layout paragraph type\n";

  // Left column
  if (!FieldStorageConfig::loadByName('paragraph', 'field_left_column')) {
    FieldStorageConfig::create([
      'field_name' => 'field_left_column',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_left_column',
    'entity_type' => 'paragraph',
    'bundle' => 'two_column_layout',
    'label' => 'Left Column',
  ])->save();

  // Right column
  if (!FieldStorageConfig::loadByName('paragraph', 'field_right_column')) {
    FieldStorageConfig::create([
      'field_name' => 'field_right_column',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_right_column',
    'entity_type' => 'paragraph',
    'bundle' => 'two_column_layout',
    'label' => 'Right Column',
  ])->save();

  $form_display = EntityFormDisplay::load('paragraph.two_column_layout.default') ?: EntityFormDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'two_column_layout', 'mode' => 'default', 'status' => TRUE]);
  $form_display
    ->setComponent('field_left_column', ['type' => 'text_textarea'])
    ->setComponent('field_right_column', ['type' => 'text_textarea'])
    ->save();

  $view_display = EntityViewDisplay::load('paragraph.two_column_layout.default') ?: EntityViewDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'two_column_layout', 'mode' => 'default', 'status' => TRUE]);
  $view_display
    ->setComponent('field_left_column', ['type' => 'text_default'])
    ->setComponent('field_right_column', ['type' => 'text_default'])
    ->save();
}

// 3. Three Column Layout Paragraph Type
if (!ParagraphsType::load('three_column_layout')) {
  $three_col = ParagraphsType::create([
    'id' => 'three_column_layout',
    'label' => 'Three Column Layout',
    'description' => 'Content split into three columns',
  ]);
  $three_col->save();
  echo "✓ Created Three Column Layout paragraph type\n";

  // Column 1
  if (!FieldStorageConfig::loadByName('paragraph', 'field_column_1')) {
    FieldStorageConfig::create([
      'field_name' => 'field_column_1',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_column_1',
    'entity_type' => 'paragraph',
    'bundle' => 'three_column_layout',
    'label' => 'Column 1',
  ])->save();

  // Column 2
  if (!FieldStorageConfig::loadByName('paragraph', 'field_column_2')) {
    FieldStorageConfig::create([
      'field_name' => 'field_column_2',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_column_2',
    'entity_type' => 'paragraph',
    'bundle' => 'three_column_layout',
    'label' => 'Column 2',
  ])->save();

  // Column 3
  if (!FieldStorageConfig::loadByName('paragraph', 'field_column_3')) {
    FieldStorageConfig::create([
      'field_name' => 'field_column_3',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_column_3',
    'entity_type' => 'paragraph',
    'bundle' => 'three_column_layout',
    'label' => 'Column 3',
  ])->save();

  $form_display = EntityFormDisplay::load('paragraph.three_column_layout.default') ?: EntityFormDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'three_column_layout', 'mode' => 'default', 'status' => TRUE]);
  $form_display
    ->setComponent('field_column_1', ['type' => 'text_textarea'])
    ->setComponent('field_column_2', ['type' => 'text_textarea'])
    ->setComponent('field_column_3', ['type' => 'text_textarea'])
    ->save();

  $view_display = EntityViewDisplay::load('paragraph.three_column_layout.default') ?: EntityViewDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'three_column_layout', 'mode' => 'default', 'status' => TRUE]);
  $view_display
    ->setComponent('field_column_1', ['type' => 'text_default'])
    ->setComponent('field_column_2', ['type' => 'text_default'])
    ->setComponent('field_column_3', ['type' => 'text_default'])
    ->save();
}

// 4. Hero Banner Paragraph Type
if (!ParagraphsType::load('hero_banner')) {
  $hero = ParagraphsType::create([
    'id' => 'hero_banner',
    'label' => 'Hero Banner',
    'description' => 'Large banner with image and text overlay',
  ]);
  $hero->save();
  echo "✓ Created Hero Banner paragraph type\n";

  // Banner image
  if (!FieldStorageConfig::loadByName('paragraph', 'field_banner_image')) {
    FieldStorageConfig::create([
      'field_name' => 'field_banner_image',
      'entity_type' => 'paragraph',
      'type' => 'image',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_banner_image',
    'entity_type' => 'paragraph',
    'bundle' => 'hero_banner',
    'label' => 'Banner Image',
    'required' => TRUE,
    'settings' => [
      'file_directory' => 'banners',
      'file_extensions' => 'png jpg jpeg',
      'max_filesize' => '5 MB',
      'alt_field' => TRUE,
    ],
  ])->save();

  // Headline
  if (!FieldStorageConfig::loadByName('paragraph', 'field_headline')) {
    FieldStorageConfig::create([
      'field_name' => 'field_headline',
      'entity_type' => 'paragraph',
      'type' => 'string',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_headline',
    'entity_type' => 'paragraph',
    'bundle' => 'hero_banner',
    'label' => 'Headline',
  ])->save();

  // Subheadline
  if (!FieldStorageConfig::loadByName('paragraph', 'field_subheadline')) {
    FieldStorageConfig::create([
      'field_name' => 'field_subheadline',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_subheadline',
    'entity_type' => 'paragraph',
    'bundle' => 'hero_banner',
    'label' => 'Subheadline',
  ])->save();

  // CTA Link
  if (!FieldStorageConfig::loadByName('paragraph', 'field_cta_link')) {
    FieldStorageConfig::create([
      'field_name' => 'field_cta_link',
      'entity_type' => 'paragraph',
      'type' => 'link',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_cta_link',
    'entity_type' => 'paragraph',
    'bundle' => 'hero_banner',
    'label' => 'Call to Action Link',
  ])->save();

  $form_display = EntityFormDisplay::load('paragraph.hero_banner.default') ?: EntityFormDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'hero_banner', 'mode' => 'default', 'status' => TRUE]);
  $form_display
    ->setComponent('field_banner_image', ['type' => 'image_image'])
    ->setComponent('field_headline', ['type' => 'string_textfield'])
    ->setComponent('field_subheadline', ['type' => 'text_textarea'])
    ->setComponent('field_cta_link', ['type' => 'link_default'])
    ->save();

  $view_display = EntityViewDisplay::load('paragraph.hero_banner.default') ?: EntityViewDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'hero_banner', 'mode' => 'default', 'status' => TRUE]);
  $view_display
    ->setComponent('field_banner_image', ['type' => 'image'])
    ->setComponent('field_headline', ['type' => 'string'])
    ->setComponent('field_subheadline', ['type' => 'text_default'])
    ->setComponent('field_cta_link', ['type' => 'link'])
    ->save();
}

// 5. Text with Image Paragraph Type
if (!ParagraphsType::load('text_with_image')) {
  $text_image = ParagraphsType::create([
    'id' => 'text_with_image',
    'label' => 'Text with Image',
    'description' => 'Text content with image on left or right',
  ]);
  $text_image->save();
  echo "✓ Created Text with Image paragraph type\n";

  // Image
  if (!FieldStorageConfig::loadByName('paragraph', 'field_paragraph_image')) {
    FieldStorageConfig::create([
      'field_name' => 'field_paragraph_image',
      'entity_type' => 'paragraph',
      'type' => 'image',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_paragraph_image',
    'entity_type' => 'paragraph',
    'bundle' => 'text_with_image',
    'label' => 'Image',
    'settings' => [
      'file_directory' => 'paragraphs',
      'file_extensions' => 'png jpg jpeg',
      'alt_field' => TRUE,
    ],
  ])->save();

  // Text
  if (!FieldStorageConfig::loadByName('paragraph', 'field_paragraph_text')) {
    FieldStorageConfig::create([
      'field_name' => 'field_paragraph_text',
      'entity_type' => 'paragraph',
      'type' => 'text_long',
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_paragraph_text',
    'entity_type' => 'paragraph',
    'bundle' => 'text_with_image',
    'label' => 'Text Content',
  ])->save();

  // Image position
  if (!FieldStorageConfig::loadByName('paragraph', 'field_image_position')) {
    FieldStorageConfig::create([
      'field_name' => 'field_image_position',
      'entity_type' => 'paragraph',
      'type' => 'list_string',
      'settings' => [
        'allowed_values' => [
          'left' => 'Left',
          'right' => 'Right',
        ],
      ],
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'field_image_position',
    'entity_type' => 'paragraph',
    'bundle' => 'text_with_image',
    'label' => 'Image Position',
    'default_value' => [['value' => 'left']],
  ])->save();

  $form_display = EntityFormDisplay::load('paragraph.text_with_image.default') ?: EntityFormDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'text_with_image', 'mode' => 'default', 'status' => TRUE]);
  $form_display
    ->setComponent('field_paragraph_image', ['type' => 'image_image'])
    ->setComponent('field_paragraph_text', ['type' => 'text_textarea'])
    ->setComponent('field_image_position', ['type' => 'options_select'])
    ->save();

  $view_display = EntityViewDisplay::load('paragraph.text_with_image.default') ?: EntityViewDisplay::create(['targetEntityType' => 'paragraph', 'bundle' => 'text_with_image', 'mode' => 'default', 'status' => TRUE]);
  $view_display
    ->setComponent('field_paragraph_image', ['type' => 'image'])
    ->setComponent('field_paragraph_text', ['type' => 'text_default'])
    ->setComponent('field_image_position', ['type' => 'list_default'])
    ->save();
}

echo "\n✓ All paragraph types created successfully!\n";
echo "\nParagraph types available:\n";
echo "  1. Image Slider (with Slick carousel)\n";
echo "  2. Two Column Layout\n";
echo "  3. Three Column Layout\n";
echo "  4. Hero Banner\n";
echo "  5. Text with Image\n";
