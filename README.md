## Setting Up a Custom WordPress Theme

1. Make Custom Folder Name in Theme Folder:
   Create a folder in the wp-content/themes directory of your WordPress installation. You can name this folder whatever you like. Let's say you name it my_custom_theme.
2. Create index.php and style.css:
   Inside your my_custom_theme folder, create index.php and style.css files.

style.css:

/_
Theme Name: My Custom Theme
Description: This is a custom theme developed by [Your Name].
Version: 1.0
Author: [Your Name]
_/

3. Make a Screenshot:
   Create a screenshot of your theme with dimensions 1200x900 pixels. Save it as screenshot.png in the my_custom_theme folder.

# Creating Header and Footer Files

1. Create header.php and footer.php:
   Inside your my_custom_theme folder, create header.php and footer.php files.

2. Write Header Code and Footer Code:
   In header.php, you can include your HTML header code. Similarly, in footer.php, include your HTML footer code.

Example header.php:

<!DOCTYPE html> to </header>

Example footer.php:

<footer> to </html>

3. Include Header and Footer in index.php:
   In your index.php file (which acts as the main template file), include the header and footer files using get_header() and get_footer() functions respectively.

   <?php get_header(); ?>
   <!-- Your index.php content goes here -->
   <?php get_footer(); ?>

4. Link CSS and JavaScript:
   To link CSS and JavaScript files, you can use get_stylesheet_directory_uri() to dynamically retrieve the URI of your theme directory.

Example CSS link:

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

Example JavaScript link:

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>
