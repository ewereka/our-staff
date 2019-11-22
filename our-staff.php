<?php
/*
Plugin Name: Our Staff
Plugin URI:
Description: Staff Directory Plugin for WordPress, also includes WPBakery/Visual Composer Elements
Version:     1.0.0
Author:      Ewereka!
Author URI:  http://ewereka.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: com.ewereka.our-staff
*/

// Make sure we don"t expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I\"m just a plugin, not much I can do when called directly.";
	exit;
}
define( "EWEREKA__OUR_STAFF__VERSION", "1.0.0" );
define( "EWEREKA__OUR_STAFF__MINIMUM_WP_VERSION", "4.8" );
define( "EWEREKA__OUR_STAFF__PLUGIN_URL", plugin_dir_url( __FILE__ ) );
define( "EWEREKA__OUR_STAFF__PLUGIN_DIR", plugin_dir_path( __FILE__ ) );

require_once( EWEREKA__OUR_STAFF__PLUGIN_DIR . "class.Ewereka__Our_Staff.php" );

add_action( "init", array( "Ewereka__Our_Staff", "init" ) );
add_action('admin_menu', array('Ewereka__Our_Staff', 'add_team_meta');
add_action('save_post', array('Ewereka__Our_Staff', 'save_team_meta');
add_action('vc_before_init', array('Ewereka__Our_Staff', 'integrate_with_vc', 20);
