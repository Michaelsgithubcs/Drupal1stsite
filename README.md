# Drupal Site Development

This is a custom Drupal site with custom content types, fields, and theming.

## Custom Development

### Custom Module: Blog Content
Location: `web/modules/custom/blog_content`

This module provides a custom "Blog Post" content type with the following custom fields:
- **Author Bio** (`field_author_bio`): Text area for author biography
- **Featured Image** (`field_featured_image`): Image field for blog post featured images
- **Tags** (`field_tags`): Taxonomy reference field for categorization

The module includes complete configuration for:
- Content type definition
- Field storage and instances
- Form display configuration
- View display configuration
- Tags vocabulary

### Custom Theme: Custom Blog Theme
Location: `web/themes/custom/custom_blog_theme`

A custom theme with Twig templates specifically designed for the blog:
- `node--blog-post.html.twig`: Custom template for blog post nodes with featured image, author bio, and tags
- `field--field-tags.html.twig`: Custom template for rendering tags
- `page.html.twig`: Custom page layout template
- Custom CSS styling for blog posts
- JavaScript enhancements (reading time calculation)

#### Twig Templates Features
- Structured semantic HTML5 markup
- Conditional rendering of fields
- Custom CSS classes for styling
- Responsive design support
- Author metadata display
- Featured image handling
- Tag display with custom styling

## Installation

1. Install dependencies:
```bash
composer install
```

2. Enable the custom module:
```bash
drush en blog_content
```

3. Enable the custom theme:
```bash
drush theme:enable custom_blog_theme
drush config-set system.theme default custom_blog_theme
```

4. Clear cache:
```bash
drush cr
```

## Creating Blog Posts

Navigate to `/node/add/blog_post` to create new blog posts. The form includes:
- Title
- Featured Image (with alt text)
- Body content with summary
- Author Bio
- Tags (autocomplete, new tags created automatically)
- URL alias
- Publishing options

## Version Control

This project uses Git for version control. Custom modules and themes are tracked while core and contributed modules are managed via Composer.

### What's Tracked:
- Custom modules (`web/modules/custom/`)
- Custom themes (`web/themes/custom/`)
- Configuration files
- composer.json and composer.lock
- Database setup scripts
- Documentation

### What's Ignored:
- Drupal core (`web/core/`)
- Vendor directory (`vendor/`)
- Contributed modules and themes
- User-uploaded files
- Settings files with sensitive data

## Development Workflow

1. Make changes to custom code
2. Export configuration: `drush config:export`
3. Commit changes to git
4. Push to remote repository

## Requirements

- PHP 8.1 or higher
- Composer
- Drupal 10 or 11
- MySQL/MariaDB

## License

See LICENSE.txt for license information.
