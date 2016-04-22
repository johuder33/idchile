<?php
/**
 * Plugin Name: Swiper SlideShow
 * Plugin URI: https://gist.github.com/BFTrick/b5e3afa6f4f83ba2e54a
 * Description: A plugin for slideshow using Swiper
 * Author: Juorder Gonzalez
 * Author URI: http://www.machinesoft.com
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
class WP_swiper_slideshow {
    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_demo', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_demo', __CLASS__ . '::update_settings' );
        add_action( 'admin_menu', __CLASS__.'::mi_menu' );
    }
    
    public static function mi_menu(){
        add_menu_page('Primer param', 'Segundo param', 'manage_options', 'test_echo');
    }

    function test_echo(){
        echo "<h1>Hola bebe</h1>";
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
        $settings_tabs['settings_tab_demo'] = __( 'Settings Demo', 'woocommerce-settings-tab-demo' );
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
                'desc' => __( 'This is a paragraph describing the setting. Lorem ipsum yadda yadda yadda. Lorem ipsum yadda yadda yadda. Lorem ipsum yadda yadda yadda. Lorem ipsum yadda yadda yadda.', 'woocommerce-settings-tab-demo' ),
                'id'   => 'wc_settings_tab_demo_description'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_settings_tab_demo_section_end'
            )
        );
        return apply_filters( 'wc_settings_tab_demo_settings', $settings );
    }
}
WP_swiper_slideshow::init();
?>