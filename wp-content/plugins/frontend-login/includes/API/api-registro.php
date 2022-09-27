<?php
function fl_api_registro() {
    register_rest_route(
        'fl',
        'registro',
        array(
            'methods' => 'POST',
            'callback' => 'fl_registro_callback'
        )
    );
}
add_action('rest_api_init', 'fl_api_registro');

function fl_registro_callback($request) {

    $is_user_exists = get_user_by('login', $request['name']);
    $is_email_exists = get_user_by('email', $request['email']);

    if ($is_user_exists) {
        return array("success" => false, "msg" => "El usuario ya existe");
    }
    if ($is_email_exists) {
        return array("success" => false, "msg" => "El usuario con ese correo ya existe");
    }

    $args = array(
        'user_login' => $request['name'],
        'user_pass' => $request['password'],
        'user_email' => $request['email'],
        'role' => 'cliente'
    );
    $user = wp_insert_user($args);

    return array("success" => true, "msg" => "Usuario registrado correctamente");
}