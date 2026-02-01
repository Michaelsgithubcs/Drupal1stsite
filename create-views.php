<?php

// Create a Portfolio Gallery view
$view_storage = \Drupal::entityTypeManager()->getStorage('view');

// Check if view already exists
$existing_view = $view_storage->load('portfolio_gallery');
if ($existing_view) {
  $existing_view->delete();
  echo "Removed existing portfolio_gallery view\n";
}

// Create portfolio gallery view
echo "Creating Portfolio Gallery view...\n";

$view = $view_storage->create([
  'id' => 'portfolio_gallery',
  'label' => 'Portfolio Gallery',
  'module' => 'views',
  'description' => 'Displays portfolio items in a grid',
  'tag' => '',
  'base_table' => 'node_field_data',
  'base_field' => 'nid',
  'display' => [
    'default' => [
      'display_plugin' => 'default',
      'id' => 'default',
      'display_title' => 'Master',
      'position' => 0,
      'display_options' => [
        'access' => [
          'type' => 'perm',
        ],
        'cache' => [
          'type' => 'tag',
        ],
        'query' => [
          'type' => 'views_query',
        ],
        'exposed_form' => [
          'type' => 'basic',
        ],
        'pager' => [
          'type' => 'full',
          'options' => [
            'items_per_page' => 9,
          ],
        ],
        'style' => [
          'type' => 'grid',
          'options' => [
            'columns' => 3,
            'alignment' => 'horizontal',
          ],
        ],
        'row' => [
          'type' => 'fields',
        ],
        'fields' => [
          'field_portfolio_images' => [
            'id' => 'field_portfolio_images',
            'table' => 'node__field_portfolio_images',
            'field' => 'field_portfolio_images',
            'label' => '',
            'settings' => [
              'image_style' => 'medium',
              'image_link' => 'content',
            ],
          ],
          'title' => [
            'id' => 'title',
            'table' => 'node_field_data',
            'field' => 'title',
            'label' => '',
            'settings' => [
              'link_to_entity' => TRUE,
            ],
          ],
        ],
        'filters' => [
          'status' => [
            'id' => 'status',
            'table' => 'node_field_data',
            'field' => 'status',
            'value' => '1',
          ],
          'type' => [
            'id' => 'type',
            'table' => 'node_field_data',
            'field' => 'type',
            'value' => [
              'portfolio' => 'portfolio',
            ],
          ],
        ],
        'sorts' => [
          'created' => [
            'id' => 'created',
            'table' => 'node_field_data',
            'field' => 'created',
            'order' => 'DESC',
          ],
        ],
      ],
    ],
    'page_1' => [
      'display_plugin' => 'page',
      'id' => 'page_1',
      'display_title' => 'Page',
      'position' => 1,
      'display_options' => [
        'path' => 'portfolio-gallery',
        'menu' => [
          'type' => 'normal',
          'title' => 'Portfolio Gallery',
          'menu_name' => 'main',
        ],
      ],
    ],
  ],
]);

$view->save();
echo "✓ Portfolio Gallery view created at /portfolio-gallery\n";

// Create Blog listing view
$existing_blog = $view_storage->load('blog_listing');
if ($existing_blog) {
  $existing_blog->delete();
  echo "Removed existing blog_listing view\n";
}

echo "\nCreating Blog Listing view...\n";

$blog_view = $view_storage->create([
  'id' => 'blog_listing',
  'label' => 'Blog Listing',
  'module' => 'views',
  'description' => 'Lists blog articles',
  'base_table' => 'node_field_data',
  'base_field' => 'nid',
  'display' => [
    'default' => [
      'display_plugin' => 'default',
      'id' => 'default',
      'display_title' => 'Master',
      'position' => 0,
      'display_options' => [
        'access' => [
          'type' => 'perm',
        ],
        'cache' => [
          'type' => 'tag',
        ],
        'query' => [
          'type' => 'views_query',
        ],
        'pager' => [
          'type' => 'full',
          'options' => [
            'items_per_page' => 10,
          ],
        ],
        'style' => [
          'type' => 'default',
        ],
        'row' => [
          'type' => 'fields',
        ],
        'fields' => [
          'title' => [
            'id' => 'title',
            'table' => 'node_field_data',
            'field' => 'title',
            'settings' => [
              'link_to_entity' => TRUE,
            ],
          ],
          'created' => [
            'id' => 'created',
            'table' => 'node_field_data',
            'field' => 'created',
            'label' => 'Posted',
            'settings' => [
              'date_format' => 'medium',
            ],
          ],
          'body' => [
            'id' => 'body',
            'table' => 'node__body',
            'field' => 'body',
            'label' => '',
            'type' => 'text_summary_or_trimmed',
            'settings' => [
              'trim_length' => 300,
            ],
          ],
        ],
        'filters' => [
          'status' => [
            'id' => 'status',
            'table' => 'node_field_data',
            'field' => 'status',
            'value' => '1',
          ],
          'type' => [
            'id' => 'type',
            'table' => 'node_field_data',
            'field' => 'type',
            'value' => [
              'article' => 'article',
            ],
          ],
        ],
        'sorts' => [
          'created' => [
            'id' => 'created',
            'table' => 'node_field_data',
            'field' => 'created',
            'order' => 'DESC',
          ],
        ],
      ],
    ],
    'page_1' => [
      'display_plugin' => 'page',
      'id' => 'page_1',
      'display_title' => 'Page',
      'position' => 1,
      'display_options' => [
        'path' => 'blog-posts',
        'menu' => [
          'type' => 'normal',
          'title' => 'Blog',
          'menu_name' => 'main',
        ],
      ],
    ],
  ],
]);

$blog_view->save();
echo "✓ Blog Listing view created at /blog-posts\n";

// Update menu to use new views
echo "\nUpdating navigation menu...\n";

// Load existing Portfolio menu link and update it
$menu_link_manager = \Drupal::service('plugin.manager.menu.link');
$menu_links = \Drupal::entityTypeManager()->getStorage('menu_link_content')->loadByProperties([
  'title' => 'Portfolio',
  'menu_name' => 'main',
]);

foreach ($menu_links as $menu_link) {
  $menu_link->set('link', ['uri' => 'internal:/portfolio-gallery']);
  $menu_link->save();
  echo "✓ Updated Portfolio menu link\n";
}

// Update Blog menu link
$blog_links = \Drupal::entityTypeManager()->getStorage('menu_link_content')->loadByProperties([
  'title' => 'Blog',
  'menu_name' => 'main',
]);

foreach ($blog_links as $menu_link) {
  $menu_link->set('link', ['uri' => 'internal:/blog-posts']);
  $menu_link->save();
  echo "✓ Updated Blog menu link\n";
}

echo "\n✓✓✓ Views and navigation updated! ✓✓✓\n";
