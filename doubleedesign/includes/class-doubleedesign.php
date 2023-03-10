<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Doubleedesign
 * @subpackage Doubleedesign/includes
 * @author     Leesa Ward <leesa@doubleedesign.com.au>
 */
class Doubleedesign {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Doubleedesign_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected Doubleedesign_Loader $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected string $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected string $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->version = DOUBLEEDESIGN_VERSION;
        $this->plugin_name = 'doubleedesign';

        $this->load_dependencies();
        $this->define_custom_post_types();
        $this->define_custom_taxonomies();
        $this->define_nav_menus();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->hack_the_rest_api();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @return   void
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies(): void {

        /**
         * The class responsible for the definitions of custom post types, taxonomies, etc.
         * for the Portfolio functionality
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-doubleedesign-portfolio.php';

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-doubleedesign-loader.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-doubleedesign-admin.php';

        /**
         * The class responsible for defining customisations and additional endpoints for the REST API.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-doubleedesign-rest-controller.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-doubleedesign-public.php';

        $this->loader = new Doubleedesign_Loader();

    }


    /**
     * Define custom post types
     *
     * @return void
     * @since    1.0.0
     * @access   private
     */
    private function define_custom_post_types(): void {
        $portfolio = new Doublee_Portfolio();

        $this->loader->add_action('init', $portfolio, 'create_portfolio_item_cpt', 20);
    }


    /**
     * Define custom taxonomies
     *
     * @return void
     * @since    1.0.0
     * @access   private
     */
    private function define_custom_taxonomies(): void {
        $portfolio = new Doublee_Portfolio();

        $this->loader->add_action('init', $portfolio, 'create_portfolio_item_cpt', 20);
    }


    /**
     * Define nav menu locations
     *
     * @return void
     * @since    1.0.0
     * @access   private
     */
    private function define_nav_menus(): void {
        $plugin_admin = new Doubleedesign_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('init', $plugin_admin, 'register_my_menus', 20);
    }


    /**
     * Register the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks(): void {
        $plugin_admin = new Doubleedesign_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

    }


    /**
     * Register the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks(): void {
        $plugin_public = new Doubleedesign_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }


    /**
     * Register customisations and additional endpoints for the REST API
     *
     * @return void
     * @since    1.0.0
     * @access   private
     */
    private function hack_the_rest_api(): void {
        $controller = new Doubleedesign_REST_Controller();

        $this->loader->add_action('rest_api_init', $controller, 'make_menu_available_in_rest');
        $this->loader->add_action('rest_api_init', $controller, 'return_individual_blocks_in_rest');
    }


    /**
     * Run the loader to execute the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run(): void {
        $this->loader->run();
    }


    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_plugin_name(): string {
        return $this->plugin_name;
    }


    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Doubleedesign_Loader    Orchestrates the hooks of the plugin.
     * @since     1.0.0
     */
    public function get_loader(): Doubleedesign_Loader {
        return $this->loader;
    }


    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version(): string {
        return $this->version;
    }

}
