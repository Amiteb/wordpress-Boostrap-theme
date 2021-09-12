<?php 

/**
 * 
 */
class Custom_Post_Type 
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
        add_action( 'init', array( $this, 'service_post_type' ) );
    }

    public function service_post_type(){

            $labels = array(
            'name'               => esc_html__('Services', self::$slug),
            'singular_name'      => esc_html__('Service', self::$slug),
            'add_new'            => esc_html__('Add New Service', self::$slug),
            'add_new_item'       => esc_html__('Add New Service', self::$slug),
            'edit_item'          => esc_html__('Edit Service', self::$slug),
            'new_item'           => esc_html__('New Service', self::$slug),
            'all_items'          => esc_html__('All Services', self::$slug),
            'view_item'          => esc_html__('View Service', self::$slug),
            'search_items'       => esc_html__('Search Services', self::$slug),
            'not_found'          => esc_html__('No Services found', self::$slug),
            'not_found_in_trash' => esc_html__('No Services found in trash', self::$slug), 
            'parent_item_colon'  => '',
            'menu_name'          => esc_html__('Services', self::$slug)
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true, 
            'show_in_menu'       => true, 
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'service','with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => false, 
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-admin-post',
            'supports'           => array( 'title', 'editor', 'excerpt',),
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rest_base'             => 'service',
        );
     
        register_post_type( 'service', $args );
     
        register_taxonomy('service_category', 'service', array(
            'hierarchical' => true,
            'labels' => array(
                'name'              => esc_html__( 'Service Category', self::$slug ),
                'singular_name'     => esc_html__( 'Service Category', self::$slug ),
                'search_items'      => esc_html__( 'Search Service Category', self::$slug ),
                'all_items'         => esc_html__( 'All Service Categories', self::$slug ),
                'parent_item'       => esc_html__( 'Parent Service Category', self::$slug ),
                'parent_item_colon' => esc_html__( 'Parent Service Category', self::$slug ),
                'edit_item'         => esc_html__( 'Edit Service Category', self::$slug ),
                'update_item'       => esc_html__( 'Update Service Category', self::$slug ),
                'add_new_item'      => esc_html__( 'Add New Service Category', self::$slug ),
                'new_item_name'     => esc_html__( 'New Service Category', self::$slug ),
                'menu_name'         => esc_html__( 'Service Category', self::$slug ),
            ),
            'rewrite' => array(
                'slug'         => 'service_category',
                'with_front'   => true,
                'hierarchical' => true
            ),
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'show_admin_column' => true,
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'rest_base'             => 'service_category',
        ));
 
    }
}
Custom_Post_Type::instance();