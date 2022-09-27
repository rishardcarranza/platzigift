<?php

function tls_timeline_style() {
    wp_register_style('style-timeline', plugins_url('../assets/css/style.css', __FILE__), '', '1.0', 'all');
}
add_action("wp_enqueue_scripts", "tls_timeline_style");

function tls_timeline_vertical() {
    wp_enqueue_style('style-timeline');

    $args = array(
        'post_type' => 'timeline',
        'post_per_page' => -1,
        'order' => 'ASC',
        'order_by' => 'post_date',
    );

    $stories = new WP_Query($args);

    $response = '
    <div class="container-timeline">
        <div class="timeline">';

    $direction = 'left';
    if ($stories->have_posts()) {
        while ($stories->have_posts()) {
            $stories->the_post();
            $response .= '
            <div class="capsule '.$direction.'">
                <div class="content">
                    <img src="'.get_the_post_thumbnail_url().'" />
                    <h2>'.get_the_title().'</h2>
                    <p>'.get_the_content().'</p>
                </div>
            </div>';
            $direction = ($direction == 'left') ? 'right' : 'left';
        }
    }
    $response .= '
        </div> 
    </div>';

    return $response;
}
add_shortcode('tls_timeline_v', 'tls_timeline_vertical');