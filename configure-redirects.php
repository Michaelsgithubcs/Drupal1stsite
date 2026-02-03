<?php

use Drupal\redirect\Entity\Redirect;

echo "Creating useful redirects...\n\n";

$redirects = [
  [
    'from' => '/portfolio-gallery',
    'to' => '/portfolio',
    'reason' => 'Old portfolio gallery URL',
  ],
  [
    'from' => '/blog-posts',
    'to' => '/blog',
    'reason' => 'Old blog listing URL',
  ],
  [
    'from' => '/projects',
    'to' => '/portfolio',
    'reason' => 'Alternative portfolio URL',
  ],
  [
    'from' => '/work',
    'to' => '/portfolio',
    'reason' => 'Alternative portfolio URL',
  ],
  [
    'from' => '/news',
    'to' => '/blog',
    'reason' => 'Alternative blog URL',
  ],
  [
    'from' => '/articles',
    'to' => '/blog',
    'reason' => 'Alternative blog URL',
  ],
  [
    'from' => '/contact-us',
    'to' => '/contact',
    'reason' => 'Alternative contact URL',
  ],
  [
    'from' => '/get-in-touch',
    'to' => '/contact',
    'reason' => 'Alternative contact URL',
  ],
];

foreach ($redirects as $redirect_config) {
  // Check if redirect already exists
  $existing = \Drupal::entityTypeManager()
    ->getStorage('redirect')
    ->loadByProperties(['redirect_source__path' => ltrim($redirect_config['from'], '/')]);
  
  if (empty($existing)) {
    $redirect = Redirect::create([
      'redirect_source' => ltrim($redirect_config['from'], '/'),
      'redirect_redirect' => 'internal:' . $redirect_config['to'],
      'language' => 'und',
      'status_code' => '301',
    ]);
    $redirect->save();
    echo "✓ Created redirect: {$redirect_config['from']} → {$redirect_config['to']}\n";
  }
}

echo "\n✓ All redirects configured!\n";
echo "\nRedirects will automatically handle:\n";
echo "  - Old or alternative URLs\n";
echo "  - Common misspellings\n";
echo "  - SEO-friendly 301 permanent redirects\n";
