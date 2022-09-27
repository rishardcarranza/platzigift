<?php

function fl_script_login() {
    // plugins_url:  Otra forma de hacer referencia al archivo en la carpeta de plugins
    wp_register_script("fl-login", plugins_url("../assets/js/login.js",__FILE__));
    wp_localize_script('fl-login', 'fl', array(
        'rest_url' => rest_url('fl'),
        'home_url' => home_url()
    ));
}
add_action("wp_enqueue_scripts","fl_script_login");

function fl_add_login_form(){
    wp_enqueue_script("fl-login");

    $response = '
    <div class="signin">
        <div class="signin__container">
            <form class="signin__form" id="signin">
                <div class="signin__email name--campo">
                    <label for="email">Email address</label>
                    <input name="email" type="email" id="email">
                </div>
                <div class="signin__pass name--campo">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password">
                </div>
                <div class="signin__submit">
                    <input type="submit" value="Log in">
                </div>
                <div class="signin_create-link">
                    <a href="'.home_url("sign-up").'">Sign up</a>
                </div>
                <div class="msg"></div>
            </form>
            <div class="message"></div>
        </div>
    </div>
    ';

    return $response;
}

add_shortcode("fl_login","fl_add_login_form");