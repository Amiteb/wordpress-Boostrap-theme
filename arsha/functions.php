<?php
/**
 * Arsha functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package arsha
 */
if( ! class_exists( 'arsha_Theme_Setup' ) ){

	final class arsha_Theme_Setup {

	    // Theme slug Name
	    public static $slug = 'arsha';

	    // Instance
	    private static $_instance = null;

	    /**
	    * SIngletone Instance Method
	    * @since 1.0.0
	    */
	    public static function instance() {
	        if( is_null( self::$_instance ) ) {
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

	    /**
	    * Construct Method
	    * @since 1.0.0
	    */
	    public function __construct() {
	        // Call Constants Method
	        $this->define_constants();
	        $this->arsha_file_includes();
	        add_action( 'init', [ $this, 'i18n' ] );
	        add_action( 'after_setup_theme', [$this,'arsha_setup'] );
			add_action( 'after_setup_theme', [$this,'arsha_content_width'],0);
			add_action( 'widgets_init', [$this,'arsha_widgets_init'] );
			add_action( 'wp_enqueue_scripts', [$this,'scripts_styles'] );
	    }

	    /**
	    * Define Theme Constants
	    * @since 1.0.0
	    */
	    public function define_constants() {

	    	// theme name
             $theme_data = wp_get_theme();
             define( 'THEME_NAME', esc_attr( $theme_data->Name ) );
			 if( ! defined( 'theme_ver' ) ) {
				// Replace the version number of the theme on each release.
				define( 'theme_ver', '1.0.0' );
			}
	    }

	    /**
	    * Load Scripts & Styles
	    * @since 1.0.0
	    */
	    public function scripts_styles() {

	    	$path = get_template_directory_uri() . '/assets/vendor/';
			/* Styles */
			wp_enqueue_style('OpenSans-font','https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i');
		    wp_enqueue_style( 'arsha-style', get_stylesheet_uri(), array(), theme_ver );
			wp_enqueue_style('aos', $path.'aos/aos.css');
			wp_enqueue_style('bootstrap', $path.'bootstrap/css/bootstrap.min.css');
			wp_enqueue_style('bootstrap-icon', $path.'bootstrap-icons/bootstrap-icons.css');
			wp_enqueue_style('box-icons', $path.'boxicons/css/boxicons.min.css');
			wp_enqueue_style('glightbox', $path.'glightbox/css/glightbox.min.css');
			wp_enqueue_style('remixicon', $path.'remixicon/remixicon.css');
			wp_enqueue_style('swiper', $path.'swiper/swiper-bundle.min.css');
			wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css');

			/* Scripts */
			wp_enqueue_script('aos-js', $path.'aos/aos.js', array('jquery'));
			wp_enqueue_script('bootstrap', $path.'bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '5.0.1', true);
			wp_enqueue_script('glightbox', $path.'glightbox/js/glightbox.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script('isotope', $path.'isotope-layout/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
			wp_enqueue_script('validate', $path.'php-email-form/validate.js', array('jquery'), '3.1', true);
			wp_enqueue_script('swiper', $path.'swiper/swiper-bundle.min.js', array('jquery'), '6.7.0', true);
			wp_enqueue_script('waypoints', $path.'waypoints/noframework.waypoints.js', array('jquery'), '4.0.1', true);


			wp_enqueue_script( 'arsha-navigation', get_template_directory_uri() . '/js/navigation.js', array(), theme_ver, true );
			wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), theme_ver, true);

			if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
			}
	    }

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function arsha_widgets_init() {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar', 'arsha' ),
					'id'            => 'sidebar-1',
					'description'   => esc_html__( 'Add widgets here.', 'arsha' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}

	    /**
	    * Load Text Domain
	    * @since 1.0.0
	    */
	    public function i18n() {
	       load_theme_textdomain( 'arsha', get_template_directory() . '/languages' );
	    }

	    /**
	    * Initialize the Theme
	    * @since 1.0.0
	    */
		public function arsha_setup() {
		
			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( "wp-block-styles" );
			 add_theme_support( "responsive-embeds" );
			// This theme uses wp_nav_menu() in one location.
			add_theme_support('align-wide');
			add_image_size('arsha_archive_thumbnail', 460, 290, true); //update from 365, 230
			add_image_size('arsha_archive_default', 360, 450, true);
			add_image_size('arsha_widget_rcp_size', 300, 150, true);

			register_nav_menus(
				array(
					'menu-1' => esc_html__( 'Primary', 'arsha' ),
				)
			);
			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			$args = 
			add_theme_support('html5',
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
			add_theme_support( 'custom-header' );
			// Set up the WordPress core custom background feature.
			add_theme_support('custom-background',apply_filters('arsha_custom_background_args',
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
			add_theme_support('custom-logo',
				array(
					'height'      => 250,
					'width'       => 250,
					'flex-width'  => true,
					'flex-height' => true,
				)
			);
		}
		 /**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 * Priority 0 to make it available to lower priority callbacks.
		 * @global int $content_width
		 */
		public function arsha_content_width() {
			$GLOBALS['content_width'] = apply_filters( 'arsha_content_width', 640 );
		}
	    // Function to include helper functions
	    public function arsha_file_includes(){

			require get_template_directory() . '/inc/custom-header.php';
			// Load Theme config file
			$theme_paths = array(
				'inc/custom-header.php',
				'inc/template-tags.php',
				'inc/template-functions.php',
				'inc/customizer.php',
				'inc/wp_bootstrap_navwalker.php'
			);
			foreach ($theme_paths as $theme_path) {
				if(locate_template (array($theme_path))){
					require_once trailingslashit(get_parent_theme_file_path()) . $theme_path;
				}
			}
			/**
			 * Load Jetpack compatibility file.
			 */
			if ( defined( 'JETPACK__VERSION' ) ) {
				require get_template_directory() . '/inc/jetpack.php';
			}
	    }
	}
}
arsha_Theme_Setup::instance();
