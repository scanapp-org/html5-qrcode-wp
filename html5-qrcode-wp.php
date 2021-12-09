<?php

/*

Plugin Name: QR Code and Barcode scanner for Wordpress
Plugin URI: https://scanapp.org
Description: Free online barcode and QR code scanning plugin bsaed on mebjas/html5-qrcode project
Version: 0.1
Author: Minhaz
Author URI: https://minhazav.dev
License: Apache 2.0
Text Domain: scanapp

*/

/** Register the javascript file. */
function html5_qrcode_shortcode_wp_enqueu_scripts() {
    wp_register_script(
        'html5-qrcode.min',
        plugins_url('/scripts/html5-qrcode.min.js', __FILE__),
        array(),
        '1.0.0',
        'all'
    );

    wp_register_script(
        'html5-qrcode.app',
        plugins_url('/scripts/html5-qrcode.app.js', __FILE__),
        array(),
        '1.0.0',
        'all'
    );
}

/** Returns the HTML5/Javascript code to render when replacing the shortcode. */
function render_html5_qrcode($width="600px", $qrbox="250") {
	return <<<EOD
		<!-- If you change the ID here, also change the ID in scripts/html5-qrcode.app.js -->
		<div id="html5_qrcode_reader" width="$width"></div>
	EOD;
}


// Add this function to the queue.
add_action(
    'wp_enqueue_scripts',
	'html5_qrcode_shortcode_wp_enqueu_scripts');

/**
 * Expecting shortcode like:
 * [html5_qrcode width="600px" qrbox="250" fps="10"]
 */
if (!function_exists('html5_qrcode')) {
    function html5_qrcode_shortcode_wp_shortcode($attributes) {
        global $current_user;
        get_currentuserinfo();
        extract(shortcode_atts(
            array(
                "width" => "600px",
                "height" => "",
                "qrbox" => 250,
                "fps" => 10,
                "alt" => "",
                "class" => ""
            ), $attributes, 'html5_qrcode'
        ));

        wp_enqueue_script('html5-qrcode.min');
        wp_enqueue_script('html5-qrcode.app');
		return render_html5_qrcode($width, $qrbox);
    }
    add_shortcode('html5_qrcode', html5_qrcode_shortcode_wp_shortcode);
}
