<?php

echo "Configuring Metatag for SEO...\n\n";

// Set global metatag defaults
$config = \Drupal::configFactory()->getEditable('metatag.metatag_defaults.global');
$config->set('tags', [
  'title' => '[current-page:title] | [site:name]',
  'description' => 'Leo\'s Carpentry & Designs - Quality craftsmanship and custom woodworking for your home.',
  'keywords' => 'carpentry, woodworking, custom furniture, kitchen renovation, portfolio',
  'canonical_url' => '[current-page:url]',
  'og_site_name' => '[site:name]',
  'og_type' => 'website',
  'og_url' => '[current-page:url]',
  'og_title' => '[current-page:title]',
  'og_description' => '[current-page:description]',
  'twitter_cards_type' => 'summary',
  'twitter_cards_title' => '[current-page:title]',
  'twitter_cards_description' => '[current-page:description]',
]);
$config->save();
echo "✓ Global metatags configured\n";

// Portfolio-specific metatags
$portfolio_config = \Drupal::configFactory()->getEditable('metatag.metatag_defaults.node__portfolio');
$portfolio_config->set('id', 'node__portfolio');
$portfolio_config->set('label', 'Content: Portfolio');
$portfolio_config->set('tags', [
  'title' => '[node:title] | Portfolio | [site:name]',
  'description' => '[node:field_project_description]',
  'keywords' => 'portfolio, [node:title], carpentry project',
  'og_type' => 'article',
  'og_title' => '[node:title]',
  'og_description' => '[node:field_project_description]',
]);
$portfolio_config->save();
echo "✓ Portfolio metatags configured\n";

// Article-specific metatags
$article_config = \Drupal::configFactory()->getEditable('metatag.metatag_defaults.node__article');
$article_config->set('id', 'node__article');
$article_config->set('label', 'Content: Article');
$article_config->set('tags', [
  'title' => '[node:title] | Blog | [site:name]',
  'description' => '[node:summary]',
  'keywords' => 'blog, [node:title], woodworking tips',
  'article_published_time' => '[node:created:html_datetime]',
  'article_modified_time' => '[node:changed:html_datetime]',
  'og_type' => 'article',
]);
$article_config->save();
echo "✓ Article metatags configured\n";

echo "\n✓ SEO Metatags ready!\n";
echo "Every page now has:\n";
echo "  - Proper title tags\n";
echo "  - Meta descriptions\n";
echo "  - Open Graph tags (Facebook sharing)\n";
echo "  - Twitter Card tags\n";
