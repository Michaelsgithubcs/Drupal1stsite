<?php

echo "Configuring CAPTCHA for contact form...\n\n";

// Enable CAPTCHA on contact form
$config = \Drupal::configFactory()->getEditable('captcha.captcha_point.contact_message_feedback_form');
$config->set('formId', 'contact_message_feedback_form');
$config->set('captchaType', 'captcha/Math');
$config->set('label', 'Contact form');
$config->save();
echo "✓ Added Math CAPTCHA to contact form\n";

// Configure CAPTCHA settings
$captcha_config = \Drupal::configFactory()->getEditable('captcha.settings');
$captcha_config->set('default_challenge', 'captcha/Math');
$captcha_config->set('persistence', 1);
$captcha_config->set('add_captcha_description', TRUE);
$captcha_config->save();
echo "✓ Configured CAPTCHA settings\n";

echo "\n✓ CAPTCHA protection enabled!\n";
echo "Contact form now has:\n";
echo "  - Simple math question (e.g., '3 + 5 = ?')\n";
echo "  - Prevents spam bot submissions\n";
echo "  - User-friendly (no external services needed)\n";
