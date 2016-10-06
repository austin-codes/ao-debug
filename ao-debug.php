<?php
/**
 * Plugin Name: AO Debug
 * Plugin URI:
 * Description: Debug help
 * Author: aodev.io
 * Version: 0.0.1
 * Author URI: http://aodev.io
 */


 defined('ABSPATH') or die("YOU SHALL NOT PASS");

 if (!defined('AO_PLUGINS_PATH')) {
     define( 'AO_PLUGINS_PATH', plugin_dir_path(dirname(__FILE__)) );
 }
 if (!defined('AO_URL')) {
     define( 'AO_URL', "http://aodev.io" );
 }

 if (!defined('AO_DB_DIR')) {
  define( 'AO_DB_DIR', AO_PLUGINS_PATH . 'ao-debug/' );
 }
 else {
     if (is_admin()) {
         function aodb_dir_constant_error() {
             ?>
             <div class="error">
                 <p><?php echo "AO Debug Error: AO_DB_DIR previously defined. There is an obvious issue here. You might have two versions of the same plugin or a conflicting plugin exists."; ?></p>
             </div>
             <?php
         }
         add_action("admin_notices", "aodb_dir_constant_error");
     }
 }

 if (!defined('AO_DB_URL')) {
  define( 'AO_DB_URL', plugins_url( 'ao-debug/') );
 }
 else {
     if (is_admin()) {
         function aodb_url_constant_error() {
             ?>
             <div class="error">
                 <p><?php echo "AO Debug Error: AO_DB_URL previously defined. There is an obvious issue here. You might have two versions of the same plugin or a conflicting plugin exists."; ?></p>
             </div>
             <?php
         }
         add_action("admin_notices", "aodb_url_constant_error");
     }
 }

/**
 * Because for some reason, not everyone has this
 * in their theme....
 */
add_filter('widget_text', 'do_shortcode');


require_once( AO_DB_DIR . 'ao-functions.php' );

// So we can use the is_user_logged_in() function
require_once( ABSPATH . 'wp-includes/pluggable.php' );


add_action( 'wp_enqueue_scripts', 'ao_db_enqueue');
add_action( 'admin_enqueue_scripts', 'ao_db_enqueue');

function ao_db_enqueue() {
    ao_db_enqueue_styles();
    //aocal_enqueue_scripts();
}

/**
 * Enqueue the CSS doc, and apply a filter that allows for
 * future users to enqueue styles here as well.
 */
function ao_db_enqueue_styles() {
    wp_register_style( 'ao-db-styles', AO_DB_URL . 'css/styles.css' );
    //wp_register_style( 'aocal-font-awesome-styles', plugins_url( 'ao-calendar/scss/font-awesome/css/font-awesome.min.css' ) );
    $styles = array('ao-db-styles');
    $styles = apply_filters( 'ao-db-enqueue-styles', $styles );
    foreach ($styles as $style) {
        wp_enqueue_style( $style );
    }
}


/**
 * Execute admin functionlity
 */
function ao_db_execute_admin() {
    require_once( AO_DB_DIR . 'includes/ao-debug-admin.php' );
}


if ( is_admin() && is_user_logged_in() ) {
    ao_db_execute_admin();
}
