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
require 'storefrontchild-customizer-template-functions.php';

class StorefrontChild_Customizer extends Storefront_Customizer
{
  /**
   * Setup class.
   * 
   * @since 1.0.0
   */

  public function __construct() {
    add_action( 'customize_register', [ $this , 'customize_register' ], 10 );
    add_action('storefront_before_header', [ $this , 'get_storefrontchild_html' ] );
    add_filter( 'body_class', [ $this , 'layout_class' ] );
    add_action( 'wp_enqueue_scripts', [ $this , 'add_customizer_css' ], 130 );
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

  /**
   * Get all of the Storefront Child theme mods.
   *
   * @return array $storefrontchild_theme_mods The Storefront Child Theme Mods.
   */
  public function get_storefrontchild_theme_mods() {
    $storefrontchild_theme_mods = [
      'topbar_bg'         => get_theme_mod( 'storefrontchild_topbar_bg' ),
      'topbar_color'      => get_theme_mod( 'storefrontchild_topbar_color' ),
      'topbar_link_color' => get_theme_mod( 'storefrontchild_topbar_link_color' ),
      'topbar_text'       => get_theme_mod( 'storefrontchild_topbar_text' ),
      'topbar_url'        => get_theme_mod( 'storefrontchild_topbar_url' ),
    ];

    return apply_filters( 'storefrontchild_theme_mods', $storefrontchild_theme_mods );
  }

  /**
   * Get Storefront Child Customizer html.
   * 
   * @see get_storefrontchild_theme_mods()
   * @see storefrontchild_top_bar( $storefrontchild_theme_mods )
   */
  public function get_storefrontchild_html() {

    $storefrontchild_theme_mods = $this->get_storefrontchild_theme_mods();
    
    storefrontchild_top_bar( $storefrontchild_theme_mods );
  }

  /**
   * Layout classes
   * Adds storefrontchild-top-bar class to the body tag
   * 
   * @param  array $classes current body classes.
   * @return string[] modified body classes
   * @since  1.0.0
   */
  public function layout_class( $classes ) {

    $classes[] = 'storefrontchild-top-bar';
    
    return $classes;
  }

  /**
   * Get Customizer css.
   *
   * @see get_storefrontchild_theme_mods()
   * @return string $styles the css
   * @since 1.0.0
   */
  public function get_css(){

    $storefrontchild_theme_mods = $this->get_storefrontchild_theme_mods();
    
    $storefrontchild_topbar_bg = $storefrontchild_theme_mods['topbar_bg'];
    $storefrontchild_topbar_color = $storefrontchild_theme_mods['topbar_color'];
    $storefrontchild_topbar_link_color = $storefrontchild_theme_mods['topbar_link_color'];
    
    $styles = '
      .storefrontchild-top-bar nav.top-bar {
        line-height: 26px;
        background-color: ' . $storefrontchild_topbar_bg . ';
      }
      nav.top-bar {
        text-align: center;      
        margin-left: 0;
        margin-right: 0;
      }
      .storefrontchild-top-bar .hfeed nav.top-bar span.top-bar-center,
      .storefrontchild-top-bar .hfeed nav.top-bar span.top-bar-center a {
        color: ' . $storefrontchild_topbar_color . ';
        letter-spacing: 4px;
        font-size: 14px;
        font-weight: normal;
        font-style: normal;
        list-style: none;
      }
      body.storefrontchild-top-bar .hfeed .top-bar .top-bar-center a:hover {
        color: ' . $storefrontchild_topbar_link_color . ';
      }';
  
    return apply_filters( 'storefront_customizer_css', $styles );
  }

  /**
   * Add CSS in <head> for styles handled by the child theme customizer
   *
   * @return void
   * @since 1.0.0
   */
  public function add_customizer_css() {
    wp_add_inline_style( 'storefrontchild-style', $this->get_css() );
  }
}
$storefrontchild_customizer = new StorefrontChild_Customizer();
return $storefrontchild_customizer;



