<?php
/**
 * Storefront Child customizer top bar
 * 
 * @package storefrontchild
 */

if ( ! function_exists( 'storefrontchild_customizer_top_bar' ) ) {
  /**
   * Add the top bar customize background color, text color, text link color, text, URL.
   * 
   * @link https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
   * @link https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
   */
  function storefrontchild_customizer_top_bar( $wp_customize ) {
    /**
     * Top bar background
     */
    $wp_customize->add_setting( 
      'storefrontchild_topbar_bg',
      [
        'default'           => apply_filters( 'storefrontchild_default_topbar_bg', '#499fd8' ),
        'sanitize_callback' => 'sanitize_hex_color', // sanitizes a hex color
      ]
    );
    
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize, 
        'storefrontchild_topbar_bg',
        [
          'label'       => __( 'Background color', 'storefrontchild' ),
          'section'     => 'storefrontchild_topbar',
          'settings'    => 'storefrontchild_topbar_bg',
          'description' => __('Change the top bar color', 'storefrontchild'),
          'priority'    => 10,
        ]
      )
    );

    /**
     * Top bar text Color
     */
    $wp_customize->add_setting( 
      'storefrontchild_topbar_color',
      [
        'default'           => apply_filters( 'storefrontchild_default_topbar_color', '#fcfcfc' ),
        'sanitize_callback' => 'sanitize_hex_color',
      ]
    );

    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize, 
        'storefrontchild_topbar_color',
        [
          'label'       => __( 'Text color', 'storefrontchild' ),
          'section'     => 'storefrontchild_topbar',
          'settings'    => 'storefrontchild_topbar_color',
          'description' => __('Change the top bar text color', 'storefrontchild'),
          'priority'    => 20,
        ]
      )
    );

    /**
     * Top bar text link Color
     */
    $wp_customize->add_setting( 
      'storefrontchild_topbar_link_color',
      [
        'default'           => apply_filters( 'storefrontchild_default_topbar_link_color', '#2b2b2b' ),
        'sanitize_callback' => 'sanitize_hex_color',
      ]
    );

    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize, 
        'storefrontchild_topbar_link_color',
        [
          'label'       => __( 'Text link color', 'storefrontchild' ),
          'section'     => 'storefrontchild_topbar',
          'settings'    => 'storefrontchild_topbar_link_color',
          'description' => __('Change the top bar text link color', 'storefrontchild'),
          'priority'    => 25,
        ]
      )
    );

    /**
     * Top bar text
     */ 
    $wp_customize->add_setting(
      'storefrontchild_topbar_text',
      [
        'default'           => '',
        'sanitize_callback' => 'wp_filter_nohtml_kses', // strips all HTML from a text string
        'capability'        => 'edit_theme_options',
      ]
    );

    $wp_customize->add_control( 
      'storefrontchild_topbar_text',
      [
        'type'        => 'text',
        'label'       => __('Your text', 'storefrontchild'),
        'section'     => 'storefrontchild_topbar',
        'description' => __('Your text displayed in the top bar', 'storefrontchild'),
        'input_attrs' => [
          'placeholder' => __('Enter your text' ),
        ],
        'priority'    => 40,   
      ] 
    );

    /**
     * Top bar URL
     */ 
    $wp_customize->add_setting( 
      'storefrontchild_topbar_url',
      [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw', // clean url from invalid characters
        'capability'        => 'edit_theme_options',
      ] 
    );
    $wp_customize->add_control(
      'storefrontchild_topbar_url',
      [
        'type'        => 'url',
        'label'       => __( 'Your URL', 'storefrontchild' ),
        'section'     => 'storefrontchild_topbar',
        'description' => __('Your text\'s URL', 'storefrontchild'),
        'input_attrs' => [
          'placeholder' => __('https://example.com' ),
        ],
        'priority'    => 60,
      ]
    );
  }
}