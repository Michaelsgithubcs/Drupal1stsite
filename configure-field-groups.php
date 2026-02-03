<?php

use Drupal\field_group\Entity\FieldGroup;

echo "Configuring Field Groups to organize content forms...\n\n";

// Portfolio content type field groups
$portfolio_details = [
  'group_name' => 'group_project_details',
  'entity_type' => 'node',
  'bundle' => 'portfolio',
  'mode' => 'default',
  'context' => 'form',
  'children' => [
    'field_project_description',
    'field_project_date',
  ],
  'parent_name' => '',
  'weight' => 20,
  'label' => 'Project Details',
  'format_type' => 'details',
  'format_settings' => [
    'open' => TRUE,
    'required_fields' => TRUE,
  ],
  'region' => 'content',
];

$portfolio_media = [
  'group_name' => 'group_project_media',
  'entity_type' => 'node',
  'bundle' => 'portfolio',
  'mode' => 'default',
  'context' => 'form',
  'children' => [
    'field_portfolio_images',
  ],
  'parent_name' => '',
  'weight' => 21,
  'label' => 'Project Images',
  'format_type' => 'details',
  'format_settings' => [
    'open' => TRUE,
    'required_fields' => TRUE,
  ],
  'region' => 'content',
];

// Article content type field groups
$article_content = [
  'group_name' => 'group_article_content',
  'entity_type' => 'node',
  'bundle' => 'article',
  'mode' => 'default',
  'context' => 'form',
  'children' => [
    'body',
    'field_image',
  ],
  'parent_name' => '',
  'weight' => 20,
  'label' => 'Article Content',
  'format_type' => 'details',
  'format_settings' => [
    'open' => TRUE,
    'required_fields' => TRUE,
  ],
  'region' => 'content',
];

$article_meta = [
  'group_name' => 'group_article_meta',
  'entity_type' => 'node',
  'bundle' => 'article',
  'mode' => 'default',
  'context' => 'form',
  'children' => [
    'field_tags',
  ],
  'parent_name' => '',
  'weight' => 21,
  'label' => 'Metadata',
  'format_type' => 'details',
  'format_settings' => [
    'open' => FALSE,
    'required_fields' => FALSE,
  ],
  'region' => 'content',
];

// Create field groups
foreach ([$portfolio_details, $portfolio_media, $article_content, $article_meta] as $group_config) {
  $id = $group_config['entity_type'] . '.' . $group_config['bundle'] . '.' . $group_config['mode'] . '.' . $group_config['group_name'];
  
  if (!FieldGroup::load($id)) {
    $field_group = FieldGroup::create($group_config);
    $field_group->save();
    echo "✓ Created field group: {$group_config['label']} for {$group_config['bundle']}\n";
  }
}

echo "\n✓ Field Groups configured!\n";
echo "Portfolio form now has:\n";
echo "  - Project Details (description, date)\n";
echo "  - Project Images\n";
echo "\nArticle form now has:\n";
echo "  - Article Content (body, image)\n";
echo "  - Metadata (tags)\n";
