<?php

// Create additional portfolio items with sample images
$node_storage = \Drupal::entityTypeManager()->getStorage('node');

$portfolios = [
  [
    'title' => 'Rustic Bathroom Vanity',
    'description' => 'Hand-crafted solid oak bathroom vanity with custom drawers and granite countertop. Features soft-close hinges and a water-resistant finish perfect for high-moisture environments.',
  ],
  [
    'title' => 'Modern Bookshelf Wall Unit',
    'description' => 'Floor-to-ceiling walnut bookshelf system with adjustable shelving and integrated LED lighting. Custom-designed to fit the client\'s library collection with hidden cable management.',
  ],
  [
    'title' => 'Outdoor Deck & Pergola',
    'description' => 'Pressure-treated cedar deck with matching pergola structure. Built to withstand weather while providing a beautiful outdoor living space. Includes built-in bench seating and planter boxes.',
  ],
  [
    'title' => 'Kitchen Island with Breakfast Bar',
    'description' => 'Custom maple wood kitchen island featuring a raised breakfast bar, wine rack, and spacious cabinet storage. Finished with durable polyurethane for long-lasting beauty.',
  ],
  [
    'title' => 'Home Office Built-Ins',
    'description' => 'Complete home office solution with built-in desk, filing cabinets, and overhead storage. Cherry wood construction with wire management and adjustable shelving for maximum functionality.',
  ],
  [
    'title' => 'Craftsman-Style Front Door',
    'description' => 'Solid mahogany entry door with traditional craftsman design featuring beveled glass panels. Includes custom matching sidelights and professional weatherproofing.',
  ],
  [
    'title' => 'Children\'s Bunk Bed System',
    'description' => 'Safe and sturdy pine bunk beds with built-in storage drawers and bookshelf ladder. Finished with non-toxic stain and includes guardrails for safety.',
  ],
];

echo "Creating additional portfolio items...\n\n";

$image_dir = '/Users/mikendlovu/Documents/Drupal Project/drupal-site/web/sites/default/files/sample-images/';
$image_files = glob($image_dir . 'project-*.jpg');
$image_index = 0;

foreach ($portfolios as $portfolio) {
  echo "Creating: " . $portfolio['title'] . "\n";
  
  // Create node
  $node = $node_storage->create([
    'type' => 'portfolio',
    'title' => $portfolio['title'],
    'field_project_description' => [
      'value' => $portfolio['description'],
    ],
    'field_project_date' => [
      'value' => date('Y-m-d', strtotime('-' . rand(30, 365) . ' days')),
    ],
    'status' => 1,
  ]);
  
  // Add 2-4 images
  $file_ids = [];
  $num_images = rand(2, 4);
  
  for ($i = 0; $i < $num_images; $i++) {
    if (!isset($image_files[$image_index])) {
      $image_index = 0; // Reset
    }
    
    $source = $image_files[$image_index++];
    $dest = 'public://portfolio/' . basename($source);
    
    $dir = dirname($dest);
    \Drupal::service('file_system')->prepareDirectory($dir, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
    
    $file = \Drupal::service('file.repository')->writeData(
      file_get_contents($source),
      $dest,
      \Drupal\Core\File\FileSystemInterface::EXISTS_REPLACE
    );
    
    if ($file) {
      $file_ids[] = ['target_id' => $file->id()];
    }
  }
  
  $node->set('field_portfolio_images', $file_ids);
  $node->save();
  
  echo "  ✓ Created with " . count($file_ids) . " images (NID: " . $node->id() . ")\n";
}

echo "\n✓ Created " . count($portfolios) . " new portfolio items!\n";

// Also create more blog posts
$articles = [
  [
    'title' => '10 Essential Tools Every DIY Woodworker Needs',
    'body' => '<p>Getting started with woodworking? Here are the essential tools that will set you up for success.</p>
<h3>Basic Hand Tools</h3>
<ul>
<li><strong>Tape Measure:</strong> A 25-foot tape measure is essential for accurate measurements</li>
<li><strong>Combination Square:</strong> For marking and checking 90-degree angles</li>
<li><strong>Hand Saw:</strong> A quality crosscut saw for precision cuts</li>
</ul>
<h3>Power Tools</h3>
<ul>
<li><strong>Circular Saw:</strong> Versatile cutting tool for straight cuts</li>
<li><strong>Drill/Driver:</strong> Cordless drill for drilling and driving screws</li>
<li><strong>Orbital Sander:</strong> For smoothing surfaces</li>
</ul>
<h3>Safety Equipment</h3>
<ul>
<li><strong>Safety Glasses:</strong> Protect your eyes from flying debris</li>
<li><strong>Ear Protection:</strong> Essential when using power tools</li>
<li><strong>Dust Mask:</strong> Prevent inhalation of wood dust</li>
</ul>
<p>Remember, quality tools are an investment that will last for years with proper care.</p>',
  ],
  [
    'title' => 'The Difference Between Hardwood and Softwood',
    'body' => '<p>One of the first things to learn in woodworking is understanding the difference between hardwoods and softwoods.</p>
<h3>Hardwoods</h3>
<p>Hardwoods come from deciduous trees (trees that lose their leaves). Examples include:</p>
<ul>
<li>Oak - strong and durable, great for furniture</li>
<li>Maple - hard and smooth, ideal for cutting boards</li>
<li>Walnut - beautiful grain, premium furniture wood</li>
<li>Cherry - ages beautifully, darkens over time</li>
</ul>
<h3>Softwoods</h3>
<p>Softwoods come from coniferous trees (evergreens). Examples include:</p>
<ul>
<li>Pine - economical, easy to work with</li>
<li>Cedar - naturally rot-resistant, great for outdoor projects</li>
<li>Fir - strong and lightweight</li>
</ul>
<p>The terms "hardwood" and "softwood" don\'t actually refer to the hardness of the wood - balsa is technically a hardwood!</p>',
  ],
  [
    'title' => 'How to Properly Finish and Seal Wood Projects',
    'body' => '<p>Finishing is what transforms a good woodworking project into a great one. Here\'s our process.</p>
<h3>Preparation</h3>
<p>Sand progressively through 80, 120, 180, and 220 grit sandpaper. Remove all dust with a tack cloth.</p>
<h3>Staining (Optional)</h3>
<p>Apply stain with a brush or cloth, working with the grain. Wipe off excess after 5-10 minutes. Let dry completely.</p>
<h3>Sealing</h3>
<p>Options include:</p>
<ul>
<li><strong>Polyurethane:</strong> Durable, water-resistant, great for furniture</li>
<li><strong>Lacquer:</strong> Fast-drying, hard finish</li>
<li><strong>Oil:</strong> Brings out natural beauty, easy to maintain</li>
<li><strong>Wax:</strong> Traditional finish, requires periodic reapplication</li>
</ul>
<p>Apply 2-3 coats, sanding lightly between coats with 220 grit paper.</p>',
  ],
  [
    'title' => 'Custom Cabinetry vs. Stock Cabinets: What You Need to Know',
    'body' => '<p>Choosing between custom and stock cabinets is a major decision for any kitchen or bathroom remodel.</p>
<h3>Stock Cabinets</h3>
<p><strong>Pros:</strong></p>
<ul>
<li>More affordable</li>
<li>Quick availability</li>
<li>Standard sizes</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>Limited customization</li>
<li>May not fit unusual spaces</li>
<li>Lower quality materials</li>
</ul>
<h3>Custom Cabinets</h3>
<p><strong>Pros:</strong></p>
<ul>
<li>Perfect fit for any space</li>
<li>Unlimited design options</li>
<li>Premium materials</li>
<li>Built to last</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>Higher cost</li>
<li>Longer lead time</li>
</ul>
<p>At Leo\'s Carpentry, we specialize in custom cabinetry that maximizes your space and reflects your style.</p>',
  ],
];

echo "\n\nCreating blog posts...\n\n";

foreach ($articles as $article) {
  echo "Creating: " . $article['title'] . "\n";
  
  $node = $node_storage->create([
    'type' => 'article',
    'title' => $article['title'],
    'body' => [
      'value' => $article['body'],
      'format' => 'full_html',
    ],
    'status' => 1,
    'created' => strtotime('-' . rand(7, 90) . ' days'),
  ]);
  
  $node->save();
  echo "  ✓ Created (NID: " . $node->id() . ")\n";
}

echo "\n✓ Created " . count($articles) . " blog posts!\n";
echo "\n✓✓✓ All content created successfully! ✓✓✓\n";
