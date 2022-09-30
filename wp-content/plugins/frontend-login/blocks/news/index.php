<?php

function fl_news_render_callback($block_attributes, $block_content) {
    $block_classes = isset($block_attributes['className']) ? $block_attributes['className'].'wp-block-fl-news' : 'wp-block-fl-news';

    $args = array(
        'posts_per_page' => -1,
    );

    if (isset($block_attributes['category'])) {
        $args['category'] = $block_attributes['category'];
    }
    // var_dump($args);
    // exit();

    $news = get_posts($args);
    $render = '';

    if (count($news) > 0) {
        $render .= '<div class="'.esc_attr($block_classes).'">';
            $render .= '<h3>Te interesa leer esto</h3>';
            $render .= '<ul className="posts">';
            foreach ($news as $new) {
                $render .= '<li>';
                    $render .= '<a href="'.get_the_permalink($new->ID).'">';
                    $render .= $new->post_title;
                    $render .= '</a>';
                $render .= '</li>';
            }
            $render .= '</ul>';
        $render .= '</div>';
    }

    return $render;
}

function fl_news_block_init() {
    register_block_type(__DIR__, array(
        'render_callback' => 'fl_news_render_callback'
    ));
}
add_action('init', 'fl_news_block_init');


?>