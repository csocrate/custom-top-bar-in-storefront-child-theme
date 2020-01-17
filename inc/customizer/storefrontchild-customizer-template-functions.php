<?php
/**
 * Storefront Child Customizer template function
 *
 * @package storefrontchild
 */

if ( ! function_exists( 'storefrontchild_top_bar' ) ) {
	/**
	 * Display top bar
	 *
	 * @since  1.0.0
	 */
  function storefrontchild_top_bar( $storefrontchild_theme_mods ) {
    if ( ! empty('topbar_text') ) :
      $topbar_url = esc_url($storefrontchild_theme_mods['topbar_url']);
      $topbar_text = $storefrontchild_theme_mods['topbar_text'];

      $top_bar_html = '
      <nav class="info">
        <span class="info-center">
          <a href="' . $topbar_url . '">' 
            . $topbar_text .
          '</a>
        </span>
      </nav>';

      echo $top_bar_html;
    endif;
  }
}