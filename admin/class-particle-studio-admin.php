<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wpsocket.com
 * @since      1.0.0
 *
 * @package    Particle_Studio
 * @subpackage Particle_Studio/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Particle_Studio
 * @subpackage Particle_Studio/admin
 * @author     wpsocket <admin@wpsocket.com>
 */
class Particle_Studio_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {


		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function ps_admin_menu() {
		add_menu_page( 'Particle Studio', 'Particle Studio', 'manage_options', 'particlestudio', 'particlestudio_admin_page', 'dashicons-tickets', 6  );
		add_submenu_page( 'particlestudio', 'Skin Editor', 'Skin Editor', 'manage_options', 'skin-editor');
		add_submenu_page( 'particlestudio', 'Template Editor', 'Template Editor', 'manage_options', 'template-editor');
		add_submenu_page( 'particlestudio', 'Content Editor', 'Content Editor', 'manage_options', 'content-editor');
		add_submenu_page( 'particlestudio', 'Image Marketplace', 'Image Marketplace', 'manage_options', 'image-marketplace');
		add_submenu_page( 'particlestudio', 'Font Marketplace', 'Font Marketplace', 'manage_options', 'font-marketplace');

	}

	
	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Particle_Studio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Particle_Studio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(($_GET['post']) && $_GET['action'] == 'ps'){

			wp_enqueue_style( $this->plugin_name, 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), time(), 'all' );
			wp_enqueue_style( $this->plugin_name, 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), time(), 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'template/index.php.css', array(), time(), 'all' );
		}
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/particle-studio-admin.css', array(), time(), 'all' );
		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Particle_Studio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Particle_Studio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, 'https://code.jquery.com/jquery-3.3.1.min.js', array(), time(), false );
		wp_enqueue_script( $this->plugin_name, 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( $this->plugin_name, 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( $this->plugin_name, 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'template/index.php.js', array( 'jquery' ), time(), false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/particle-studio-admin.js', array( 'jquery' ), time(), false );

	}

	//plugin_row_meta
	function ps_row_meta( $links, $file ) {

		if ( strpos( $file, 'particle-studio.php' ) !== false ) {
			$new_links = array(
					'donate' => '<a href="http://market.wpsocket.com" target="_blank">Marketplace</a>',
					'doc' => '<a href="http://doc.wpsocket.com" target="_blank">Documentation</a>'
					);
			
			$links = array_merge( $links, $new_links );
		}
		
		return $links;
	}

	//add_action_links
	function ps_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=particlestudio' ) . '">Settings</a>';
		return $links;
	}
	
	function wporg_current_screen_example( $current_screen ) {
		if ( 'plugins' == $current_screen->id) { 
			add_action('admin_footer', 'ps_deactivation_form');
			function ps_deactivation_form(){ ?>

				<div id="ps-deact-popup" class="overlay">
					<div class="popup">
						<form action="" method="post">
							<h2>Quick Feedback</h2>
							<a class="close" href="#">&times;</a>
							<div class="content">
								Are you sure want to deactivate this plugin
							</div>
							<input class="button-primary deactivate-button" type="button" value="Submit and Deactivate">
						</form>
					</div>
				</div>
		
			<?php }
		}
	}


	function ps_page_row_actions($actions, $page_object)
	{
		$admin_post_url = admin_url( 'post.php?post=', 'http' );
		$actions['particle_studio'] = '<a href="' . $admin_post_url . $page_object->ID . '&action=ps' . '">' . __('Edit with Particle Studio') . '</a>';
		//var_dump($page_object);
		return $actions;
	}	
	function ps_handle_ajax_post_request() {

		die(); 
		
		$post_title	= isset($_POST['post_title'])?trim($_POST['post_title']):"";
		$post_content	= isset($_POST['post_content'])?trim($_POST['post_content']):"";
		$response	= array();
		$response['message']	= "Successfull Request";
		echo json_encode($response);
		exit;
	}

	function php_to_js_conversion(){ 
		wp_register_script ('php_js_conversion', plugins_url('js/php-conversion-library.js', __FILE__));
		wp_enqueue_script ('php_js_conversion');
		$plugin_info = array(
			"plugin_url" => plugin_dir_path( __FILE__ ),
			"plugin_ur" => "2",
			"plugin_uri" => "3"
		);
		$my_json_str = json_encode($plugin_info); 

		$params = array(
			'plugin_info' => $my_json_str,
		);


		wp_localize_script('php_js_conversion', 'php_params', $params);
		
	}

	

	function footertestjs(){
		?>
		<script>
		jQuery(document).ready(function() {
			var my_json_str = php_params.plugin_info.replace(/&quot;/g, '"');
			var my_php_arr = jQuery.parseJSON(my_json_str);
		});
		</script>
		<?php
	}

	



}
