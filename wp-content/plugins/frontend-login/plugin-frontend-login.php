<?php
/**
 * Plugin Name:       Frontend Login
 * Plugin URI:        https://github.com/rishardcarranza
 * Description:       Formulario de login y registro para yardn sales
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Richard Carranza
 * Author URI:        https://github.com/rishardcarranza
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:      yardsale
 */

 define("FL_PATH", plugin_dir_path(__FILE__));

 // API Rest
 require_once FL_PATH."/includes/API/api-registro.php";
 require_once FL_PATH."/includes/API/api-login.php";

 // Shortcodes
//  require_once FL_PATH."/public/shortcode/form-registro.php";
 require_once FL_PATH."/public/shortcode/form-login.php";
 
 // Custom Blocks
//  require_once FL_PATH.'/blocks/register/index.php';
 require_once FL_PATH.'/blocks/news/index.php';

 
 // Crear roles al activar plugin
 function fl_plugin_activate() {
    add_role('cliente', 'Cliente', array('read_post'));
 }
 register_activation_hook(__FILE__, 'fl_plugin_activate');
 
 
 // Cuando se desactive el plugin
 function fl_plugin_deactivate() {
     remove_role('cliente');
}
register_deactivation_hook(__FILE__, 'fl_plugin_deactivate');


