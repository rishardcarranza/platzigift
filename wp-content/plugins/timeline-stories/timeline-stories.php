<?php
/**
 * Plugin Name:       Lineas de tiempo
 * Plugin URI:        https://sofis.lat
 * Description:       Formulario para cargar las entradas para la linea de tiempo
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Sofis Solutions
 * Author URI:        https://sofis.lat
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       timeline
 */

define("TLS_PATH", plugin_dir_path(__FILE__));

// SHORTCODES
require_once TLS_PATH."/shortcodes/timeline-vertical.php";


// Menu y Custom Post Type
function timeline_stories() {

    $labels = array(
        'name' => 'Lineas de tiempo',
        'singular_name' => 'Linea de tiempo',
        'menu_name' => 'Lineas de tiempo',
    );

    $args = array(
        'label' => 'Lineas de tiempo',
        'description' => 'Formulario para cargar las entradas para la linea de tiempo',
        'labels' => $labels,
        'supports' => array('title','editor','thumbnail','revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-chart-line',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => false,
    );
    register_post_type('timeline', $args);
}

add_action('init', 'timeline_stories');




// register_activation_hook(__FILE__, function () {
// });

// register_deactivation_hook(__FILE__, function () {
//     remove_action('init', 'timeline_stories');
// });