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

# Work On Header and Footer

1. Replace <html lang="en"> with <html <?php language_attributes(); ?>>:
   This change enables WordPress to set the language attributes dynamically.

2. Replace <meta charset="utf-8" /> with <meta charset="<?php bloginfo('charset')?>" />:
   The bloginfo('charset') function retrieves the character set defined in your WordPress settings.

3. Remove title, keywords, and description tags:
   Title, keywords, and description are typically managed via WordPress settings or through SEO plugins. They are not usually hardcoded into the theme files.

4. Add <?php wp_head();?> before </head> tag:
   This function is crucial for WordPress themes as it allows plugins and WordPress itself to insert scripts and styles into the head section of the theme.

5. Create functions.php File and Add Theme Support for Title Tag:

   You need to create a functions.php file in your WordPress theme directory. Inside this file, you can add the following code to add support for the title tag:

<?php 
// Add Title Support
add_theme_support('title-tag');
?>

6. Add CSS and JS in functions.php File:
   You can enqueue your CSS and JS files using the wp_enqueue_scripts action hook. Here's how you can do it:

<?php

add_action('wp_enqueue_scripts', 'my_custom_scripts');

// Enqueue scripts and styles
function my_custom_scripts() {
    // Enqueue CSS
    wp_enqueue_style('my-custom-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
    
    // Enqueue JS
    wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);
}
?>

for example:

// CSS
wp_enqueue_style('my-custom-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', array(), '1.0');
wp_enqueue_style('my-custom-style', get_theme_file_uri( '/css/styles.css' ), array('my-custom-bootstrap-icons'), '1.0');

// JS
wp_enqueue_script('my-custom-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '1.0', true);
wp_enqueue_script('my-custom-style', get_theme_file_uri( '/js/scripts.js' ), array('my-custom-bootstrap'), '1.0', true);

In the wp_enqueue_style and wp_enqueue_script functions:

- 'mbfile-name' is a handle for your CSS or JS file. It should be unique for each file you enqueue.- get\*stylesheet_directory_uri() retrieves the URI of your theme's directory.
- Replace /path/to/your/css/file.css and /path/to/your/js/file.js with the paths to your CSS and JS files respectively.
- '1.0' is the version number of your CSS or JS file. Update it as needed.
- 'all' specifies the media type for the stylesheet.

6. Remove CSS and JS Links from Templates:
   After enqueuing your scripts and styles using the wp_enqueue_script() and wp_enqueue_style() functions in your functions.php file, you should remove any CSS and JS links from your theme's template files, such as header.php, footer.php, etc.
7. Place <?php wp_footer(); ?> Before the Closing </body> Tag:
   In your footer.php file, make sure to include <?php wp_footer(); ?> just before the closing </body> tag. This ensures that scripts dependent on the footer, such as ones related to analytics or other plugins, are properly loaded.
