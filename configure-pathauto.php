<?php

use Drupal\pathauto\Entity\PathautoPattern;

echo "Configuring Pathauto URL patterns...\n\n";

// Portfolio pattern
if (!PathautoPattern::load('portfolio_pattern')) {
  PathautoPattern::create([
    'id' => 'portfolio_pattern',
    'label' => 'Portfolio',
    'type' => 'canonical_entities:node',
    'pattern' => '/portfolio/[node:title]',
    'selection_criteria' => [
      [
        'id' => 'entity_bundle:node',
        'bundles' => ['portfolio' => 'portfolio'],
        'negate' => FALSE,
        'context_mapping' => ['node' => 'node'],
      ],
    ],
    'weight' => -5,
  ])->save();
  echo "✓ Created portfolio URL pattern: /portfolio/[title]\n";
}

// Article/Blog pattern
if (!PathautoPattern::load('article_pattern')) {
  PathautoPattern::create([
    'id' => 'article_pattern',
    'label' => 'Blog Articles',
    'type' => 'canonical_entities:node',
    'pattern' => '/blog/[node:title]',
    'selection_criteria' => [
      [
        'id' => 'entity_bundle:node',
        'bundles' => ['article' => 'article'],
        'negate' => FALSE,
        'context_mapping' => ['node' => 'node'],
      ],
    ],
    'weight' => -5,
  ])->save();
  echo "✓ Created blog URL pattern: /blog/[title]\n";
}

echo "\n✓ Pathauto patterns configured!\n";
echo "\nNow portfolio items will have URLs like:\n";
echo "  /portfolio/custom-kitchen-renovation\n";
echo "  /portfolio/handcrafted-dining-table\n";
echo "\nBlog posts will have URLs like:\n";
echo "  /blog/5-tips-maintaining-wood-furniture\n";
echo "  /blog/choosing-right-wood-your-project\n";

// Generate aliases for existing content
echo "\nGenerating URL aliases for existing content...\n";
$pathauto_generator = \Drupal::service('pathauto.generator');
$nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple();
$count = 0;
foreach ($nodes as $node) {
  if (in_array($node->bundle(), ['portfolio', 'article'])) {
    $pathauto_generator->updateEntityAlias($node, 'update');
    $count++;
  }
}
echo "✓ Generated $count URL aliases\n";
