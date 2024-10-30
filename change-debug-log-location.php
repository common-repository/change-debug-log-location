<?php
/*
Plugin Name: Change Debug Log Location
Description: Custom code for Change debug log location.
Author: Jose Mortellaro
Author URI: https://josemortellaro.com/
Domain Path: /languages/
Version: 0.0.2
Text Domain: cdll
Domain Path: /languages/
*/
/*  This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//Actions triggered after plugin activation
function eos_cdll_plugin_activation(){
	require untrailingslashit( dirname( __FILE__ ) ).'/cdll-file.php';
  eos_cdll_update_wp_config( true );
}
register_activation_hook( __FILE__, 'eos_cdll_plugin_activation' );


//Actions triggered after plugin deaactivation
function eos_cdll_plugin_deactivation(){
  require untrailingslashit( dirname( __FILE__ ) ).'/cdll-file.php';
  eos_cdll_update_wp_config( false );
}
register_deactivation_hook( __FILE__, 'eos_cdll_plugin_deactivation' );

//It adds the link to the debug log file the plugins page
function eos_cdll_plugin_add_settings_link( $links ) {
    $settings_link = '<a class="eos-cdll-setts" href="'.get_site_url().'/debug-'.substr( md5( ABSPATH ),0,8 ).'.log" target="_cdll_debug_log">' . __( 'Debug Log','cdll' ). '</a>';
    array_push( $links, $settings_link );
  	return $links;
}

add_filter( "plugin_action_links_".untrailingslashit( plugin_basename( __FILE__ ) ),'eos_cdll_plugin_add_settings_link' );
