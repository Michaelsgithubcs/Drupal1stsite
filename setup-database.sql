-- Database setup for Leo's Carpentry & Designs Drupal site
-- This script creates the database and user with appropriate permissions

-- Create the database
-- Character set utf8mb4 supports all Unicode characters including emojis
-- Collation utf8mb4_unicode_ci provides case-insensitive comparisons
-- This is the recommended setup for Drupal 9/10
CREATE DATABASE IF NOT EXISTS drupal_leos
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Create dedicated database user for Drupal
-- Using a dedicated user instead of root follows security best practices
-- Password should be changed in production environments
CREATE USER IF NOT EXISTS 'drupal_user'@'localhost' 
  IDENTIFIED BY 'drupal_pass_2026';

-- Grant all privileges on the Drupal database to the user
-- Drupal needs full control to create/modify tables and data
-- GRANT OPTION allows the user to grant privileges to other users (not needed, but included)
GRANT ALL PRIVILEGES ON drupal_leos.* 
  TO 'drupal_user'@'localhost';

-- Apply the privilege changes immediately
-- Without this, changes won't take effect until MySQL restarts
FLUSH PRIVILEGES;

-- Verify the database was created
SELECT SCHEMA_NAME, DEFAULT_CHARACTER_SET_NAME, DEFAULT_COLLATION_NAME
FROM information_schema.SCHEMATA
WHERE SCHEMA_NAME = 'drupal_leos';

-- Show the user privileges (for verification)
SHOW GRANTS FOR 'drupal_user'@'localhost';
