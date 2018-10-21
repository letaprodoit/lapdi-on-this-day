<?php
    /*
    Plugin Name: LAPDI On This Day
    Plugin URI:  https://www.letaprodoit.com/apps/plugins/wordpress/on-this-day-for-wordpress
    Description: On This Day allows you to <strong>view blog posts with the same month and day in history</strong> on your website. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">LAPDI Easy Dev</a></strong>.
    Version:     1.0.6
    Author:      Let A Pro Do IT!
    Author URI:  http://www.letaprodoit.com/
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
    define('TSPOTD_PLUGIN_TITLE', 				'On This Day');
    define('TSPOTD_PLUGIN_REQ_VERSION', 		"3.5.1");

    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php" ))
    {
        include_once WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php";
    }//end else
    else
        return;

    global $easy_dev_settings;

    require( TSPOTD_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
    require( TSPOTD_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');

    if (!empty(get_option('timezone_string')))
        date_default_timezone_set(get_option('timezone_string'));
    //--------------------------------------------------------
    // initialize the plugin
    //--------------------------------------------------------
    $on_this_day 						= new TSP_Easy_Dev( TSPOTD_PLUGIN_FILE, TSPOTD_PLUGIN_REQ_VERSION );

    $on_this_day->set_options_handler( new TSP_Easy_Dev_Options_On_This_Day( $easy_dev_settings ), true );

    $on_this_day->set_widget_handler( 'TSP_Easy_Dev_Widget_On_This_Day');

    $on_this_day->add_link ( 'FAQ',          preg_replace("/\%PLUGIN\%/", TSPOTD_PLUGIN_NAME, TSP_WORDPRESS_FAQ_URL ));
    $on_this_day->add_link ( 'Rate Me',      preg_replace("/\%PLUGIN\%/", TSPOTD_PLUGIN_NAME, TSP_WORDPRESS_RATE_URL ) );
    $on_this_day->add_link ( 'Support',      preg_replace("/\%PLUGIN\%/", 'wordpress-otd', TSP_LAB_BUG_URL ));

    $on_this_day->uses_shortcodes 				= true;

    // Quueue User styles
    $on_this_day->add_css( TSPOTD_PLUGIN_URL . 'assets/css' . DS . 'movingboxes.css' );

    if ( TSP_Easy_Dev_Tools::this_browser( 'IE', 8 ) )
    {
        $on_this_day->add_css( TSPOTD_PLUGIN_URL . 'assets/css' . DS . 'movingboxes-ie.css' );
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
    $on_this_day->add_script( TSPOTD_PLUGIN_URL . 'assets/js' . DS . 'jquery.movingboxes.js', array('jquery') );
    $on_this_day->add_script( TSPOTD_PLUGIN_URL . 'assets/js' . DS . 'slider-scripts.js', array('jquery') );
    $on_this_day->add_script( TSPOTD_PLUGIN_URL . 'assets/js' . DS . 'scripts.js',  array('jquery') );

    $on_this_day->set_plugin_icon( TSP_EASY_DEV_ASSETS_IMAGES_URL . 'icon_16.png' );

    $on_this_day->add_shortcode ( TSPOTD_PLUGIN_NAME );

    $on_this_day->run( TSPOTD_PLUGIN_FILE );

    // Initialize widget - Required by WordPress
    add_action('widgets_init', function () {
        global $on_this_day;

        register_widget ( $on_this_day->get_widget_handler() );
        apply_filters( $on_this_day->get_widget_handler().'-init', $on_this_day->get_options_handler() );
    });