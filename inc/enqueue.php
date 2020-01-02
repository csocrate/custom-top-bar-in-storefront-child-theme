<?php
/**
 * Enqueue styles
 */
if ( ! function_exists('storefrontchild_enqueue_styles') ) {

  function storefrontchild_enqueue_styles() {

    $parent_style = 'storefront-style'; // for the Storefront Theme
    $child_style = 'storefrontchild-style'; // for the Storefront Child Theme    

    // Parent theme is used, so this replace get_stylesheet_directory() with get_template_directory_uri()
    wp_enqueue_style(
      $parent_style, 
      get_template_directory_uri() . '/style.css'
    );
    // This is the child theme's style and dependency with the parent theme
    wp_enqueue_style(
      $child_style,
      get_stylesheet_directory_uri() . '/style.css',
      [$parent_style],
      wp_get_theme()->get('Version')
    );
  }
}
add_action( 'wp_enqueue_scripts', 'storefrontchild_enqueue_styles' );