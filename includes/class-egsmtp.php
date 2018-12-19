<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       artisanapi.me
 * @since      1.0.0
 *
 * @package    Egsmtp
 * @subpackage Egsmtp/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 *
 * @since      1.0.0
 * @package    Egsmtp
 * @subpackage Egsmtp/includes
 * @author     Asad Shahbaz <digitalartisan.pioneer@gmail.com>
 */
class Egsmtp {

	/**
	* @var Instance of the class
	* @since 1.0.0
	*/
	protected static $_instance = null;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies and define the locale.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->_init();
	}

	private function _init() {
		$this->load_dependencies();
		$this->fire_dependencies();
		$this->set_locale();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-egsmtp-admin.php';
	}

	/**
	 * Fire the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function fire_dependencies() {
		new Egsmtp_Admin();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Egsmtp_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'egsmtp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	// /**
	// * Main Instance
	// *
	// * @since 1.0.0
	// * @static
	// * @return Main instance
	// */
	// public static function initialize() {
	// 	if ( is_null( self::$_instance ) ) {
	// 		self::$_instance = new self();
	// 	}
	// 	return self::$_instance;
	// }

}
