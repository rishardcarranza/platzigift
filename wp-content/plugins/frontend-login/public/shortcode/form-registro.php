<?php

function fl_script_registro() {
    // plugins_url:  Otra forma de hacer referencia al archivo en la carpeta de plugins
    wp_register_script('fl-registro', plugins_url('../assets/js/registro.js', __FILE__));
    wp_localize_script('fl-registro', 'fl', array(
        'rest_url' => rest_url('fl'),
    ));
}
add_action("wp_enqueue_scripts", "fl_script_registro");

function fl_add_register_form() {
    wp_enqueue_script('fl-registro');

    $response = '
    <div class="signin">
        <div class="signin__container">
            <h1 class="sigin__titulo">Register</h1>
            <form class="signin__form" id="signup">
                <div class="signin__name name--campo">
                    <label for="Name">Name</label>
                    <input name="name" type="text" id="name">
                </div>
                <div class="signin__email name--campo">
                    <label for="email">Email</label>
                    <input name="email" type="email" id="email">
                </div>
                <div class="signin__pass name--campo">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password">
                </div>
                <div class="signin__submit">
                    <input type="submit" value="Create">
                </div>
            </form>
            <div class="message"></div>
        </div>
    </div>
    ';

    return $response;
}

add_shortcode('fl_registro', 'fl_add_register_form');