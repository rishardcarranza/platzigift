<?php
function fl_api_login() {
    register_rest_route(
        'fl',
        'login',
        array(
            'methods' => 'POST',
            'callback' => 'fl_login_callback'
        )
    );
}
add_action('rest_api_init', 'fl_api_login');

function fl_login_callback($request) {

    $credentials = array(
        'user_login' => $request['email'],
        'user_password' => $request['password'],
        'remember' => true,
    );

    $login = wp_signon($credentials);

    return $login->get_error_message();
}