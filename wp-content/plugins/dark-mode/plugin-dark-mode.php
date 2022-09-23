<?php
// Plugin name: Modo Oscuro
// Description: Activa el modo oscuro en tu theme
// version: 1.0
// Author: Ricardo Carranza
// Author URI: https://github.com/rishardcarranza


function estilos_plugin() {

    $estilos_url = plugin_dir_url(__FILE__);

    wp_enqueue_style('dark_mode',$estilos_url.'/assets/css/estilo.css','','1.0','all');
}

add_action('wp_enqueue_scripts', 'estilos_plugin');

?>