<?php 

/**
 * 
 */
class Custom_Post_Type_Portfolio 
{
 // Theme slug Name
    public static $slug = 'arsha';

    // Instance
    private static $_instance = null;

    public static function instance() {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        // Call CPT Method
        add_action( 'init', array( $this, 'portfolio_post_type' ) );

    }

    public function portfolio_post_type(){

            $labels = array(
            'name'               => esc_html__('Portfolio', self::$slug),
            'singular_name'      => esc_html__('Portfolio', self::$slug),
            'add_new'            => esc_html__('Add New Portfolio', self::$slug),
            'add_new_item'       => esc_html__('Add New Portfolio', self::$slug),
            'edit_item'          => esc_html__('Edit Portfolio', self::$slug),
            'new_item'           => esc_html__('New Portfolio', self::$slug),
            'all_items'          => esc_html__('All Portfolio', self::$slug),
            'view_item'          => esc_html__('View Portfolio', self::$slug),
            'search_items'       => esc_html__('Search Portfolios', self::$slug),
            'not_found'          => esc_html__('No Portfolios found', self::$slug),
            'not_found_in_trash' => esc_html__('No Portfolios found in trash', self::$slug), 
            'parent_item_colon'  => '',
            'menu_name'          => esc_html__('Portfolios', self::$slug)
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true, 
            'show_in_menu'       => true, 
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'portfolio','with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => false, 
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-admin-post',
            'supports'           => array( 'title', 'editor', 'excerpt',),
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rest_base'             => 'portfolio',
        );
     
        register_post_type( 'portfolio', $args );
     
        register_taxonomy('portfolio_category', 'portfolio', array(
            'hierarchical' => true,
            'labels' => array(
                'name'              => esc_html__( 'Portfolio Category', self::$slug ),
                'singular_name'     => esc_html__( 'Portfolio Category', self::$slug ),
                'search_items'      => esc_html__( 'Search Portfolio Category', self::$slug ),
                'all_items'         => esc_html__( 'All Portfolio Categories', self::$slug ),
                'parent_item'       => esc_html__( 'Parent Portfolio Category', self::$slug ),
                'parent_item_colon' => esc_html__( 'Parent Portfolio Category', self::$slug ),
                'edit_item'         => esc_html__( 'Edit Portfolio Category', self::$slug ),
                'update_item'       => esc_html__( 'Update Portfolio Category', self::$slug ),
                'add_new_item'      => esc_html__( 'Add New Portfolio Category', self::$slug ),
                'new_item_name'     => esc_html__( 'New Portfolio Category', self::$slug ),
                'menu_name'         => esc_html__( 'Portfolio Category', self::$slug ),
            ),
            'rewrite' => array(
                'slug'         => 'portfolio_category',
                'with_front'   => true,
                'hierarchical' => true
            ),
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'show_admin_column' => true,
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'rest_base'             => 'portfolio_category',
        ));
 
    }

}
Custom_Post_Type_Portfolio::instance();