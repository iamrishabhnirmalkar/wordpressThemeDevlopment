<?php 
// Add Title Support
add_theme_support('title-tag'); 

// Add Css and js
add_action('wp_enqueue_scripts', 'my_custom_scripts');
function my_custom_scripts() {
    // CSS
    wp_enqueue_style('my-custom-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', array(), '1.0');
    wp_enqueue_style('my-custom-style', get_theme_file_uri( '/css/styles.css' ), array('my-custom-bootstrap-icons'), '1.0');

      // JS
      wp_enqueue_script('my-custom-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '1.0', true);
      wp_enqueue_script('my-custom-style', get_theme_file_uri( '/js/scripts.js' ), array('my-custom-bootstrap'), '1.0', true);
   
    
}