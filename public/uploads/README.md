# Uploads Directory

This directory stores uploaded images and files for the tour booking system.

## Structure:
- `tours/` - Tour images uploaded through admin panel
- Other subdirectories will be created as needed

## Permissions:
This directory needs write permissions (755 or 777) for PHP to upload files.

## Security:
- Only image files should be uploaded
- File validation is handled in the PHP code
- Direct execution of uploaded files is blocked via .htaccess