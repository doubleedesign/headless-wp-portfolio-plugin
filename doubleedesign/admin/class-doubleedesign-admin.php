<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.doubleedesign.com.au
 * @since      1.0.0
 *
 * @package    Doubleedesign
 * @subpackage Doubleedesign/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Doubleedesign
 * @subpackage Doubleedesign/admin
 * @author     Leesa Ward <leesa@doubleedesign.com.au>
 */
class Doubleedesign_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private string $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private string $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/doubleedesign-admin.css', array(), $this->version, 'all');
    }


    /**
     * Register the JavaScript for the admin area.
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/doubleedesign-admin.js', array('jquery'), $this->version, false);
    }


    /**
     * Register nav menu locations
     * @wp-hook
     * @return void
     */
    function register_my_menus(): void {
        register_nav_menus(array(
            'main-menu' => 'Main menu'
        ));
    }

}
