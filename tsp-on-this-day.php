<?php
/*
Plugin Name: TSP On This Day
Plugin URI:  http://www.thesoftwarepeople.com/software/plugins/wordpress/on-this-day-for-wordpress.html
Description: On This Day allows you to <strong>view blog posts with the same month and day in history</strong> on your website. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">TSP Easy Dev</a></strong>.
Version:     1.0.5
Author:      The Software People
Author URI:  http://www.thesoftwarepeople.com/
License:     APACHE v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0
Text Domain: tspotd
*/

require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

define('TSPOTD_PLUGIN_FILE', 				__FILE__ );
define('TSPOTD_PLUGIN_PATH',				plugin_dir_path( __FILE__ ) );
define('TSPOTD_PLUGIN_URL', 				plugin_dir_url( __FILE__ ) );
define('TSPOTD_PLUGIN_BASE_NAME', 			plugin_basename( __FILE__ ) );
define('TSPOTD_PLUGIN_NAME', 				'tsp-on-this-day');
define('TSPOTD_PLUGIN_TITLE', 				'TSP On This Day');
define('TSPOTD_PLUGIN_REQ_VERSION', 		"3.5.1");

// The recommended option would be to require the installation of the standard version and
// bundle the Pro classes into your plugin if needed, this plugin requires both the Easy Dev plugin installation
// and looks for the existence of the Easy Dev Pro libraries
if ( !file_exists ( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ) )
{
	function display_tspotd_notice()
	{
		$message = TSPOTD_PLUGIN_TITLE . ' <strong>was not installed</strong>, plugin requires the installation of <strong><a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Dev">TSP Easy Dev</a></strong>.';
	    ?>
	    <div class="error">
	        <p><?php echo $message; ?></p>
	    </div>
	    <?php
	}//end display_tspotd_notice

	add_action( 'admin_notices', 'display_tspotd_notice' );
	deactivate_plugins( TSPOTD_PLUGIN_BASE_NAME );
	return;
}//endif
else
{
    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ))
    {
    	include_once WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php";
    }//end else
}//end else

global $easy_dev_settings;

require( TSPOTD_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
require( TSPOTD_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');

date_default_timezone_set(get_option('timezone_string'));
//--------------------------------------------------------
// initialize the plugin
//--------------------------------------------------------
$on_this_day 						= new TSP_Easy_Dev( TSPOTD_PLUGIN_FILE, TSPOTD_PLUGIN_REQ_VERSION );

$on_this_day->set_options_handler( new TSP_Easy_Dev_Options_On_This_Day( $easy_dev_settings ), true );

$on_this_day->set_widget_handler( 'TSP_Easy_Dev_Widget_On_This_Day');

$on_this_day->add_link ( 'FAQ',		'http://wordpress.org/extend/plugins/tsp-on-this-day/faq/' );
$on_this_day->add_link ( 'Rate Me',	'http://wordpress.org/support/view/plugin-reviews/tsp-on-this-day' );
$on_this_day->add_link ( 'Support', 'http://lab.thesoftwarepeople.com/tracker/wordpress-otd/issues/new' );

$on_this_day->uses_smarty 					= true;

$on_this_day->uses_shortcodes 				= true;

// Quueue User styles
$on_this_day->add_css( TSPOTD_PLUGIN_URL . 'css' . DS . 'movingboxes.css' );

if ( TSP_Easy_Dev_Tools::this_browser( 'IE', 8 ) )
{
	$on_this_day->add_css( TSPOTD_PLUGIN_URL . 'css' . DS . 'movingboxes-ie.css' );
}//endif
	
if ( TSP_Easy_Dev_Tools::this_browser( 'IE' ) )
{
	$on_this_day->add_css( TSPOTD_PLUGIN_URL . TSPOTD_PLUGIN_NAME . '.ie.css' );
}//endif
else
{
	$on_this_day->add_css( TSPOTD_PLUGIN_URL . TSPOTD_PLUGIN_NAME . '.css' );
}//endelse

// Queue User Scripts
$on_this_day->add_script( TSPOTD_PLUGIN_URL . 'js' . DS . 'jquery.movingboxes.js', array('jquery') );
$on_this_day->add_script( TSPOTD_PLUGIN_URL . 'js' . DS . 'slider-scripts.js', array('jquery') );
$on_this_day->add_script( TSPOTD_PLUGIN_URL . 'js' . DS . 'scripts.js',  array('jquery') );

// Queue Admin Scripts
$on_this_day->add_script( TSP_EASY_DEV_ASSETS_JS_URL . 'admin-script.js',  array('jquery','jquery-ui-tabs'), true );

// Queue Admin styles
$on_this_day->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'font-awesome.min.css', true );
$on_this_day->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'admin-style.css', true );
$on_this_day->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'style.css', true );

$on_this_day->set_plugin_icon( TSPOTD_PLUGIN_URL . 'images' . DS . 'tsp_icon_16.png' );

$on_this_day->add_shortcode ( TSPOTD_PLUGIN_NAME );
$on_this_day->add_shortcode ( 'tsp_featured_posts' ); //backwards compatibility

$on_this_day->run( TSPOTD_PLUGIN_FILE );

function tspotd_widgets_init()
{
	global $on_this_day;
	
	register_widget ( $on_this_day->get_widget_handler() ); 
	apply_filters( $on_this_day->get_widget_handler().'-init', $on_this_day->get_options_handler() );
}// end tspotd_widgets_init

// Initialize widget - Required by WordPress
add_action('widgets_init', 'tspotd_widgets_init');
?>