# Leo's Carpentry & Designs - Drupal Site
## Project Structure and Configuration Documentation

---

## Overview

This is a fully functional Drupal 10 website for **Leo's Carpentry & Designs**, a small business portfolio site showcasing carpentry services, project portfolio, blog, and contact information.

**Site URL**: http://drupal.local:8080  
**Admin Login**: admin / admin123  
**Database**: drupal_leos (MariaDB)

---

## Directory Structure

```
/Users/mikendlovu/Documents/Drupal Project/drupal-site/
├── composer.json                    # Composer dependencies
├── composer.lock                    # Locked dependency versions
├── vendor/                          # Composer packages (Drupal core, modules, libraries)
│   ├── bin/                         # Executable scripts (drush, etc.)
│   └── drupal/                      # Drupal core packages
├── web/                             # Web root (nginx points here)
│   ├── index.php                    # Drupal front controller
│   ├── autoload.php                 # Composer autoloader
│   ├── core/                        # Drupal core files
│   ├── modules/                     # Custom and contributed modules
│   ├── themes/                      # Custom and contributed themes
│   ├── sites/                       # Site-specific files
│   │   ├── default/
│   │   │   ├── settings.php         # Drupal database and config settings
│   │   │   └── files/               # User-uploaded files (writable)
│   └── profiles/                    # Installation profiles
├── nginx-drupal.conf                # Nginx server block configuration (SOURCE)
├── setup-database.sql               # Database creation script
├── setup-site-structure.sh          # Site structure setup script
└── php-fpm-config-notes.ini         # PHP-FPM configuration documentation
```

---

## Configuration Files

### 1. Nginx Configuration
**File**: `/opt/homebrew/etc/nginx/servers/drupal.conf`  
**Source**: `nginx-drupal.conf` (in project root)

**Key Settings**:
- Server name: `drupal.local`
- Listen port: `8080` (unprivileged port)
- Document root: `/Users/mikendlovu/Documents/Drupal Project/drupal-site/web`
- PHP-FPM socket: `/opt/homebrew/var/run/php-fpm.sock`
- Logs: `/opt/homebrew/var/log/nginx/drupal.local.{access,error}.log`

**Why every directive exists**:
- **try_files**: Enables Drupal's clean URLs and routing system
- **fastcgi_pass**: Connects to PHP-FPM via Unix socket (faster than TCP)
- **Security blocks**: Prevent access to sensitive files (.git, vendor/, composer.json)
- **Gzip compression**: Reduces bandwidth and improves load times
- **Static file caching**: Browsers cache CSS/JS/images for 30 days

**What breaks if changed**:
- Wrong `root` path → 404 errors on all pages
- Missing `try_files` → Clean URLs don't work, /admin returns 404
- Wrong `fastcgi_pass` → 502 Bad Gateway errors
- Missing security blocks → Sensitive files exposed to public

### 2. PHP-FPM Configuration
**File**: `/opt/homebrew/etc/php/8.5/php-fpm.d/www.conf`  
**Documentation**: `php-fpm-config-notes.ini`

**Key Changes**:
- `listen = /opt/homebrew/var/run/php-fpm.sock` (Unix socket instead of TCP)
- `listen.owner = mikendlovu` (matches nginx user)
- `listen.group = staff` (matches nginx group)
- `listen.mode = 0666` (allows nginx to connect)

**Why these settings**:
- Unix sockets are 15% faster than TCP for local connections
- Proper permissions prevent "502 Bad Gateway" errors
- Dynamic process manager adapts to traffic load

**What breaks if changed**:
- Wrong socket path → nginx can't connect to PHP-FPM (502 error)
- Wrong permissions → "Permission denied" errors
- `pm.max_children` too low → site becomes slow under load
- `pm.max_children` too high → server runs out of memory

### 3. Database Configuration
**Database**: `drupal_leos`  
**User**: `drupal_user`  
**Password**: `drupal_pass_2026`  
**Setup Script**: `setup-database.sql`

**Character Set**: utf8mb4 (supports all Unicode including emojis)  
**Collation**: utf8mb4_unicode_ci (case-insensitive)

**Why utf8mb4**:
- Supports all Unicode characters including emojis
- Required for proper internationalization
- Drupal 9+ recommendation

### 4. Drupal Settings
**File**: `web/sites/default/settings.php` (auto-generated during installation)

**Database Connection**:
```php
$databases['default']['default'] = [
  'database' => 'drupal_leos',
  'username' => 'drupal_user',
  'password' => 'drupal_pass_2026',
  'host' => 'localhost',
  'driver' => 'mysql',
];
```

### 5. Hosts File
**File**: `/etc/hosts`  
**Entry**: `127.0.0.1 drupal.local`

**Why needed**: Resolves drupal.local to localhost for browser access

---

## Site Features

### Content Types

#### 1. **Page** (built-in)
Basic pages for static content.

**Created Pages**:
- **Home** (node/1) - Welcome page, set as front page
- **Services** (node/2) - List of carpentry services
- **Portfolio** (node/3) - Portfolio overview
- **Blog** (node/4) - Blog overview
- **Contact** (node/5) - Contact information

#### 2. **Article** (built-in)
Blog posts with tags and categories.

**Sample Articles**:
- "5 Tips for Maintaining Wood Furniture"
- "Choosing the Right Wood for Your Project"

#### 3. **Portfolio Item** (custom)
Showcases completed carpentry projects.

**Custom Fields**:
- `field_portfolio_images` (Image, multiple) - Project photos
- `field_project_description` (Text Long) - Detailed description
- `field_project_date` (Date) - Completion date

**Sample Portfolio Items**:
- "Custom Kitchen Renovation"
- "Handcrafted Dining Table"
- "Built-In Entertainment Center"

### Navigation Menu

**Main Menu** (displays in site header):
1. Home → /node/1
2. Services → /node/2
3. Portfolio → /node/3
4. Blog → /node/4
5. Contact → /node/5

### Roles and Permissions

#### Administrator (built-in)
Full site access, all permissions.

#### Editor (custom role)
**Permissions**:
- Create/edit/delete own Articles
- Create/edit/delete own Portfolio Items
- Create/edit own Pages
- Access content overview
- View own unpublished content

**Use case**: Staff members who create blog posts and add portfolio items

#### Authenticated User
**Permissions**:
- Access site-wide contact form
- Post comments on content

**Use case**: Registered site visitors

---

## Service Management

### Starting Services

```bash
# Start all services
brew services start nginx
brew services start php
brew services start mariadb

# Check service status
brew services list
```

### Restarting Services

```bash
# After config changes
brew services restart nginx
brew services restart php

# Or reload nginx without restart
sudo nginx -s reload
```

### Stopping Services

```bash
brew services stop nginx
brew services stop php
brew services stop mariadb
```

---

## Common Tasks

### Accessing the Site

**Frontend**: http://drupal.local:8080  
**Admin Panel**: http://drupal.local:8080/admin  
**Login**: http://drupal.local:8080/user/login

**Admin Credentials**:
- Username: `admin`
- Password: `admin123`

### Generate One-Time Login Link

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
vendor/bin/drush uli --uri=http://drupal.local:8080
```

### Clear Cache

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
vendor/bin/drush cache:rebuild
# Or shorter: vendor/bin/drush cr
```

### Database Backup

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
vendor/bin/drush sql:dump > backup-$(date +%Y%m%d).sql
```

### Database Restore

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
vendor/bin/drush sql:cli < backup-20260130.sql
```

### Install New Module

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
composer require drupal/module_name
vendor/bin/drush pm:install module_name -y
vendor/bin/drush cr
```

### Update Drupal Core

```bash
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site"
composer update drupal/core --with-all-dependencies
vendor/bin/drush updatedb -y
vendor/bin/drush cr
```

---

## Troubleshooting

### 502 Bad Gateway

**Cause**: nginx can't connect to PHP-FPM

**Solutions**:
1. Check PHP-FPM is running: `brew services list | grep php`
2. Verify socket exists: `ls -la /opt/homebrew/var/run/php-fpm.sock`
3. Check socket permissions: should be `rw-rw-rw-`
4. Check PHP-FPM log: `tail -f /opt/homebrew/var/log/php-fpm.log`
5. Restart PHP-FPM: `brew services restart php`

### 404 Not Found

**Cause**: nginx can't find files or routing is broken

**Solutions**:
1. Verify document root: `cat /opt/homebrew/etc/nginx/servers/drupal.conf | grep root`
2. Check file exists: `ls -la "/Users/mikendlovu/Documents/Drupal Project/drupal-site/web/index.php"`
3. Verify try_files directive in nginx config
4. Check nginx error log: `tail -f /opt/homebrew/var/log/nginx/drupal.local.error.log`

### White Screen of Death (WSOD)

**Cause**: PHP error or memory limit

**Solutions**:
1. Check PHP error log: `tail -f /opt/homebrew/var/log/php-fpm.log`
2. Increase memory limit: Edit `/opt/homebrew/etc/php/8.5/php.ini`, set `memory_limit = 512M`
3. Enable error display: `vendor/bin/drush config:set system.logging error_level verbose -y`
4. Clear cache: `vendor/bin/drush cr`

### Clean URLs Not Working

**Cause**: .htaccess not working or try_files misconfigured

**Solution**: nginx doesn't use .htaccess. Check that nginx config has:
```nginx
try_files $uri $uri/ /index.php?$query_string;
```

### Database Connection Error

**Cause**: Wrong credentials or database not running

**Solutions**:
1. Check MariaDB is running: `brew services list | grep mariadb`
2. Test connection: `mysql -u drupal_user -p'drupal_pass_2026' drupal_leos -e "SELECT 1"`
3. Verify settings.php has correct credentials
4. Check database exists: `sudo mysql -e "SHOW DATABASES"`

### File Upload Fails

**Cause**: Directory not writable or size limits

**Solutions**:
1. Check directory permissions: `ls -la web/sites/default/files`
2. Make writable: `chmod 777 web/sites/default/files`
3. Check PHP limits in `/opt/homebrew/etc/php/8.5/php.ini`:
   - `upload_max_filesize = 100M`
   - `post_max_size = 100M`
4. Check nginx limit in config: `client_max_body_size 100M`

---

## Performance Optimization

### Enable OPcache

Edit `/opt/homebrew/etc/php/8.5/php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0  # Production only
```

Restart PHP: `brew services restart php`

### Enable Drupal Caching

```bash
vendor/bin/drush config:set system.performance cache.page.max_age 3600 -y
vendor/bin/drush config:set system.performance css.preprocess 1 -y
vendor/bin/drush config:set system.performance js.preprocess 1 -y
vendor/bin/drush cr
```

### Use Redis for Cache (Advanced)

```bash
composer require drupal/redis
brew install redis
brew services start redis
vendor/bin/drush pm:install redis -y
```

Add to `web/sites/default/settings.php`:
```php
$settings['redis.connection']['interface'] = 'PhpRedis';
$settings['redis.connection']['host'] = '127.0.0.1';
$settings['cache']['default'] = 'cache.backend.redis';
```

---

## Security Hardening

### Production Checklist

1. **Change admin password**: Use strong password (20+ chars)
2. **Update settings.php permissions**: `chmod 444 web/sites/default/settings.php`
3. **Disable error display**: `vendor/bin/drush config:set system.logging error_level hide -y`
4. **Enable HTTPS**: Add SSL certificate and update nginx config
5. **Install security updates**: Regularly run `composer update` and `drush updatedb`
6. **Block /user/register**: If not allowing public registration
7. **Install Security Review module**: `composer require drupal/security_review`
8. **Limit login attempts**: Install Flood Control module

### Recommended Security Modules

```bash
composer require drupal/captcha drupal/recaptcha drupal/security_review
vendor/bin/drush pm:install captcha recaptcha security_review -y
```

---

## Replication Instructions

To replicate this setup on another Mac:

1. **Install Homebrew packages**:
   ```bash
   brew install nginx mariadb php
   ```

2. **Copy project directory**:
   ```bash
   cp -R "/Users/mikendlovu/Documents/Drupal Project/drupal-site" /path/to/new/location
   ```

3. **Update paths in nginx config**:
   - Edit `nginx-drupal.conf`
   - Change `root` path to new location
   - Copy to `/opt/homebrew/etc/nginx/servers/drupal.conf`

4. **Configure PHP-FPM**: Follow instructions in `php-fpm-config-notes.ini`

5. **Create database**:
   ```bash
   sudo mysql < setup-database.sql
   ```

6. **Update /etc/hosts**:
   ```bash
   echo "127.0.0.1 drupal.local" | sudo tee -a /etc/hosts
   ```

7. **Set permissions**:
   ```bash
   chmod -R 755 web/
   chmod -R 777 web/sites/default/files/
   ```

8. **Start services**:
   ```bash
   brew services start nginx php mariadb
   ```

9. **Test**: Visit http://drupal.local:8080

---

## Maintenance Notes for Future Developers

### Code Quality
- Always test changes on a dev copy before applying to live site
- Use `vendor/bin/drush config:export` to export configuration changes
- Keep `composer.lock` in version control
- Never edit core files; use hooks and modules instead

### Backup Strategy
- Daily database backups: `drush sql:dump`
- Weekly full site backups including `web/sites/default/files/`
- Store backups off-server
- Test restore process quarterly

### Update Workflow
1. Backup database and files
2. `composer update --dry-run` (preview updates)
3. `composer update drupal/core --with-all-dependencies`
4. `vendor/bin/drush updatedb -y` (run database updates)
5. `vendor/bin/drush cr` (clear cache)
6. Test all critical functionality
7. If issues: restore backup and investigate

### Monitoring
- Watch error logs: `tail -f /opt/homebrew/var/log/nginx/drupal.local.error.log`
- Check PHP logs: `tail -f /opt/homebrew/var/log/php-fpm.log`
- Review Drupal logs: Admin → Reports → Recent log messages
- Set up cron: `vendor/bin/drush cron` (or system cron job)

---

## Support Resources

- **Drupal Documentation**: https://www.drupal.org/docs
- **Drush Documentation**: https://www.drush.org/
- **Nginx Docs**: https://nginx.org/en/docs/
- **PHP-FPM Docs**: https://www.php.net/manual/en/install.fpm.php
- **Drupal Stack Exchange**: https://drupal.stackexchange.com/

---

**Site Built**: January 30, 2026  
**Drupal Version**: 10.x  
**PHP Version**: 8.5.2  
**Database**: MariaDB  
**Web Server**: nginx 1.29.4

---

## Quick Reference Commands

```bash
# Start all services
brew services start nginx php mariadb

# Restart nginx after config change
brew services restart nginx

# Clear Drupal cache
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site" && vendor/bin/drush cr

# Generate admin login link
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site" && vendor/bin/drush uli --uri=http://drupal.local:8080

# View logs
tail -f /opt/homebrew/var/log/nginx/drupal.local.error.log
tail -f /opt/homebrew/var/log/php-fpm.log

# Test nginx config
sudo nginx -t

# Backup database
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site" && vendor/bin/drush sql:dump > backup.sql

# Update Drupal
cd "/Users/mikendlovu/Documents/Drupal Project/drupal-site" && composer update drupal/core --with-all-dependencies && vendor/bin/drush updatedb -y && vendor/bin/drush cr
```
