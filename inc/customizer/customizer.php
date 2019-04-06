<?php
/**
 * Theme Customizer functionality
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function harbor_customize_register( $wp_customize ) {

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );

	$wp_customize->add_section(
		'theme_settings', array(
			'title'       => esc_html__( 'Theme Options', 'harbor' ),
			'description' => esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'harbor' ),
			'priority'    => 30,
		)
	);

	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => 100,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'harbor' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => 100,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Mobile Max Width', 'harbor' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting( '404-img-upload' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, '404-img-upload', array(
				'label'    => __( '404 Custom Image', 'harbor' ),
				'section'  => 'theme_settings',
				'settings' => '404-img-upload',
			)
		)
	);

	$wp_customize->add_section(
		'layout_panel_header', array(
			'title'    => __( 'Header', 'harbor' ),
			'priority' => 37,
		)
	);
	$wp_customize->add_setting(
		'header_position', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => '',
		)
	);

	$wp_customize->add_control(
		'header_position', array(
			'type'        => 'radio',
			'section'     => 'layout_panel_header',
			'label'       => __( 'Alignment Layout' ),
			'description' => __( 'Select the header logo and menu alignment option for the site.' ),
			'choices'     => array(
				'header_left_aligned' => __( 'Logo Left' ),
				''                    => __( 'Logo Right' ),
			),
		)
	);

	$wp_customize->add_setting( 'menu_visible_nav', array( 'default' => 0 ) );
	$wp_customize->add_control(
		'menu_visible_nav',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Header Menu', 'harbor' ),
			'section'  => 'layout_panel_header',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'menu_layout', array(
			'default'           => 'menu_sidebar',
			'transport'         => 'refresh',
			'sanitize_callback' => '',
		)
	);

	$wp_customize->add_control(
		'menu_layout', array(
			'type'        => 'radio',
			'section'     => 'layout_panel_header',
			'label'       => __( 'Secondary Menu' ),
			'description' => __( 'Select the secondary menu style for the site. Please set a secondary navigation menu in the WP Menu dashboard.' ),
			'choices'     => array(
				'menu_standard'   => __( 'Standard' ),
				'menu_sidebar'    => __( 'Sidebar' ),
				'menu_fullscreen' => __( 'Fullpage' ),
			),
		)
	);

	$wp_customize->add_setting(
		'wrapper_background_color', array(
			'default'           => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'wrapper_background_color', array(
				'label'    => __( 'Background', 'harbor' ),
				'section'  => 'colors',
				'settings' => 'wrapper_background_color',
				'priority' => 2,
			)
		)
	);

	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default'           => '#48b6c7',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'    => __( 'Accent Color', 'harbor' ),
				'section'  => 'colors',
				'settings' => 'theme_accent_color',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_setting(
		'portfolio_overlay_color', array(
			'default'           => '#000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'portfolio_overlay_color', array(
				'label'    => __( 'Overlay Color', 'harbor' ),
				'section'  => 'colors',
				'settings' => 'portfolio_overlay_color',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_section(
		'blog_settings', array(
			'title'    => __( 'Blog', 'harbor' ),
			'priority' => 38,
		)
	);

	$wp_customize->add_setting( 'post_meta', array( 'default' => 0 ) );
	$wp_customize->add_control(
		'post_meta',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Post Meta', 'harbor' ),
			'section'  => 'blog_settings',
			'priority' => 2,
		)
	);

	$wp_customize->add_setting( 'post_sharing', array( 'default' => 0 ) );
	$wp_customize->add_control(
		'post_sharing',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Post Sharing', 'harbor' ),
			'section'  => 'blog_settings',
			'priority' => 3,
		)
	);

	$wp_customize->add_setting( 'post_next', array( 'default' => 0 ) );
	$wp_customize->add_control(
		'post_next',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Next Post Preview', 'harbor' ),
			'section'  => 'blog_settings',
			'priority' => 5,
		)
	);

	$wp_customize->add_setting(
		'blog_layout', array(
			'default'           => 'blog_standard',
			'sanitize_callback' => '',
		)
	);

	$wp_customize->add_control(
		'blog_layout', array(
			'type'        => 'radio',
			'section'     => 'blog_settings',
			'label'       => __( 'Blog Layout' ),
			'description' => __( 'Select the blog layout.' ),
			'choices'     => array(
				'blog_standard' => __( 'Standard' ),
				'blog_wide'     => __( 'Wide' ),
			),
		)
	);

	$wp_customize->add_panel(
		'portfolio_panel', array(
			'priority'    => 39,
			'title'       => __( 'Portfolio', 'harbor' ),
			'description' => __( '', 'harbor' ),
		)
	);

	$wp_customize->add_section(
		'portfolio_settings', array(
			'title'    => __( 'Options', 'harbor' ),
			'priority' => 2,
			'panel'    => 'portfolio_panel',
		)
	);

		$wp_customize->add_setting( 'portfolio_filter', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'portfolio_filter',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Filter', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting( 'display_pagination', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'display_pagination',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Navigation', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting( 'show_portfolio_sharing', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'show_portfolio_sharing',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Sharing', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting( 'portfolio_loop_scaling', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'portfolio_loop_scaling',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Portfolio Scaling', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 4,
			)
		);

		$wp_customize->add_setting( 'loop_categories', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'loop_categories',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Loop Categories', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'portfolio_posts_count', array(
				'default'           => '-1',
				'sanitize_callback' => 'bean_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			'portfolio_posts_count',
			array(
				'label'    => __( 'Portfolio Template Count', 'harbor' ),
				'section'  => 'portfolio_settings',
				'type'     => 'text',
				'priority' => 6,
			)
		);

		// PAGES ARRAY
		$options_pages     = array();
		$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		$options_pages[''] = '';
	foreach ( $options_pages_obj as $page ) {
		$options_pages[ $page->ID ] = $page->post_title;
	}

		$wp_customize->add_setting( 'portfolio_page_selector' );
		$wp_customize->add_control(
			'portfolio_page_selector', array(
				'settings' => 'portfolio_page_selector',
				'label'    => __( 'Portfolio Page', 'harbor' ),
				'section'  => 'portfolio_settings',
				'type'     => 'select',
				'choices'  => $options_pages,
				'priority' => 8,
			)
		);

		$wp_customize->add_setting( 'portfolio_css_filter', array( 'default' => 'none' ) );
		$wp_customize->add_control(
			'portfolio_css_filter',
			array(
				'type'     => 'select',
				'label'    => __( 'Portfolio Loop Filter', 'harbor' ),
				'section'  => 'portfolio_settings',
				'priority' => 9,
				'choices'  => array(
					'none'       => 'None',
					'grayscale'  => 'Black & White',
					'sepia'      => 'Sepia Tone',
					'saturation' => 'High Saturation',
				),
			)
		);

	$wp_customize->add_section(
		'layout_panel_portfolio', array(
			'title'    => __( 'Single Layout', 'harbor' ),
			'panel'    => 'portfolio_panel',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'single_portfolio_layout', array(
			'default'           => 'single_portfolio_stacked',
			'transport'         => 'refresh',
			'sanitize_callback' => '',
		)
	);

	$wp_customize->add_control(
		'single_portfolio_layout', array(
			'type'        => 'radio',
			'section'     => 'layout_panel_portfolio',
			'label'       => __( 'Portfolio Layout' ),
			'description' => __( 'Select a global layout for the single portfolio. Override on individual posts by changing the "Portfolio Layout" meta option via the post editor.' ),
			'choices'     => array(
				'single_portfolio_stacked'               => __( 'Stacked' ),
				'single_portfolio_stacked_no_hero'       => __( 'Stacked, No Hero' ),
				'single_portfolio_fullscreen'            => __( 'Fullscreen' ),
				'single_portfolio_fullscreen_no_hero'    => __( 'Fullscreen, No Hero' ),
				'single_portfolio_fullscreen_no_content' => __( 'Fullscreen, No Content' ),
				'single_portfolio_masonry'               => __( 'Masonry' ),
				'single_portfolio_masonry_no_hero'       => __( 'Masonry, No Hero' ),
				'single_portfolio_carousel'              => __( 'Carousel' ),
				'single_portfolio_carousel_no_hero'      => __( 'Carousel, No Hero' ),
			),
		)
	);

	$wp_customize->add_section(
		'portfolio_cta', array(
			'title'    => __( 'Call to Action', 'harbor' ),
			'priority' => 2,
			'panel'    => 'portfolio_panel',
		)
	);

		$wp_customize->add_setting( 'portfolio_cta', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'portfolio_cta',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Single CTA', 'harbor' ),
				'section'  => 'portfolio_cta',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting( 'portfolio_cta_btn_text' );
		$wp_customize->add_control(
			'portfolio_cta_btn_text',
			array(
				'label'    => __( 'Link', 'harbor' ),
				'section'  => 'portfolio_cta',
				'type'     => 'text',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'portfolio_cta_btn_url', array(
				'default'           => 'http://themebeans.com/themes/harbor',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'portfolio_cta_btn_url',
			array(
				'label'    => __( 'Link URL', 'harbor' ),
				'section'  => 'portfolio_cta',
				'type'     => 'text',
				'priority' => 43,
			)
		);

		$wp_customize->add_setting(
			'portfolio_cta_text', array(
				'default'           => '',
				'sanitize_callback' => 'bean_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'portfolio_cta_text', array(
				'type'     => 'textarea',
				'section'  => 'portfolio_cta',
				'label'    => '',
				'priority' => 2,
			)
		);

	$wp_customize->add_panel(
		'contact_panel', array(
			'priority' => 40,
			'title'    => __( 'Contact', 'harbor' ),
		)
	);

	$wp_customize->add_section(
		'contact_settings', array(
			'title'    => __( 'Options', 'harbor' ),
			'priority' => 1,
			'panel'    => 'contact_panel',
		)
	);

		$wp_customize->add_setting(
			'admin_custom_email', array(
				'default'           => '',
				'sanitize_callback' => 'bean_check_email',
			)
		);
		$wp_customize->add_control(
			'admin_custom_email',
			array(
				'label'    => __( 'Email Address', 'harbor' ),
				'section'  => 'contact_settings',
				'type'     => 'text',
				'priority' => 1,
			)
		);

	// MAP SETION
	$wp_customize->add_section(
		'contact_settings_gmap', array(
			'title'    => __( 'Google Map', 'harbor' ),
			'priority' => 2,
			'panel'    => 'contact_panel',
		)
	);

		$wp_customize->add_setting(
			'google_maps_code', array(
				'default'           => '[google_maps id="XXX"]',
				'sanitize_callback' => 'bean_sanitize_text',
			)
		);
		$wp_customize->add_control(
			'google_maps_code',
			array(
				'label'       => __( 'Map Shortcode', 'harbor' ),
				'section'     => 'contact_settings_gmap',
				'description' => __( 'Enter a google map shortcode from the Google Maps Builder plugin.', 'harbor' ),
				'type'        => 'text',
				'priority'    => 1,
			)
		);

		$wp_customize->add_setting(
			'gmap_address', array(
				'default'           => '350 5th Avenue<br/>New York, NY<br/>10118',
				'sanitize_callback' => 'bean_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'gmap_address', array(
				'type'        => 'textarea',
				'section'     => 'contact_settings_gmap',
				'label'       => esc_html__( 'Map Address', 'harbor' ),
				'description' => esc_html__( 'Add an address to be overlaid on the template&#39;s Google map.', 'harbor' ),
				'priority'    => 6,
			)
		);

	$wp_customize->add_section(
		'contact_settings_testimonials', array(
			'title'    => __( 'Testimonials', 'harbor' ),
			'priority' => 3,
			'panel'    => 'contact_panel',
		)
	);

		$wp_customize->add_setting(
			'testimonials_title', array(
				'default'           => 'Client Reviews',
				'sanitize_callback' => 'bean_sanitize_text',
			)
		);
		$wp_customize->add_control(
			'testimonials_title',
			array(
				'label'       => __( '', 'harbor' ),
				'description' => __( 'Install the Bean Testimonials plugin and display client reviews on the contact template.', 'harbor' ),
				'section'     => 'contact_settings_testimonials',
				'type'        => 'text',
				'priority'    => 1,
			)
		);

		$wp_customize->add_setting( 'show_testimonials', array( 'default' => 0 ) );
		$wp_customize->add_control(
			'show_testimonials',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Enable Testimonials', 'harbor' ),
				'section'  => 'contact_settings_testimonials',
				'priority' => 2,
			)
		);

	$wp_customize->add_section(
		'footer_settings', array(
			'title'    => __( 'Footer', 'harbor' ),
			'priority' => 41,
		)
	);

	$wp_customize->add_setting( 'back_to_top', array( 'default' => 0 ) );
	$wp_customize->add_control(
		'back_to_top',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Enable Back to Top', 'harbor' ),
			'section'  => 'footer_settings',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'footer_copyright', array(
			'default'           => '',
			'sanitize_callback' => 'bean_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'footer_copyright', array(
			'type'        => 'textarea',
			'section'     => 'footer_settings',
			'label'       => esc_html__( 'Footer Copyright', 'harbor' ),
			'description' => esc_html__( 'Add an address to be overlaid on the template&#39;s Google map.', 'harbor' ),
			'priority'    => 7,
		)
	);

	$wp_customize->add_setting(
		'footer_social_twitter', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_twitter',
		array(
			'label'    => __( 'Twitter URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_facebook', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_facebook',
		array(
			'label'    => __( 'Facebook URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_dribbble', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_dribbble',
		array(
			'label'    => __( 'Dribbble URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_instagram', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_instagram',
		array(
			'label'    => __( 'Instagram URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_behance', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_behance',
		array(
			'label'    => __( 'Behance URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_linkedin', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'footer_social_linkedin',
		array(
			'label'    => __( 'Linkedin URL', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->add_setting(
		'footer_social_email', array(
			'default'           => '',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'footer_social_email',
		array(
			'label'    => __( 'Email Address', 'harbor' ),
			'section'  => 'footer_settings',
			'type'     => 'text',
			'priority' => 4,
		)
	);

	$wp_customize->get_setting( 'blogname' )->transport               = 'postMessage';
	$wp_customize->get_setting( 'footer_copyright' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'testimonials_title' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'portfolio_cta_btn_text' )->transport = 'postMessage';
	$wp_customize->get_setting( 'portfolio_cta_text' )->transport     = 'postMessage';
}
add_action( 'customize_register', 'harbor_customize_register' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function harbor_customize_preview_js() {
	wp_enqueue_script( 'harbor-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . HARBOR_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'harbor_customize_preview_js' );
