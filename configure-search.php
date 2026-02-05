<?php

use Drupal\search_api\Entity\Index;
use Drupal\search_api\Entity\Server;

echo "Setting up Search API...\n\n";

// Create database server
if (!Server::load('database_server')) {
  $server = Server::create([
    'id' => 'database_server',
    'name' => 'Database Server',
    'description' => 'Search server using the database',
    'backend' => 'search_api_db',
    'backend_config' => [
      'database' => 'default:default',
      'min_chars' => 3,
    ],
  ]);
  $server->save();
  echo "✓ Created database search server\n";
}

// Create content index
if (!Index::load('content_index')) {
  $index = Index::create([
    'id' => 'content_index',
    'name' => 'Content Index',
    'description' => 'Search index for site content',
    'server' => 'database_server',
    'datasource_settings' => [
      'entity:node' => [
        'bundles' => [
          'default' => TRUE,
          'selected' => ['article', 'portfolio', 'page'],
        ],
      ],
    ],
    'processor_settings' => [
      'html_filter' => [
        'weights' => ['preprocess_index' => -10],
      ],
      'ignorecase' => [
        'weights' => ['preprocess_index' => -20],
      ],
    ],
    'field_settings' => [
      'title' => [
        'type' => 'text',
        'boost' => 5.0,
      ],
      'body' => [
        'type' => 'text',
        'boost' => 1.0,
      ],
      'field_project_description' => [
        'type' => 'text',
        'boost' => 2.0,
      ],
    ],
    'options' => [
      'index_directly' => TRUE,
    ],
  ]);
  $index->save();
  echo "✓ Created content search index\n";
  
  // Index content
  $index->indexItems();
  echo "✓ Indexed all content\n";
}

echo "\n✓ Search API configured!\n";
echo "Site now has:\n";
echo "  - Database-backed search\n";
echo "  - Portfolio, Article, and Page content indexed\n";
echo "  - Title boosted 5x for relevance\n";
echo "  - Ready to create search pages with Views\n";
