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
        add_action( 'init', array( $this, 'team_post_type' ) );
        add_action('add_meta_boxes', array($this, 'team_add_meta_box'));
        add_action('save_post', array($this,'team_save_metaboxes'));

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
    public function team_post_type(){

            $labels = array(
            'name'               => esc_html__('Teams', self::$slug),
            'singular_name'      => esc_html__('Team', self::$slug),
            'add_new'            => esc_html__('Add New Team', self::$slug),
            'add_new_item'       => esc_html__('Add New Team', self::$slug),
            'edit_item'          => esc_html__('Edit Team', self::$slug),
            'new_item'           => esc_html__('New Team', self::$slug),
            'all_items'          => esc_html__('All Teams', self::$slug),
            'view_item'          => esc_html__('View Team', self::$slug),
            'search_items'       => esc_html__('Search Teams', self::$slug),
            'not_found'          => esc_html__('No Teams found', self::$slug),
            'not_found_in_trash' => esc_html__('No Teams found in trash', self::$slug), 
            'parent_item_colon'  => '',
            'menu_name'          => esc_html__('Teams', self::$slug)
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true, 
            'show_in_menu'       => true, 
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'team','with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => false, 
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-admin-post',
            'supports'           => array( 'title', 'editor', 'excerpt','thumbnail'),
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rest_base'             => 'team',
        );
     
        register_post_type( 'team', $args );
     
        register_taxonomy('team_category', 'team', array(
            'hierarchical' => true,
            'labels' => array(
                'name'              => esc_html__( 'Team Category', self::$slug ),
                'singular_name'     => esc_html__( 'Team Category', self::$slug ),
                'search_items'      => esc_html__( 'Search Team Category', self::$slug ),
                'all_items'         => esc_html__( 'All Team Categories', self::$slug ),
                'parent_item'       => esc_html__( 'Parent Team Category', self::$slug ),
                'parent_item_colon' => esc_html__( 'Parent Team Category', self::$slug ),
                'edit_item'         => esc_html__( 'Edit Team Category', self::$slug ),
                'update_item'       => esc_html__( 'Update Team Category', self::$slug ),
                'add_new_item'      => esc_html__( 'Add New Team Category', self::$slug ),
                'new_item_name'     => esc_html__( 'New Team Category', self::$slug ),
                'menu_name'         => esc_html__( 'Team Category', self::$slug ),
            ),
            'rewrite' => array(
                'slug'         => 'Team_category',
                'with_front'   => true,
                'hierarchical' => true
            ),
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'show_admin_column' => true,
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'rest_base'             => 'team_category',
        ));
 
    }

    public function team_add_meta_box()
    {
        add_meta_box('additional-page-metabox-options', esc_html__('Team Page Options', self::$slug), array($this, 'team_metabox_controls'), 'team', 'normal', 'low');
    }

    public function team_metabox_controls($post, $value = '')
    { 
        $meta = get_post_meta($post->ID);
        wp_nonce_field('team_control_meta_box', 'team_control_meta_box_nonce'); 
        // Always add nonce to your meta boxes!
        $page_meta  = unserialize(get_post_meta($post->ID, 'team_page_options', true));
        $position   =isset($page_meta['position']) ? $page_meta['position'] :'';
        $facebook   =isset($page_meta['facebook']) ? $page_meta['facebook'] :'';
        $twitter    =isset($page_meta['twitter']) ? $page_meta['twitter'] :'';
        $instagram  =isset($page_meta['instagram']) ? $page_meta['instagram'] :'';
        $linkedin  =isset($page_meta['linkedin']) ? $page_meta['linkedin'] :'';

    ?>

    <div class="team-option-wrap">
        <span class="position"><?php esc_html_e('Position', 'arsha') ?></span>
        <input type="text" name="team_page_options[position]" value="<?php echo esc_attr($position) ?>" />
    </div><br>
    <div class="team-option-wrap">
        <span class="facebook"><?php esc_html_e('facebook', 'arsha') ?></span>
        <input type="url" name="team_page_options[facebook]" value="<?php echo esc_url($facebook) ?>" />
    </div>
    <div class="team-option-wrap">
        <span class="twitter"><?php esc_html_e('twitter', 'arsha') ?></span>
        <input type="url" name="team_page_options[twitter]" value="<?php echo esc_url($twitter) ?>" />
    </div>
    <div class="team-option-wrap">
        <span class="instagram"><?php esc_html_e('instagram', 'arsha') ?></span>
        <input type="url" name="team_page_options[instagram]" value="<?php echo esc_url($instagram) ?>" />
    </div>
    <div class="team-option-wrap">
        <span class="linkedin"><?php esc_html_e('linkedin', 'arsha') ?></span>
        <input type="url" name="team_page_options[linkedin]" value="<?php echo esc_url($linkedin) ?>" />
    </div>

    <?php }

    public function team_save_metaboxes($post_id)
    {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times. Add as many nonces, as you
         * have metaboxes.
         */
        if (!isset($_POST['team_control_meta_box_nonce']) || !wp_verify_nonce(sanitize_key($_POST['team_control_meta_box_nonce']), 'team_control_meta_box')) { // Input var okay.
            return $post_id;
        }
        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'team' === $_POST['post_type']) { // Input var okay.
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if (isset($_POST['team_page_options'])) {

            //Sanitize Meta Fields
            $page_meta = wp_unslash($_POST['team_page_options']);
            $position = $page_meta['position'];
            $data['position']  = isset($position) ? sanitize_text_field($position) : '';
            $instagram = $page_meta['instagram'];
            $data['instagram']  = isset($instagram) ? esc_url_raw($instagram) : '';
            $facebook = $page_meta['facebook'];
            $data['facebook']  = isset($facebook) ? esc_url_raw($facebook) : '';
            $linkedin = $page_meta['linkedin'];
            $data['linkedin']  = isset($linkedin) ? esc_url_raw($linkedin) : '';
            $twitter = $page_meta['twitter'];
            $data['twitter']  = isset($twitter) ? esc_url_raw($twitter) : '';
            update_post_meta($post_id, 'team_page_options', serialize($data));
            
        }
    }

}
Custom_Post_Type::instance();