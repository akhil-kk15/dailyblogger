#!/bin/bash

# Laravel Daily Blogger - University Submission Compression Script
# This script creates a compressed version under 20MB by excluding unnecessary files

set -e  # Exit on any error

echo "Laravel Daily Blogger - University Submission Compression"
echo "=========================================================="

# Define source and target directories
SOURCE_DIR="/home/akhilkk/Desktop/dailyblogger"
TARGET_DIR="/home/akhilkk/Desktop/dailyblogger_university_submission"
ARCHIVE_NAME="dailyblogger_university_submission.tar.gz"

# Remove existing target directory if it exists
if [ -d "$TARGET_DIR" ]; then
    echo "Removing existing submission directory..."
    rm -rf "$TARGET_DIR"
fi

# Create target directory
echo "Creating submission directory..."
mkdir -p "$TARGET_DIR"

# Copy essential Laravel files and directories
echo "Copying essential Laravel application files..."

# Core application directories
cp -r "$SOURCE_DIR/app" "$TARGET_DIR/"
cp -r "$SOURCE_DIR/bootstrap" "$TARGET_DIR/"
cp -r "$SOURCE_DIR/config" "$TARGET_DIR/"
cp -r "$SOURCE_DIR/database" "$TARGET_DIR/"
cp -r "$SOURCE_DIR/resources" "$TARGET_DIR/"
cp -r "$SOURCE_DIR/routes" "$TARGET_DIR/"

# Essential public files (excluding large compiled assets)
echo "Copying essential public files..."
mkdir -p "$TARGET_DIR/public"
cp "$SOURCE_DIR/public/index.php" "$TARGET_DIR/public/"
cp "$SOURCE_DIR/public/.htaccess" "$TARGET_DIR/public/" 2>/dev/null || echo "No .htaccess found"
cp "$SOURCE_DIR/public/favicon.ico" "$TARGET_DIR/public/" 2>/dev/null || echo "No favicon found"
cp "$SOURCE_DIR/public/robots.txt" "$TARGET_DIR/public/" 2>/dev/null || echo "No robots.txt found"

# Copy essential public subdirectories (excluding build and large files)
if [ -d "$SOURCE_DIR/public/css" ]; then
    cp -r "$SOURCE_DIR/public/css" "$TARGET_DIR/public/" 2>/dev/null || echo "No CSS directory"
fi

if [ -d "$SOURCE_DIR/public/js" ]; then
    cp -r "$SOURCE_DIR/public/js" "$TARGET_DIR/public/" 2>/dev/null || echo "No JS directory"
fi

if [ -d "$SOURCE_DIR/public/images" ]; then
    echo "Copying images (small files only)..."
    mkdir -p "$TARGET_DIR/public/images"
    # Copy only small image files (under 500KB)
    find "$SOURCE_DIR/public/images" -type f -size -500k -exec cp {} "$TARGET_DIR/public/images/" \; 2>/dev/null || echo "No small images found"
fi

if [ -d "$SOURCE_DIR/public/admincss" ]; then
    cp -r "$SOURCE_DIR/public/admincss" "$TARGET_DIR/public/" 2>/dev/null || echo "No admincss directory"
fi

# Create postimage directory structure but only include 1-2 sample images
echo "Creating postimage directory with samples..."
mkdir -p "$TARGET_DIR/public/postimage"
# Copy only the first 2 small image files as samples
find "$SOURCE_DIR/public/postimage" -type f -size -200k | head -2 | while read file; do
    cp "$file" "$TARGET_DIR/public/postimage/" 2>/dev/null || true
done

# Storage directory (essential structure only)
echo "Creating storage directory structure..."
mkdir -p "$TARGET_DIR/storage/app/public"
mkdir -p "$TARGET_DIR/storage/framework/cache"
mkdir -p "$TARGET_DIR/storage/framework/sessions"
mkdir -p "$TARGET_DIR/storage/framework/testing"
mkdir -p "$TARGET_DIR/storage/framework/views"
mkdir -p "$TARGET_DIR/storage/logs"

# Copy essential root files
echo "Copying essential configuration files..."
cp "$SOURCE_DIR/artisan" "$TARGET_DIR/"
cp "$SOURCE_DIR/composer.json" "$TARGET_DIR/"
cp "$SOURCE_DIR/composer.lock" "$TARGET_DIR/"
cp "$SOURCE_DIR/package.json" "$TARGET_DIR/"
cp "$SOURCE_DIR/vite.config.js" "$TARGET_DIR/"
cp "$SOURCE_DIR/tailwind.config.js" "$TARGET_DIR/"
cp "$SOURCE_DIR/postcss.config.js" "$TARGET_DIR/"
cp "$SOURCE_DIR/phpunit.xml" "$TARGET_DIR/"

# Copy only the original README (not newredme.md)
if [ -f "$SOURCE_DIR/README.md" ]; then
    cp "$SOURCE_DIR/README.md" "$TARGET_DIR/"
fi

# Create essential .env.example
echo "Creating .env.example..."
cat > "$TARGET_DIR/.env.example" << 'EOF'
APP_NAME="Daily Blogger"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dailyblogger
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
CACHE_PREFIX=

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
EOF

# Create installation guide
echo "Creating installation guide..."
cat > "$TARGET_DIR/INSTALLATION.md" << 'EOF'
# Daily Blogger - Installation Guide

## Requirements
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/MariaDB

## Installation Steps

1. **Install PHP Dependencies**
   ```bash
   composer install
   ```

2. **Install Node Dependencies**
   ```bash
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**
   - Create database: `dailyblogger`
   - Update `.env` with your database credentials
   - Run migrations:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build Assets**
   ```bash
   npm run build
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Serve Application**
   ```bash
   php artisan serve
   ```

## Default Login Credentials
- Admin: admin@dailyblogger.com / password
- User: john@example.com / password

## Features Demonstrated
- MVC Architecture
- Database Relationships (3NF)
- Multi-role Authentication
- Password Hashing
- CRUD Operations
- AJAX Implementation
- File Upload System
- Localization (EN/FR/DE)
- Security (CSRF, XSS Protection)
- Clean URLs

## Technical Stack
- Laravel 11
- PHP 8.2+
- MySQL
- Tailwind CSS
- Vanilla JavaScript
- Blade Templates
EOF

# Copy tests directory (essential tests only, not the custom test files)
echo "Copying essential tests..."
if [ -d "$SOURCE_DIR/tests" ]; then
    cp -r "$SOURCE_DIR/tests" "$TARGET_DIR/"
fi

echo "Cleaning up unnecessary files from submission..."

# Remove specific test files and documentation
rm -f "$TARGET_DIR/test_"*.php 2>/dev/null || true
rm -f "$TARGET_DIR/newredme.md" 2>/dev/null || true
rm -f "$TARGET_DIR/SETUP_GUIDE.md" 2>/dev/null || true
rm -f "$TARGET_DIR/BLOCK_FUNCTIONALITY_COMPLETE.md" 2>/dev/null || true
rm -f "$TARGET_DIR/populate_search_data.php" 2>/dev/null || true
rm -f "$TARGET_DIR/migrate_blocked_users.php" 2>/dev/null || true
rm -f "$TARGET_DIR/compress_for_submission.sh" 2>/dev/null || true
rm -f "$TARGET_DIR/usertype" 2>/dev/null || true
rm -f "$TARGET_DIR/hpage _content.txt" 2>/dev/null || true
rm -rf "$TARGET_DIR/Fixing" 2>/dev/null || true

# Remove any backup route files
rm -f "$TARGET_DIR/routes/web_"*.php 2>/dev/null || true

# Clean storage directories of any existing content
find "$TARGET_DIR/storage/logs" -type f -delete 2>/dev/null || true
find "$TARGET_DIR/storage/framework/cache" -type f -delete 2>/dev/null || true
find "$TARGET_DIR/storage/framework/sessions" -type f -delete 2>/dev/null || true
find "$TARGET_DIR/storage/framework/views" -type f -delete 2>/dev/null || true

# Remove any hidden IDE/system files
find "$TARGET_DIR" -name ".DS_Store" -delete 2>/dev/null || true
find "$TARGET_DIR" -name "Thumbs.db" -delete 2>/dev/null || true
find "$TARGET_DIR" -name ".vscode" -type d -exec rm -rf {} \; 2>/dev/null || true
find "$TARGET_DIR" -name ".idea" -type d -exec rm -rf {} \; 2>/dev/null || true

echo "Creating compressed archive..."
cd "/home/akhilkk/Desktop"
tar -czf "$ARCHIVE_NAME" "$(basename $TARGET_DIR)"

# Check final size
ARCHIVE_SIZE=$(du -h "$ARCHIVE_NAME" | cut -f1)
ARCHIVE_SIZE_MB=$(du -m "$ARCHIVE_NAME" | cut -f1)

echo ""
echo "Compression complete!"
echo "Submission folder: $TARGET_DIR"
echo "Archive created: /home/akhilkk/Desktop/$ARCHIVE_NAME"
echo "Archive size: $ARCHIVE_SIZE (${ARCHIVE_SIZE_MB}MB)"

if [ $ARCHIVE_SIZE_MB -le 20 ]; then
    echo "SUCCESS: Archive is under 20MB limit!"
else
    echo "WARNING: Archive is over 20MB limit. Consider removing more files."
fi

echo ""
echo "What was excluded:"
echo "   - vendor/ directory (regenerate with: composer install)"
echo "   - node_modules/ directory (regenerate with: npm install)"
echo "   - public/build/ directory (regenerate with: npm run build)"
echo "   - Large uploaded images (kept 2 samples)"
echo "   - Test files (test_*.php)"
echo "   - Development documentation (newredme.md, SETUP_GUIDE.md, etc.)"
echo "   - Cache and log files"
echo "   - Backup files"
echo ""
echo "What was included:"
echo "   - All source code (app/, resources/, database/, routes/)"
echo "   - Configuration files"
echo "   - Essential public files"
echo "   - Installation guide"
echo "   - Sample images (small)"
echo ""
echo "Ready "
