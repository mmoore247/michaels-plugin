<?php

/*
Plugin Name: Michael's Plugin
Plugin URI: https://justbloat.com/michaels-plugin
Description: This plugin will not add any value to your site. When activated it will display a message on its usefulness.
Author: Michael Moore
Author URI: https://justbloat.com
Version: 1.1
Text Domain: michaels-plugin
License: GPLv2
*/
function mam_mp_display_notice() {
	$user_id = get_current_user_id();
	if ( ! get_user_meta( $user_id, 'mam_mp_dismiss_notice' ) ) {
		echo '<div class="mam_mp_dismiss_notice">' . _e( 'Thanks for installing my plugin that will do nothing!', 'michaels-plugin' ) . __('<a href="?mam_mp_dismiss_notice">Dismiss</a></div>');
		}
}
add_action( 'admin_notices', 'mam_mp_display_notice' );
function mam_mp_dismiss_notice() {
	
	if ( isset( $_GET['mam_mp_dismiss_notice'] ) ) {
		$user_id = get_current_user_id();
		add_user_meta( $user_id, 'mam_mp_dismiss_notice', 'true', true );
		}
}
add_action( 'admin_init', 'mam_mp_dismiss_notice' );
register_uninstall_hook( __FILE__, 'plugin_uninstall' );
function plugin_uninstall () {
	$all_user_ids = get_users( 'fields=ID' );
	foreach ( $all_user_ids as $user_id ) {
		delete_user_meta( $user_id, 'mam_mp_dismiss_notice' );
}
}