#!/bin/bash
# Site Structure Setup Script for Leo's Carpentry & Designs
# This script creates all content types, pages, and menu structure

set -e
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"

echo "================================================"
echo "Setting up Leo's Carpentry & Designs Drupal Site"
echo "================================================"

# Create Portfolio content type
echo ""
echo "Creating Portfolio content type..."
vendor/bin/drush php-eval "
\$storage = \Drupal::entityTypeManager()->getStorage('node_type');
if (!\$storage->load('portfolio')) {
  \$type = \$storage->create([
    'type' => 'portfolio',
    'name' => 'Portfolio Item',
    'description' => 'Portfolio gallery items showcasing carpentry projects',
  ]);
  \$type->save();
  echo 'Portfolio content type created.\n';
  
  // Add image field
  \$field_storage = \Drupal\field\Entity\FieldStorageConfig::create([
    'field_name' => 'field_portfolio_images',
    'entity_type' => 'node',
    'type' => 'image',
    'cardinality' => -1,
  ]);
  \$field_storage->save();
  
  \$field = \Drupal\field\Entity\FieldConfig::create([
    'field_storage' => \$field_storage,
    'bundle' => 'portfolio',
    'label' => 'Project Images',
    'required' => TRUE,
  ]);
  \$field->save();
  
  // Add project description field
  \$field_storage = \Drupal\field\Entity\FieldStorageConfig::create([
    'field_name' => 'field_project_description',
    'entity_type' => 'node',
    'type' => 'text_long',
  ]);
  \$field_storage->save();
  
  \$field = \Drupal\field\Entity\FieldConfig::create([
    'field_storage' => \$field_storage,
    'bundle' => 'portfolio',
    'label' => 'Project Description',
    'required' => TRUE,
  ]);
  \$field->save();
  
  // Add project date field
  \$field_storage = \Drupal\field\Entity\FieldStorageConfig::create([
    'field_name' => 'field_project_date',
    'entity_type' => 'node',
    'type' => 'datetime',
  ]);
  \$field_storage->save();
  
  \$field = \Drupal\field\Entity\FieldConfig::create([
    'field_storage' => \$field_storage,
    'bundle' => 'portfolio',
    'label' => 'Project Completion Date',
  ]);
  \$field->save();
  
  // Configure form display
  \$form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', 'portfolio', 'default');
  \$form_display->setComponent('field_portfolio_images', ['type' => 'image_image', 'weight' => 1]);
  \$form_display->setComponent('field_project_description', ['type' => 'text_textarea', 'weight' => 2]);
  \$form_display->setComponent('field_project_date', ['type' => 'datetime_default', 'weight' => 3]);
  \$form_display->save();
  
  // Configure view display
  \$view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', 'portfolio', 'default');
  \$view_display->setComponent('field_portfolio_images', ['type' => 'image', 'weight' => 1]);
  \$view_display->setComponent('field_project_description', ['type' => 'text_default', 'weight' => 2]);
  \$view_display->setComponent('field_project_date', ['type' => 'datetime_default', 'weight' => 3]);
  \$view_display->save();
  
  echo 'Portfolio fields configured.\n';
} else {
  echo 'Portfolio content type already exists.\n';
}
"

# Create Home page
echo ""
echo "Creating Home page..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');
\$nodes = \$node_storage->loadByProperties(['title' => 'Home', 'type' => 'page']);
if (empty(\$nodes)) {
  \$node = \$node_storage->create([
    'type' => 'page',
    'title' => 'Home',
    'body' => [
      'value' => '<h2>Welcome to Leo\'s Carpentry & Designs</h2>
<p>We are a premier carpentry and woodworking company specializing in custom furniture, cabinetry, and home renovations. With over 15 years of experience, we bring craftsmanship and attention to detail to every project.</p>

<h3>Our Services</h3>
<p>From custom kitchen cabinets to handcrafted furniture, we do it all. Browse our portfolio to see examples of our work.</p>

<h3>Why Choose Us?</h3>
<ul>
  <li>Expert craftsmanship with 15+ years experience</li>
  <li>Custom designs tailored to your needs</li>
  <li>Quality materials and sustainable practices</li>
  <li>Timely delivery and competitive pricing</li>
</ul>

<p><strong>Ready to start your project? <a href=\"/contact\">Contact us</a> today for a free consultation!</strong></p>',
      'format' => 'full_html',
    ],
    'status' => 1,
  ]);
  \$node->save();
  echo 'Home page created with NID: ' . \$node->id() . '\n';
  
  // Set as front page
  \Drupal::configFactory()->getEditable('system.site')
    ->set('page.front', '/node/' . \$node->id())
    ->save();
  echo 'Set as front page.\n';
} else {
  echo 'Home page already exists.\n';
}
"

# Create Services page
echo ""
echo "Creating Services page..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');
\$nodes = \$node_storage->loadByProperties(['title' => 'Services', 'type' => 'page']);
if (empty(\$nodes)) {
  \$node = \$node_storage->create([
    'type' => 'page',
    'title' => 'Services',
    'body' => [
      'value' => '<h2>Our Services</h2>
<p>We offer a comprehensive range of carpentry and woodworking services to meet all your needs.</p>

<h3>Custom Cabinetry</h3>
<p>Beautiful, functional cabinets for kitchens, bathrooms, and any room in your home. We design and build to your exact specifications.</p>

<h3>Custom Furniture</h3>
<p>Handcrafted tables, chairs, shelving, and more. Each piece is unique and built to last generations.</p>

<h3>Home Renovations</h3>
<p>Complete or partial home renovations including trim work, built-ins, and architectural details that add character to your space.</p>

<h3>Commercial Projects</h3>
<p>We also handle commercial carpentry projects including retail fixtures, office furniture, and restaurant buildouts.</p>

<h3>Repairs & Restoration</h3>
<p>Expert repair and restoration of antique furniture and damaged woodwork.</p>

<p><strong>Interested in our services? <a href=\"/contact\">Get in touch</a> to discuss your project.</strong></p>',
      'format' => 'full_html',
    ],
    'status' => 1,
  ]);
  \$node->save();
  echo 'Services page created with NID: ' . \$node->id() . '\n';
} else {
  echo 'Services page already exists.\n';
}
"

# Create Portfolio page (placeholder that will list portfolio items)
echo ""
echo "Creating Portfolio page..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');
\$nodes = \$node_storage->loadByProperties(['title' => 'Portfolio', 'type' => 'page']);
if (empty(\$nodes)) {
  \$node = \$node_storage->create([
    'type' => 'page',
    'title' => 'Portfolio',
    'body' => [
      'value' => '<h2>Our Portfolio</h2>
<p>Browse through our completed projects to see examples of our craftsmanship and attention to detail.</p>
<p>Each project showcases our commitment to quality and our ability to bring your vision to life.</p>',
      'format' => 'full_html',
    ],
    'status' => 1,
  ]);
  \$node->save();
  echo 'Portfolio page created with NID: ' . \$node->id() . '\n';
} else {
  echo 'Portfolio page already exists.\n';
}
"

# Create Blog page
echo ""
echo "Creating Blog overview page..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');
\$nodes = \$node_storage->loadByProperties(['title' => 'Blog', 'type' => 'page']);
if (empty(\$nodes)) {
  \$node = \$node_storage->create([
    'type' => 'page',
    'title' => 'Blog',
    'body' => [
      'value' => '<h2>Carpentry Tips & Project Updates</h2>
<p>Stay up to date with our latest projects, carpentry tips, and industry insights.</p>',
      'format' => 'full_html',
    ],
    'status' => 1,
  ]);
  \$node->save();
  echo 'Blog page created with NID: ' . \$node->id() . '\n';
} else {
  echo 'Blog page already exists.\n';
}
"

# Create Contact page
echo ""
echo "Creating Contact page..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');
\$nodes = \$node_storage->loadByProperties(['title' => 'Contact', 'type' => 'page']);
if (empty(\$nodes)) {
  \$node = \$node_storage->create([
    'type' => 'page',
    'title' => 'Contact',
    'body' => [
      'value' => '<h2>Get In Touch</h2>
<p>Ready to start your project? Have questions about our services? We\'d love to hear from you!</p>

<h3>Contact Information</h3>
<p>
<strong>Leo\'s Carpentry & Designs</strong><br>
Phone: (555) 123-4567<br>
Email: info@leos-carpentry.local<br>
Hours: Monday-Friday 8am-5pm
</p>

<h3>Send Us a Message</h3>
<p>Use the form below to send us a message and we\'ll get back to you within 24 hours.</p>',
      'format' => 'full_html',
    ],
    'status' => 1,
  ]);
  \$node->save();
  echo 'Contact page created with NID: ' . \$node->id() . '\n';
} else {
  echo 'Contact page already exists.\n';
}
"

# Create sample portfolio items
echo ""
echo "Creating sample portfolio items..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');

\$portfolio_items = [
  [
    'title' => 'Custom Kitchen Renovation',
    'description' => 'Complete kitchen renovation featuring custom oak cabinets, granite countertops, and a large island with built-in storage. This project transformed a dated kitchen into a modern, functional space perfect for entertaining.',
  ],
  [
    'title' => 'Handcrafted Dining Table',
    'description' => 'Solid walnut dining table with live edge design, seats 8 people. Features mortise and tenon joinery and hand-rubbed oil finish. Built to last for generations.',
  ],
  [
    'title' => 'Built-In Entertainment Center',
    'description' => 'Floor-to-ceiling entertainment center with adjustable shelving, concealed wiring, and custom LED lighting. Made from cherry wood with a satin finish.',
  ],
];

foreach (\$portfolio_items as \$item) {
  \$nodes = \$node_storage->loadByProperties(['title' => \$item['title'], 'type' => 'portfolio']);
  if (empty(\$nodes)) {
    \$node = \$node_storage->create([
      'type' => 'portfolio',
      'title' => \$item['title'],
      'field_project_description' => [
        'value' => \$item['description'],
      ],
      'status' => 1,
    ]);
    \$node->save();
    echo 'Created portfolio item: ' . \$item['title'] . '\n';
  }
}
"

# Create sample blog posts
echo ""
echo "Creating sample blog posts..."
vendor/bin/drush php-eval "
\$node_storage = \Drupal::entityTypeManager()->getStorage('node');

\$blog_posts = [
  [
    'title' => '5 Tips for Maintaining Wood Furniture',
    'body' => '<p>Proper maintenance can keep your wood furniture looking beautiful for decades. Here are our top tips:</p>
<ol>
<li><strong>Regular dusting:</strong> Use a soft, dry cloth to dust weekly.</li>
<li><strong>Avoid direct sunlight:</strong> UV rays can fade and damage wood finishes.</li>
<li><strong>Use coasters:</strong> Protect surfaces from water rings and heat damage.</li>
<li><strong>Annual polishing:</strong> Apply quality furniture polish once a year.</li>
<li><strong>Control humidity:</strong> Keep indoor humidity between 40-60% to prevent warping.</li>
</ol>',
  ],
  [
    'title' => 'Choosing the Right Wood for Your Project',
    'body' => '<p>Different woods have different characteristics. Here\'s a quick guide:</p>
<ul>
<li><strong>Oak:</strong> Durable, beautiful grain, excellent for cabinets and furniture</li>
<li><strong>Maple:</strong> Hard, smooth grain, ideal for cutting boards and floors</li>
<li><strong>Walnut:</strong> Rich color, fine grain, premium furniture choice</li>
<li><strong>Cherry:</strong> Ages beautifully, darkens over time, great for heirloom pieces</li>
<li><strong>Pine:</strong> Budget-friendly, easy to work with, perfect for painted projects</li>
</ul>',
  ],
];

foreach (\$blog_posts as \$post) {
  \$nodes = \$node_storage->loadByProperties(['title' => \$post['title'], 'type' => 'article']);
  if (empty(\$nodes)) {
    \$node = \$node_storage->create([
      'type' => 'article',
      'title' => \$post['title'],
      'body' => [
        'value' => \$post['body'],
        'format' => 'full_html',
      ],
      'status' => 1,
    ]);
    \$node->save();
    echo 'Created blog post: ' . \$post['title'] . '\n';
  }
}
"

# Create main navigation menu
echo ""
echo "Creating main navigation menu..."
vendor/bin/drush php-eval "
\$menu_link_manager = \Drupal::service('plugin.manager.menu.link');

\$menu_items = [
  ['title' => 'Home', 'link' => '/node/1', 'weight' => 0],
  ['title' => 'Services', 'link' => '/node/2', 'weight' => 1],
  ['title' => 'Portfolio', 'link' => '/node/3', 'weight' => 2],
  ['title' => 'Blog', 'link' => '/node/4', 'weight' => 3],
  ['title' => 'Contact', 'link' => '/node/5', 'weight' => 4],
];

foreach (\$menu_items as \$item) {
  \$menu_link_content = \Drupal\menu_link_content\Entity\MenuLinkContent::create([
    'title' => \$item['title'],
    'link' => ['uri' => 'internal:' . \$item['link']],
    'menu_name' => 'main',
    'weight' => \$item['weight'],
  ]);
  
  try {
    \$menu_link_content->save();
    echo 'Created menu item: ' . \$item['title'] . '\n';
  } catch (Exception \$e) {
    echo 'Menu item may already exist: ' . \$item['title'] . '\n';
  }
}
"

# Configure site settings
echo ""
echo "Configuring site settings..."
vendor/bin/drush config:set system.site name "Leo's Carpentry & Designs" -y
vendor/bin/drush config:set system.site mail "admin@leos-carpentry.local" -y
vendor/bin/drush config:set system.site slogan "Expert Craftsmanship Since 2010" -y

# Clear cache
echo ""
echo "Clearing cache..."
vendor/bin/drush cache:rebuild

echo ""
echo "================================================"
echo "Site structure setup complete!"
echo "================================================"
echo ""
echo "Created:"
echo "  - Portfolio content type with custom fields"
echo "  - 5 main pages (Home, Services, Portfolio, Blog, Contact)"
echo "  - 3 sample portfolio items"
echo "  - 2 sample blog posts"
echo "  - Main navigation menu"
echo ""
echo "Access your site at: http://drupal.local:8080"
echo "Admin login: admin / admin123"
echo ""
