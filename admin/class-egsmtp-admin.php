<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       artisanapi.me
 * @since      1.0.0
 *
 * @package    Egsmtp
 * @subpackage Egsmtp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Egsmtp
 * @subpackage Egsmtp/admin
 * @author     Asad Shahbaz <digitalartisan.pioneer@gmail.com>
 */
class Egsmtp_Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->includes();
		$this->init_smtp();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( PLUGIN_NAME_PREFIX.'_admin_style' , plugin_dir_url( __FILE__ ) . 'css/egsmtp-admin.css', array(), PLUGIN_NAME_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( PLUGIN_NAME_PREFIX.'_admin_script', plugin_dir_url( __FILE__ ) . 'js/egsmtp-admin.js', array( 'jquery' ), PLUGIN_NAME_VERSION, false );
	}

	public function includes() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/egsmtp-admin-settings.php';
	}

	public function init_smtp() {
		$options = get_option( 'egsmtp_settings' );
		if ( empty( $options['egsmtp_field_username'] ) || empty( $options['egsmtp_field_password'] ) || empty( $options['egsmtp_field_protocol'] ) ) {
			add_action( 'admin_notices', array( $this, 'setup_notice' ) );
		} else {
			// add_action( 'phpmailer_init', array( $this, 'egsmtp_phpmailer' ) );
		}
	}

	public function egsmtp_phpmailer( $phpmailer ) {
		$options = get_option( 'egsmtp_settings' );
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->Username = $options['egsmtp_field_username'];
    $phpmailer->Password = $options['egsmtp_field_password'];
    $phpmailer->SMTPSecure = $options['egsmtp_field_protocol'];

		if ( 'ssl' === $options['egsmtp_field_protocol'] ) {
			$phpmailer->Port = 465;
		} else {
			$phpmailer->Port = 587;
		}

		if ( 'true' === $options['egsmtp_field_auth'] ) {
			$phpmailer->SMTPAuth = true;
		} else {
			$phpmailer->SMTPAuth = false;
		}

		$phpmailer->FromName = $options['egsmtp_field_from'];
    $phpmailer->From = empty( $options['egsmtp_field_from_mail'] ) ? $options['egsmtp_field_username'] : $options['egsmtp_field_from_mail'];

	}

	public function setup_notice() {
		$class = 'notice notice-warning is-dismissible';
		printf( '<div class="%1$s"><p>Oops! <a href="%2$s">Google SMTP</a> is not configured, please make sure to setup properly before using the service</p></div>', esc_attr( $class ), esc_url( menu_page_url( 'egsmtp', false ) ) );
	}


}
