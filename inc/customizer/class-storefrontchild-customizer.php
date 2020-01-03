<?php
namespace storefrontchild\StorefrontChild_Customizer;
// Namespace used here instead of class_exists

/**
 * Storefront Child Customizer Class
 *
 * @package  storefrontchild
 * @link https://codex.wordpress.org/Theme_Customization_API#Sample_Theme_Customization_Class
 * @since    1.0.0
 */

//Classes used
use Storefront_Customizer;
use WP_Customize_Color_Control;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require __DIR__.'/../../../storefront/inc/customizer/class-storefront-customizer.php';

require 'storefrontchild-customizer-top-bar.php';

class StorefrontChild_Customizer extends Storefront_Customizer
{
  /**
   * Setup class.
   * 
   * @since 1.0.0
   */

  public function __construct() {
    add_action( 'customize_register', [ $this , 'customize_register' ], 10 );
    add_filter( 'storefront_setting_default_values', [ $this, 'storefrontchild_setting_default_values' ] );
  }

  /**
   * Returns an array of the desired default Storefront Child Options
   *
   * @param array $defaults array of default options.
   * @return array
   * @since 1.0.0
   */
  public function storefrontchild_setting_default_values( $defaults = [] ) {
    $defaults['storefrontchild_topbar_bg'] = '#499fd8';
    $defaults['storefrontchild_topbar_color'] = '#fcfcfc';
    $defaults['storefrontchild_topbar_link_color'] = '#2b2b2b';

    return $defaults;
  }

  /**
   * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
   *
   * @link https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
   * @param WP_Customize_Manager $wp_customize Theme Customizer object
   * @see storefrontchild_customizer_top_bar( $wp_customize )
   * @since  1.0.0
   */
  public function customize_register ( $wp_customize ) {
    /**
     * Add the top bar section
     */
    $wp_customize->add_section(
      'storefrontchild_topbar', 
      [
        'title'       => __( 'The top bar', 'storefrontchild' ),
        'description' => __( 'Customize the look & feel of your website top bar', 'storefrontchild' ),
        'priority'    => 20,
      ]
    );
    storefrontchild_customizer_top_bar( $wp_customize );
  }
}



