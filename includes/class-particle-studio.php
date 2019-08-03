<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wpsocket.com
 * @since      1.0.0
 *
 * @package    Particle_Studio
 * @subpackage Particle_Studio/includes
 */

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
 * @package    Particle_Studio
 * @subpackage Particle_Studio/includes
 * @author     wpsocket <admin@wpsocket.com>
 */
class Particle_Studio {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Particle_Studio_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	public $plugin_filename = 'particle studio/particle-studio.php';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

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
		if ( defined( 'PARTICLE_STUDIO_VERSION' ) ) {
			$this->version = PARTICLE_STUDIO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'particle studio';
		$this->plugin_filename = plugin_basename(__FILE__);
		

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Particle_Studio_Loader. Orchestrates the hooks of the plugin.
	 * - Particle_Studio_i18n. Defines internationalization functionality.
	 * - Particle_Studio_Admin. Defines all hooks for the admin area.
	 * - Particle_Studio_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-particle-studio-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-particle-studio-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-particle-studio-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-particle-studio-public.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/particle-studio-admin-display.php';
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/particle-studio-deactivation-popup.php';

		$this->loader = new Particle_Studio_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Particle_Studio_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Particle_Studio_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_filename = "particle studio/particle-studio.php";

		$plugin_admin = new Particle_Studio_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ps_admin_menu' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'ps_row_meta', 10, 2 );
		$this->loader->add_filter('plugin_action_links_' . $plugin_filename, $plugin_admin, 'ps_action_links' );
		$this->loader->add_action( 'current_screen', $plugin_admin, 'wporg_current_screen_example' );
		$this->loader->add_action('after_body_open_tag', $plugin_admin, 'wporg_current_screen_example');
		$this->loader->add_filter('page_row_actions', $plugin_admin, 'ps_page_row_actions', 10, 2);
		$this->loader->add_action( 'post_action_particle-studio', $plugin_admin, 'handle_particle_studio', 10, 1 );
		//$this->loader->add_action( 'save_post', $plugin_admin, 'ps_post_update' );

		//Ajax Request
		$this->loader->add_action( 'wp_ajax_ps_post_update', $plugin_admin, 'ps_handle_ajax_post_request' );
		$this->loader->add_action( 'wp_ajax_nopriv_ps_post_update', $plugin_admin, 'ps_handle_ajax_post_request' );
	
		//Remove 
		remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Particle_Studio_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {


		$ps_admin_post_url = admin_url( 'post.php');
		$ps_post_id = $_GET['post'];
		if(($_GET['post'] == $ps_post_id) && $_GET['action'] == 'ps'){
			
			include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/template/index.php';

		}

		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Particle_Studio_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
