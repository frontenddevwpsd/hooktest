<?php
   /**
    * Contractor Starter Theme functions and definitions
    *
    * @link https://developer.wordpress.org/themes/basics/theme-functions/
    *
    * @package Contractor_Starter_Theme
    */
   if ( ! defined( '_S_VERSION' ) ) {
   	$versionDate = time();
   	// Replace the version number of the theme on each release.
   	define( '_S_VERSION', $versionDate );
   }
   /**
    * Sets up theme defaults and registers support for various WordPress features.
    *
    * Note that this function is hooked into the after_setup_theme hook, which
    * runs before the init hook. The init hook is too late for some features, such
    * as indicating support for post thumbnails.
    */
   function contractor_starter_setup() {
   	/*
   	 * Make theme available for translation.
   	 * Translations can be filed in the /languages/ directory.
   	 * If you're building a theme based on Contractor Starter Theme, use a find and replace
   	 * to change 'contractor_starter' to the name of your theme in all the template files.
   	*/
   	load_theme_textdomain( 'contractor_starter', get_template_directory() . '/languages' );
   	// Add default posts and comments RSS feed links to head.
   	// add_theme_support( 'automatic-feed-links' );
   	/*
   	 * Let WordPress manage the document title.
   	 * By adding theme support, we declare that this theme does not use a
   	 * hard-coded <title> tag in the document head, and expect WordPress to
   	 * provide it for us.
   	*/
   	add_theme_support( 'title-tag' );
   	/*
   	 * Enable support for Post Thumbnails on posts and pages.
   	 *
   	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   	 */
   	add_theme_support( 'post-thumbnails' );
   	/*
   	 * Add custom image sizes 
   	 */
   	add_action( 'after_setup_theme', 'custom_image_setup' );
   	function custom_image_setup() {
   		add_image_size( 'small', 300 ); // 300px wide and unlimited height
   		add_image_size( 'extra-large', 1920 ); // 1920px wide and unlimited height
   		add_image_size( 'banner', 2160, 1440, true ); // 2160px wide and cropped to 1440px tall
   	}
   	// This theme uses wp_nav_menu() in one location.
   	register_nav_menus(
   		array(
   			'menu-1' => esc_html__( 'Primary', 'contractor_starter' ),
   			'menu-2' => esc_html__( 'Mobile', 'contractor_starter' ),
   			'menu-3' => esc_html__( 'Footer', 'contractor_starter' ),
   		)
   	);
   	/*
   	 * Switch default core markup for search form, comment form, and comments
   	 * to output valid HTML5.
   	 */
   	add_theme_support(
   		'html5',
   		array(
   			'search-form',
   			'comment-form',
   			'comment-list',
   			'gallery',
   			'caption',
   			'style',
   			'script',
   		)
   	);
   	// Set up the WordPress core custom background feature.
   	add_theme_support(
   		'custom-background',
   		apply_filters(
   			'contractor_starter_custom_background_args',
   			array(
   				'default-color' => 'ffffff',
   				'default-image' => '',
   			)
   		)
   	);
   	// Add theme support for selective refresh for widgets.
   	add_theme_support( 'customize-selective-refresh-widgets' );
   	/**
   	 * Add support for core custom logo.
   	 *
   	 * @link https://codex.wordpress.org/Theme_Logo
   	 */
   	add_theme_support(
   		'custom-logo',
   		array(
   			'height'      => 250,
   			'width'       => 250,
   			'flex-width'  => true,
   			'flex-height' => true,
   		)
   	);
   }
   add_action( 'after_setup_theme', 'contractor_starter_setup' );
   /**
    * Enqueue scripts and styles.
    */
   function contractor_starter_scripts() {
   	// wp_enqueue_style( 'contractor_starter-style', get_stylesheet_uri(), array(), _S_VERSION );
   	// wp_style_add_data( 'contractor_starter-style', 'rtl', 'replace' );
   	// Register 'main.scss'  stylesheet
   	wp_enqueue_style( 'main-styles', get_template_directory_uri().'/inc/css/main.min.css', array(), _S_VERSION );
   	// Move jQuery to the footer
   	wp_scripts()->add_data( 'jquery', 'group', 1 );
   	wp_scripts()->add_data( 'jquery-core', 'group', 1 );
   	wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
   	// Check which template is assigned to current page we are looking at
   	// Load these scripts on all pages, unless 'PPC Landing Page' template is enabled
   	if(!is_page_template('page-ppc.php')){
   		// Responsive Nav
   		wp_enqueue_script( 'responsive-nav', get_template_directory_uri() . '/inc/js/responsive-nav.min.js', array( 'jquery' ), null, true );
   	}
   	// Slick Slider JS
   	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/inc/js/vendors/slick.min.js', array( 'jquery' ), _S_VERSION , true  );
   	// Tiny Slider JS
   	wp_enqueue_script( 'tiny-slider', get_template_directory_uri() . '/inc/js/vendors/tiny-slider.min.js', array( 'jquery' ), _S_VERSION , true  );
   	// Magnific Pop-up JS
   	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/inc/js/vendors/magnific-popup.min.js', array( 'jquery' ), _S_VERSION , true  );
   	// Init JS file
   	wp_enqueue_script( 'init', get_template_directory_uri() . '/inc/js/init.js', array( 'jquery' ), _S_VERSION , true  );
   }
   add_action( 'wp_enqueue_scripts', 'contractor_starter_scripts' );
   /* Defer seleced JS in footer
   ---------------------------------------------------- */
   function contractor_starter_defer_scripts( $tag, $handle, $src ) {
   	$defer = array( 
   		// Place the handle created for each script when enqueuing here.
   		'responsive-nav',
   		'tiny-slider',
   		'magnific-popup',
   		'init'
   	);
   	if ( in_array( $handle, $defer ) ) {
   		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
   	}
   		return $tag;
   	} 
   add_filter( 'script_loader_tag', 'contractor_starter_defer_scripts', 10, 3 );
   /* Admin ACF Styles
   ---------------------------------------------------- */
    function admin_style() {
       wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
   }
   add_action('admin_enqueue_scripts', 'admin_style');
   /* Load custom shortcodes
   ---------------------------------------------------- */
   /*
   Disables comments on all post and media.
   ---------------------------------------------------- */
   function filter_media_comment_status( $open, $post_id ) {
   	$post = get_post( $post_id );
   	if( $post->post_type == 'attachment' ) {
   		return false;
   	}
   	return $open;
   }
   add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );
   /* = ACF: theme options
   ---------------------------------------------------- */
   // Add option pages
   if (function_exists('acf_add_options_page')) {
   	$args = array(
   		'menu_slug' => 'theme-options',
   		'menu_title' => __('Theme Options', 'ovg'),
   		'title' => __('Theme Options', 'ovg'),
   		'capability' => 'manage_options');
   	// add parent page
   	acf_add_options_page($args);
   }
   /* Insert custom button into Gravity Forms
   ---------------------------------------------------- */
   add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
   function form_submit_button( $button, $form ) {
   	return "<button aria-label='submit form' class='form__button btn' id='gform_submit_button_{$form['id']}'><span>".$form['button']['text']."</span></button>";
   }
   /* Estimated reading time
   ---------------------------------------------------- */
   function reading_time($post) {
   	$content = get_the_content( $post->ID );
   	$word_count = str_word_count( strip_tags( $content ) );
   	$readingtime = ceil($word_count / 200);
   	if ($readingtime == 1) {
   	$timer = " Minute Read";
   	} else {
   	$timer = " Minute Read";
   	}
   	$totalreadingtime = $readingtime . $timer;
   	return $totalreadingtime;
   }
   /* Enable local JSON for ACF */ 
   add_filter('acf/settings/save_json', 'my_acf_json_save_point');
   function my_acf_json_save_point( $path ) {
       // update path
       $path = get_stylesheet_directory() . '/acf-json';
       // return
       return $path;
   }
   /*  Allow SVG + PDF file uploads */
   function cc_mime_types($mimes) {
   	$mimes['svg'] = 'image/svg+xml';
   	$mime['pdf'] = 'application/pdf';
   	return $mimes;
   }
   add_filter('upload_mimes', 'cc_mime_types');
   /*  Removes Tag / Archive / Title prefixes */
   add_filter('get_the_archive_title', function ($title) {
       return preg_replace('/^\w+: /', '', $title);
   });
   /*  Removes number count from FacetWP dropdowns */
   add_filter( 'facetwp_facet_dropdown_show_counts', '__return_false' );
   /* Add Second Logo to Customizer > Site Identity
   ---------------------------------------------------- */
   function contractor_starter_customizer_setting($wp_customize) {
   	// add setting for a footer logo 
   	$wp_customize->add_setting('contractor_starter_footer_logo');
   	// Add a control to upload the footer logo
   	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contractor_starter_footer_logo', array(
   		'label' => 'Upload Footer Logo',
   		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
   		'settings' => 'contractor_starter_footer_logo',
   		'priority' => 8 // show it just below the custom-logo
   	)));
   	// add setting for a mobile logo 
   	$wp_customize->add_setting('contractor_starter_mobile_logo');
   	// Add a control to upload the mobile logo
   	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'contractor_starter_mobile_logo', array(
   		'label' => 'Upload Mobile Logo',
   		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
   		'settings' => 'contractor_starter_mobile_logo',
   		'priority' => 9 // show it just below the footer logo
   	)));
   }
   add_action('customize_register', 'contractor_starter_customizer_setting');
   /*  Removes Rank Math data on uninstall */
   /* add_filter( 'rank_math_clear_data_on_uninstall', '__return_true' ); */
   add_filter( 'gform_confirmation_anchor_5', '__return_false' );