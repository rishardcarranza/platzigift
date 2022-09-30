<?php
function fl_script_registro() {
    // plugins_url:  Otra forma de hacer referencia al archivo en la carpeta de plugins
    wp_register_script('fl-registro', plugins_url('./src/handler-form.js', __FILE__));
    wp_localize_script('fl-registro', 'fl', array(
        'rest_url' => rest_url('fl'),
    ));
}
add_action("wp_enqueue_scripts", "fl_script_registro");


function fl_register_blocks() {
    wp_enqueue_script('fl-registro');
    
    $assets_file = include_once FL_PATH.'/blocks/register/build/index.asset.php';

    wp_register_script(
        'fl-register-block',
        plugins_url('./build/index.js', __FILE__),
        $assets_file['dependencies'],
        $assets_file['version']
    );

    // Registrar los estilos css
    wp_register_style(
        'fl-register-block',
        plugins_url('./build/index.css', __FILE__),
        array(),
        $assets_file['version']
    );
}
add_action('init', 'fl_register_blocks');

register_block_type(
    'fl/register',
    array(
        'editor_script' => 'fl-register-block',
        'script' => 'fl-registro',
        'style' => 'fl-register-block'
    )
);

?>