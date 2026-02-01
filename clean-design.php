<?php

use Drupal\node\Entity\Node;

// Clean up Home page - remove AI-looking CTAs and brown colors
$home = Node::load(1);
if ($home) {
  $clean_home = '<h2>Welcome to Leo\'s Carpentry & Designs</h2>

<p>Quality craftsmanship and custom woodworking for your home. From custom furniture to complete renovations, we bring your vision to life with expert skill and attention to detail.</p>

<h3>What We Offer</h3>

<p><strong>Custom Furniture</strong><br>
Handcrafted pieces tailored to your space and style.</p>

<p><strong>Kitchen & Bath Remodeling</strong><br>
Transform your spaces with custom cabinetry and built-ins.</p>

<p><strong>Outdoor Structures</strong><br>
Decks, pergolas, and outdoor living spaces.</p>

<h3>Why Choose Leo\'s Carpentry</h3>

<p>Over 15 years of experience in fine woodworking and carpentry. We take pride in every project, ensuring quality materials, expert craftsmanship, and customer satisfaction.</p>

<p><a href="/portfolio">View Our Portfolio</a> | <a href="/contact">Get in Touch</a></p>';

  $home->set('body', [
    'value' => $clean_home,
    'format' => 'full_html',
  ]);
  $home->save();
  echo "✓ Home page cleaned up\n";
}

// Clean up Services page - remove brown colors and AI styling
$services = Node::load(2);
if ($services) {
  $clean_services = '<h2>Our Services</h2>

<p>We specialize in custom woodworking and carpentry services for residential projects.</p>

<h3>Custom Furniture Design</h3>
<p>One-of-a-kind pieces designed and built to your exact specifications. From dining tables to entertainment centers, we create furniture that fits your space perfectly.</p>

<h3>Kitchen Cabinetry</h3>
<p>Custom kitchen cabinets and islands built with quality hardwoods. We handle everything from design to installation.</p>

<h3>Bathroom Vanities</h3>
<p>Custom bathroom vanities and storage solutions that maximize space while adding beauty to your bathroom.</p>

<h3>Built-In Storage</h3>
<p>Maximize your space with custom built-in shelving, closets, and entertainment centers designed for your home.</p>

<h3>Deck & Pergola Construction</h3>
<p>Outdoor living spaces including custom decks, pergolas, and privacy screens built to last.</p>

<h3>Door & Trim Work</h3>
<p>Custom doors, window trim, and finish carpentry to add character to your home.</p>

<h3>Our Process</h3>

<ol>
<li><strong>Consultation</strong> - We discuss your vision and needs</li>
<li><strong>Design</strong> - Create detailed plans and material selections</li>
<li><strong>Build</strong> - Expert craftsmanship with attention to detail</li>
<li><strong>Install</strong> - Professional installation and finishing</li>
</ol>

<p><a href="/contact">Contact us to discuss your project</a></p>';

  $services->set('body', [
    'value' => $clean_services,
    'format' => 'full_html',
  ]);
  $services->save();
  echo "✓ Services page cleaned up\n";
}

// Clean up Contact page - remove AI elements
$contact = Node::load(5);
if ($contact) {
  $clean_contact = '<h2>Get in Touch</h2>

<p>Ready to start your project? Contact us for a consultation.</p>

<h3>Contact Information</h3>

<p><strong>Phone:</strong> (555) 123-4567<br>
<strong>Email:</strong> leo@leoscarpentry.com<br>
<strong>Location:</strong> Serving the greater metropolitan area</p>

<h3>Business Hours</h3>

<p>Monday - Friday: 8:00 AM - 5:00 PM<br>
Saturday: 9:00 AM - 2:00 PM<br>
Sunday: Closed</p>

<h3>Request a Quote</h3>

<p>Use our <a href="/contact">contact form</a> to send us details about your project, and we\'ll get back to you within 24 hours.</p>

<h3>Frequently Asked Questions</h3>

<p><strong>Do you provide free estimates?</strong><br>
Yes, we offer free consultations and estimates for all projects.</p>

<p><strong>What types of wood do you work with?</strong><br>
We work with a variety of hardwoods and softwoods including oak, maple, cherry, walnut, and pine.</p>

<p><strong>How long does a typical project take?</strong><br>
Project timelines vary depending on scope and complexity. We\'ll provide a detailed timeline during your consultation.</p>

<p><strong>Do you handle permits and inspections?</strong><br>
Yes, we manage all necessary permits and ensure all work meets local building codes.</p>';

  $contact->set('body', [
    'value' => $clean_contact,
    'format' => 'full_html',
  ]);
  $contact->save();
  echo "✓ Contact page cleaned up\n";
}

echo "\n✓ All pages updated with clean, natural design!\n";
