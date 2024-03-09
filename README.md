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

# Create Menus

1.Register Navigation Menus in functions.php:

    To register navigation menus in WordPress, use the register_nav_menus() function in your theme's functions.php file:register_nav_menus( array(

'main_menu' => **( 'Main Menu' ),
'footer_menu' => **( 'Footer Menu' ),
) );

2. Use Code Snippet for Dynamic Header and Footer Menu in header.php and footer.php:

// custom menu
function my_custom_menu($theme_location) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
$menu = get_term($locations[$theme_location], 'nav_menu');
$menu_items = wp_get_nav_menu_items($menu->term_id);
$menu_list = '';
 		
		if ($theme_location == 'main_menu') {
$menu_list .= '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">' ."\n";
			
			$total_menu_items = count($menu_items);
$c = 0;
			  
			foreach($menu_items as $menu_item) {
$c++;
$classes = implode(' ', $menu_item->classes);

    			if($menu_item->menu_item_parent == 0) {
    				$parent = $menu_item->ID;

    				$menu_array = array();
    				foreach($menu_items as $submenu) {
    					if($submenu->menu_item_parent == $parent) {
    						$bool = true;
    						$submenu_classes = implode(' ', $submenu->classes);
    						$menu_array[] = '<li><a class="dropdown-item '.$submenu_classes.'" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
    					}
    				}

    				if(count($menu_array) > 0) {
    					$menu_list .= '<li class="nav-item dropdown '.$classes.'">' ."\n";
    					$menu_list .= '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="'.$menu_item->url.'" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $menu_item->title . '</a>' ."\n";

    					$menu_list .= ' <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">' ."\n";

    					$menu_list .= implode("\n", $menu_array);

    					$menu_list .= '</ul>' ."\n";
    				} else {
    					$menu_list .= '<li class="nav-item '.$classes.'">' ."\n";
    					$menu_list .= '<a class="nav-link" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
    				}

    				// end <li>
    				$menu_list .= '</li>' ."\n";
    			}
    		}

    		$menu_list .= '</ul>' ."\n";

    	} else if ($theme_location == 'footer_menu') {
    		$total_menu_items = count($menu_items);
    		$c = 0;
    		foreach ($menu_items as $key => $menu_item) {
    			$c++;
    			$classes = implode(' ', $menu_item->classes);
    			$title = $menu_item->title;
    			$url = $menu_item->url;

    			if ($c < $total_menu_items) {
    				$menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a> <span class="text-white mx-1">&middot;</span> ';
    			}
    			else {
    				$menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a>';
    			}
    		}
    	}

    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;

}

3. Change the Website Domain Name in Header:
   <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>

   - <?php echo home_url(); ?> redirects to the home page.
   - <?php bloginfo('name'); ?> outputs the website's name.

4. Display Current Year in Footer:

<?php echo date('Y'); ?>
