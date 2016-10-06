<?php
/**
 * Generic Functions for the AO
 *
 * @author aodev.io
 * @since 1.0.0
 */

/**
* dump function for debug
*/
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE) {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left; width: 100% !important; font-size: 12px !important;">' . $label . ' => ' . $output . '</pre>';
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);exit;
    }
}



if (!function_exists('ao_load_view')) {
    function ao_load_view($view, $data = array()) {
        global $ao_data;
        $ao_data = $data;
        $path = trailingslashit(dirname(__FILE__)) . 'views';
        if (file_exists(trailingslashit($path) . $view . '.php')) {
            include( trailingslashit($path) . $view . '.php' );
        }
        $ao_data = array();
    }
}
