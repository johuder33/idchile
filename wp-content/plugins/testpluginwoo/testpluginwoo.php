<?php
/**
 * Plugin Name: Swiper SlideShow
 * Plugin URI: https://gist.github.com/BFTrick/b5e3afa6f4f83ba2e54a
 * Description: A plugin for slideshow using Swiper
 * Author: Juorder Gonzalez
 * Author URI: http://www.machinesoft.com
 * Version: 1.0
 **/
class WP_swiper_slideshow {
    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_demo', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_demo', __CLASS__ . '::update_settings' );
        add_action( 'admin_menu', __CLASS__.'::add_menu_link' );
        add_action('init', __CLASS__.'::add_custom_post_type_slideshow');

        // add new tab inside Woocommerce Link Menu
        add_action( 'init', array(__CLASS__, 'setting_new_tabs'));
    }

    public static function add_custom_post_type_slideshow() {
        $args = array(
            'public' => true,
            'label' => 'Nivo Images',
            'supports' => array(
                'title',
                'thumbnail'
            )
        );
        register_post_type('wc_custom_slideshow', $args);
    }
    
    public static function add_menu_link(){
        add_menu_page('Titulo pagina', 'SlideShow', 'manage_options', 'my-id', __CLASS__ .'::saludo');
    }

    public static function saludo() {
        echo WP_PLUGIN_URL;
    }

    public static function uploadSlides(){
        if(isset($_FILES['slides'])){
            
        }
    }
    
    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_demo'] = __( 'Marcas', 'woocommerce-settings-tab-demo' );
        return $settings_tabs;
    }
    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }
    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }
    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Section Title', 'woocommerce-settings-tab-demo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_settings_tab_demo_section_title'
            ),
            'title' => array(
                'name' => __( 'Title', 'woocommerce-settings-tab-demo' ),
                'type' => 'text',
                'desc' => __( 'This is some helper text', 'woocommerce-settings-tab-demo' ),
                'id'   => 'wc_settings_tab_demo_title'
            ),
            'description' => array(
                'name' => __( 'Description', 'woocommerce-settings-tab-demo' ),
                'type' => 'textarea',
                'id'   => 'wc_settings_tab_demo_description'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_settings_tab_demo_section_end'
            )
        );
        return apply_filters( 'wc_settings_tab_demo_settings', $settings );
    }

    function setting_new_tabs() {
        $labels = array(
            'name'                => _x( 'Marcas', 'Post Type General Name', 'GWP' ),
            'singular_name'       => _x( 'Marcas', 'Post Type Singular Name', 'GWP' ),
            'menu_name'           => __( 'marcas', 'GWP' ),
            'parent_item_colon'   => __( '', 'GWP' ),
            'all_items'           => __( 'Marcas', 'GWP' ),
            'view_item'           => __( '', 'GWP' ),
            'add_new_item'        => __( 'Agregar Nueva Marca', 'GWP' ),
            'add_new'             => __( 'Agregar Nueva Marca', 'GWP' ),
            'edit_item'           => __( 'Editar Marcas', 'GWP' ),
            'update_item'         => __( 'Actualizar Marcas', 'GWP' ),
            'search_items'        => __( 'Buscar en Marcas', 'GWP' ),
            'not_found'           => __( 'No encontrado', 'GWP' ),
            'not_found_in_trash'  => __( 'No encontrado en la papelera', 'GWP' ),
        );

        $args = array(
            'label'               => __( 'Marcas', 'GWP' ),
            'description'         => __( 'Marcas de los productos que ofrecen', 'GWP' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => 'edit.php?post_type=product',
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-feedback',
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
        );

        register_post_type( 'wc_custom_brands', $args );
    }
}
WP_swiper_slideshow::init();
?>