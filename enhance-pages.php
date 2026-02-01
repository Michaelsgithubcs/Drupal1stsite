<?php

// Update Home page with enhanced content
$node_storage = \Drupal::entityTypeManager()->getStorage('node');
$node = $node_storage->load(1); // Home page

if ($node) {
  $node->set('body', [
    'value' => '<div style="text-align: center; margin: 40px 0;">
  <h1 style="font-size: 3em; color: #8B4513; margin-bottom: 20px;">Welcome to Leo\'s Carpentry & Designs</h1>
  <p style="font-size: 1.5em; color: #666; margin-bottom: 40px;">Expert Craftsmanship Since 2010</p>
</div>

<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
  <div style="background: #f9f9f9; padding: 40px; border-radius: 10px; margin-bottom: 30px;">
    <h2 style="color: #8B4513; text-align: center; margin-bottom: 30px;">Transform Your Space with Custom Woodwork</h2>
    <p style="font-size: 1.2em; line-height: 1.8; text-align: center;">
      We are a premier carpentry and woodworking company specializing in custom furniture, cabinetry, and home renovations. 
      With over 15 years of experience, we bring craftsmanship, attention to detail, and passion to every project.
    </p>
  </div>

  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin: 50px 0;">
    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <h3 style="color: #8B4513; margin-bottom: 15px;">🔨 Custom Cabinetry</h3>
      <p>Beautiful, functional cabinets designed and built to your exact specifications for kitchens, bathrooms, and any room in your home.</p>
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <h3 style="color: #8B4513; margin-bottom: 15px;">🪑 Custom Furniture</h3>
      <p>Handcrafted tables, chairs, shelving, and more. Each piece is unique and built to last for generations.</p>
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <h3 style="color: #8B4513; margin-bottom: 15px;">🏠 Home Renovations</h3>
      <p>Complete or partial renovations including trim work, built-ins, and architectural details that add character to your space.</p>
    </div>
  </div>

  <div style="background: #8B4513; color: white; padding: 50px; border-radius: 10px; text-align: center; margin: 50px 0;">
    <h2 style="color: white; margin-bottom: 30px;">Why Choose Leo\'s Carpentry?</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 30px;">
      <div>
        <h3 style="color: #FFD700; margin-bottom: 10px;">✓ Expert Craftsmanship</h3>
        <p>15+ years of professional woodworking experience</p>
      </div>
      <div>
        <h3 style="color: #FFD700; margin-bottom: 10px;">✓ Custom Designs</h3>
        <p>Tailored solutions to match your unique vision</p>
      </div>
      <div>
        <h3 style="color: #FFD700; margin-bottom: 10px;">✓ Quality Materials</h3>
        <p>Premium woods and sustainable practices</p>
      </div>
      <div>
        <h3 style="color: #FFD700; margin-bottom: 10px;">✓ On-Time Delivery</h3>
        <p>Reliable service and competitive pricing</p>
      </div>
    </div>
  </div>

  <div style="text-align: center; margin: 60px 0;">
    <h2 style="color: #8B4513; margin-bottom: 20px;">Recent Projects</h2>
    <p style="font-size: 1.2em; margin-bottom: 30px;">See examples of our craftsmanship and attention to detail</p>
    <a href="/portfolio-gallery" style="display: inline-block; background: #8B4513; color: white; padding: 15px 40px; text-decoration: none; border-radius: 5px; font-size: 1.2em; font-weight: bold;">View Our Portfolio</a>
  </div>

  <div style="background: #f0f0f0; padding: 50px; border-radius: 10px; margin: 50px 0;">
    <h2 style="color: #8B4513; text-align: center; margin-bottom: 30px;">Latest Tips & Updates</h2>
    <p style="text-align: center; font-size: 1.1em; margin-bottom: 20px;">
      Check out our blog for woodworking tips, project updates, and industry insights
    </p>
    <div style="text-align: center;">
      <a href="/blog-posts" style="display: inline-block; background: #555; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">Read Our Blog</a>
    </div>
  </div>

  <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px; border-radius: 10px; text-align: center; margin: 50px 0;">
    <h2 style="color: white; font-size: 2.5em; margin-bottom: 20px;">Ready to Start Your Project?</h2>
    <p style="font-size: 1.3em; margin-bottom: 30px;">Let\'s bring your vision to life with expert craftsmanship</p>
    <a href="/contact" style="display: inline-block; background: white; color: #667eea; padding: 20px 50px; text-decoration: none; border-radius: 5px; font-size: 1.3em; font-weight: bold; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">Get a Free Consultation</a>
    <p style="margin-top: 30px; font-size: 1.1em;">
      📞 (555) 123-4567 | 📧 info@leos-carpentry.local<br>
      🕐 Monday-Friday 8am-5pm
    </p>
  </div>
</div>',
    'format' => 'full_html',
  ]);
  
  $node->save();
  echo "✓ Home page updated with enhanced design\n";
}

// Update Services page
$node = $node_storage->load(2);
if ($node) {
  $node->set('body', [
    'value' => '<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
  <div style="text-align: center; margin: 40px 0;">
    <h1 style="font-size: 3em; color: #8B4513;">Our Services</h1>
    <p style="font-size: 1.3em; color: #666;">Comprehensive carpentry solutions for your home or business</p>
  </div>

  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 40px; margin: 50px 0;">
    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px; transition: transform 0.3s;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🏺 Custom Cabinetry</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Beautiful, functional cabinets for kitchens, bathrooms, and any room in your home. We design and build to your exact specifications with premium materials and expert craftsmanship.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Kitchen cabinets & islands</li>
        <li>Bathroom vanities</li>
        <li>Custom storage solutions</li>
        <li>Built-in entertainment centers</li>
      </ul>
    </div>

    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🪑 Custom Furniture</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Handcrafted tables, chairs, shelving, and more. Each piece is unique and built to last generations with traditional joinery and premium hardwoods.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Dining & coffee tables</li>
        <li>Bookcases & shelving</li>
        <li>Bed frames & headboards</li>
        <li>Desks & office furniture</li>
      </ul>
    </div>

    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🏠 Home Renovations</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Complete or partial home renovations including trim work, built-ins, and architectural details that add character and value to your space.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Crown molding & trim</li>
        <li>Wainscoting & paneling</li>
        <li>Custom doors & frames</li>
        <li>Built-in shelving</li>
      </ul>
    </div>

    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🏢 Commercial Projects</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Professional carpentry for commercial spaces including retail fixtures, office furniture, and restaurant buildouts.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Retail display fixtures</li>
        <li>Reception desks</li>
        <li>Restaurant seating</li>
        <li>Office built-ins</li>
      </ul>
    </div>

    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🛠️ Repairs & Restoration</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Expert repair and restoration of antique furniture and damaged woodwork. We can bring new life to your cherished pieces.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Antique furniture restoration</li>
        <li>Wood repair & refinishing</li>
        <li>Structural repairs</li>
        <li>Custom matching</li>
      </ul>
    </div>

    <div style="background: white; border: 3px solid #8B4513; border-radius: 10px; padding: 30px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">🌲 Outdoor Carpentry</h2>
      <p style="line-height: 1.8; margin-bottom: 15px;">
        Durable outdoor structures built to withstand the elements while enhancing your outdoor living space.
      </p>
      <ul style="line-height: 2; color: #555;">
        <li>Decks & pergolas</li>
        <li>Fences & gates</li>
        <li>Outdoor furniture</li>
        <li>Gazebos & arbors</li>
      </ul>
    </div>
  </div>

  <div style="background: #8B4513; color: white; padding: 50px; border-radius: 10px; text-align: center; margin: 50px 0;">
    <h2 style="color: white; font-size: 2em; margin-bottom: 20px;">Our Process</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-top: 30px;">
      <div>
        <div style="font-size: 3em; margin-bottom: 10px;">1</div>
        <h3 style="color: #FFD700;">Consultation</h3>
        <p>Free in-home consultation to discuss your vision</p>
      </div>
      <div>
        <div style="font-size: 3em; margin-bottom: 10px;">2</div>
        <h3 style="color: #FFD700;">Design</h3>
        <p>Custom design and detailed quote</p>
      </div>
      <div>
        <div style="font-size: 3em; margin-bottom: 10px;">3</div>
        <h3 style="color: #FFD700;">Build</h3>
        <p>Expert craftsmanship in our workshop</p>
      </div>
      <div>
        <div style="font-size: 3em; margin-bottom: 10px;">4</div>
        <h3 style="color: #FFD700;">Install</h3>
        <p>Professional installation and finishing</p>
      </div>
    </div>
  </div>

  <div style="text-align: center; margin: 60px 0;">
    <h2 style="color: #8B4513; font-size: 2.5em; margin-bottom: 20px;">Interested in Our Services?</h2>
    <p style="font-size: 1.2em; margin-bottom: 30px;">Get in touch to discuss your project and receive a free quote</p>
    <a href="/contact" style="display: inline-block; background: #8B4513; color: white; padding: 20px 50px; text-decoration: none; border-radius: 5px; font-size: 1.3em; font-weight: bold;">Contact Us Today</a>
  </div>
</div>',
    'format' => 'full_html',
  ]);
  $node->save();
  echo "✓ Services page updated with enhanced design\n";
}

// Update Contact page
$node = $node_storage->load(5);
if ($node) {
  $node->set('body', [
    'value' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;">
  <div style="text-align: center; margin: 40px 0;">
    <h1 style="font-size: 3em; color: #8B4513;">Get In Touch</h1>
    <p style="font-size: 1.3em; color: #666;">Ready to start your project? We\'d love to hear from you!</p>
  </div>

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin: 50px 0;">
    <div style="background: #f9f9f9; padding: 40px; border-radius: 10px;">
      <h2 style="color: #8B4513; margin-bottom: 30px;">Contact Information</h2>
      
      <div style="margin-bottom: 25px;">
        <h3 style="color: #666; margin-bottom: 10px;">📞 Phone</h3>
        <p style="font-size: 1.3em; color: #8B4513; font-weight: bold;">(555) 123-4567</p>
      </div>
      
      <div style="margin-bottom: 25px;">
        <h3 style="color: #666; margin-bottom: 10px;">📧 Email</h3>
        <p style="font-size: 1.2em; color: #8B4513;">info@leos-carpentry.local</p>
      </div>
      
      <div style="margin-bottom: 25px;">
        <h3 style="color: #666; margin-bottom: 10px;">🕐 Business Hours</h3>
        <p><strong>Monday - Friday:</strong> 8:00 AM - 5:00 PM</p>
        <p><strong>Saturday:</strong> 9:00 AM - 2:00 PM</p>
        <p><strong>Sunday:</strong> Closed</p>
      </div>
      
      <div style="margin-bottom: 25px;">
        <h3 style="color: #666; margin-bottom: 10px;">📍 Service Area</h3>
        <p>We proudly serve the greater metropolitan area and surrounding counties within 50 miles.</p>
      </div>
    </div>

    <div style="background: white; padding: 40px; border: 3px solid #8B4513; border-radius: 10px;">
      <h2 style="color: #8B4513; margin-bottom: 20px;">Send Us a Message</h2>
      <p style="margin-bottom: 30px; color: #666;">Fill out the contact form and we\'ll get back to you within 24 hours.</p>
      
      <div style="background: #f0f0f0; padding: 30px; border-radius: 5px; text-align: center;">
        <p style="font-size: 1.1em; margin-bottom: 20px;">Use the site-wide contact form to send us a message, or give us a call during business hours.</p>
        <a href="/contact" style="display: inline-block; background: #8B4513; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">Go to Contact Form</a>
      </div>
    </div>
  </div>

  <div style="background: linear-gradient(135deg, #8B4513 0%, #654321 100%); color: white; padding: 50px; border-radius: 10px; text-align: center; margin: 50px 0;">
    <h2 style="color: white; font-size: 2em; margin-bottom: 20px;">Why Choose Us?</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-top: 30px;">
      <div>
        <div style="font-size: 2em; margin-bottom: 10px;">✓</div>
        <h3>Free Consultations</h3>
        <p>No-obligation quotes</p>
      </div>
      <div>
        <div style="font-size: 2em; margin-bottom: 10px;">✓</div>
        <h3>Licensed & Insured</h3>
        <p>Fully certified professionals</p>
      </div>
      <div>
        <div style="font-size: 2em; margin-bottom: 10px;">✓</div>
        <h3>Quality Guarantee</h3>
        <p>100% satisfaction pledge</p>
      </div>
      <div>
        <div style="font-size: 2em; margin-bottom: 10px;">✓</div>
        <h3>Local Business</h3>
        <p>Serving our community</p>
      </div>
    </div>
  </div>

  <div style="background: #f9f9f9; padding: 40px; border-radius: 10px; margin-top: 50px;">
    <h2 style="color: #8B4513; text-align: center; margin-bottom: 30px;">Frequently Asked Questions</h2>
    
    <div style="margin-bottom: 25px;">
      <h3 style="color: #8B4513;">Do you offer free estimates?</h3>
      <p>Yes! We provide free, no-obligation consultations and estimates for all projects.</p>
    </div>
    
    <div style="margin-bottom: 25px;">
      <h3 style="color: #8B4513;">What is your typical project timeline?</h3>
      <p>Timelines vary based on project complexity. Simple projects may take 1-2 weeks, while larger custom builds can take 4-8 weeks. We\'ll provide a detailed timeline during your consultation.</p>
    </div>
    
    <div style="margin-bottom: 25px;">
      <h3 style="color: #8B4513;">Do you provide a warranty?</h3>
      <p>Yes, all our work comes with a craftsmanship warranty. We stand behind our quality and will address any issues promptly.</p>
    </div>
    
    <div style="margin-bottom: 25px;">
      <h3 style="color: #8B4513;">Can you work with my existing design?</h3>
      <p>Absolutely! We can work from your designs, architect plans, or collaborate with you to create something completely custom.</p>
    </div>
  </div>
</div>',
    'format' => 'full_html',
  ]);
  $node->save();
  echo "✓ Contact page updated with enhanced design\n";
}

echo "\n✓✓✓ All pages enhanced successfully! ✓✓✓\n";
