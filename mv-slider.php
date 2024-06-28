<?php

/** 
 * Plugin Name: MV Slider
 * Plugin URI: https://wordpress.org/mv-slider
 * Description: Bruno's plugin description
 * Version: 1.0
 * Requires at least: Wordpress 5.6
 * Author: Bruno Penner
 * Author URI: https://brunopenner.com.au/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mv-slider
 * Domain Path: /languages
 */

/*
MV Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

MV Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with MV Slider. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('MV_Slider')) {
    class MV_Slider
    {
        function __construct()
        {
            $this->define_constants();

            add_action('admin_menu', array($this, 'add_menu'));

            require_once (MV_SLIDER_PATH . 'post-types/class.mv-slider-cpt.php');
            $MV_Slider_Post_Type = new MV_Slider_Post_Type();
        }

        public function define_constants()
        {
            define('MV_SLIDER_PATH', plugin_dir_path(__FILE__));
            define('MV_SLIDER_URL', plugin_dir_url(__FILE__));
            define('MV_SLIDER_VERSION', '1.0.0');
        }

        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type('mv-slider');
        }

        public static function uninstall()
        {
        }

        public function add_menu()
        {
            add_menu_page(
                'MV Slider Options',
                'MV Slider',
                'manage_options', //For admin roles
                // 'edit_pages' // For editors role
                'mv_slider_admin',
                array($this, 'mv_slider_settings_page'),
                'dashicons-images-alt2',
                // 10  //optional, display order priority
            );
        }

        public function mv_slider_settings_page()
        {
            require_once (MV_SLIDER_PATH . 'views/mv-slider_page.php');
        }
    }
}

if (class_exists('MV_Slider')) {
    register_activation_hook(__FILE__, array('MV_slider', 'activate'));
    register_deactivation_hook(__FILE__, array('MV_slider', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MV_slider', 'uninstall'));
    $mv_slider = new MV_Slider();
}
