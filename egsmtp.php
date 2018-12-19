<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              artisanapi.me
 * @since             1.0.0
 * @package           Egsmtp
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Google SMTP
 * Plugin URI:        artisanapi.me/apps/egsmtp
 * Description:       An easy to setup SMTP using your own google's gmail account.
 * Version:           1.0.0
 * Author:            Artisan Asad
 * Author URI:        artisanapi.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       egsmtp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version & prefix.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'PLUGIN_NAME_PREFIX', 'egsmtp' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-egsmtp-activator.php
 */
function activate_egsmtp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egsmtp-activator.php';
	Egsmtp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-egsmtp-deactivator.php
 */
function deactivate_egsmtp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egsmtp-deactivator.php';
	Egsmtp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_egsmtp' );
register_deactivation_hook( __FILE__, 'deactivate_egsmtp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-egsmtp.php';

/**
 * Begins initialization of the plugin.
 *
 *
 * @since    1.0.0
 */
 $egsmtp = new Egsmtp(); 
