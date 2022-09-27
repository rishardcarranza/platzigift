<?php

function init_template() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    // Para insertar un menu
    register_nav_menus(
        array(
            'top_menu' => 'Menu Principal'
        )
    );
}

add_action('after_setup_theme', 'init_template');

function assets() {
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css', '', '5.2.1', 'all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap', '', '2', 'all');
    wp_register_style('customcss', get_template_directory_uri().'/assets/css/style.css', '', '1', 'all');

    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap','montserrat','customcss'), '1.0', 'all');

    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', '', '2.11.6', true);
    wp_enqueue_script('bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js', array('jquery','popper'), '5.2.1', true);
    wp_enqueue_script('customjs', get_template_directory_uri().'/assets/js/custom.js', '', '1.0.0', true);

    // Enviar informacion php a un archivo js
    // URL: admin-ajax.php para todas las peticiones ajax en wordpress
    wp_localize_script('customjs', 'pg', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'apiurl' => home_url('wp-json/pg/v1/'),
    ));
}

add_action('wp_enqueue_scripts', 'assets');

function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de pagina',
            'id' => 'footer',
            'description' => 'Zona de Widgets para pie de pagina',
            'before_title' => '<p>',
            'after_title' => '</p>',
            'before_widget' => '<div id="%1$s" class= "%2$s">',
            'after_widget'  => '</div>',
        )    
    );
    
}

add_action('widgets_init', 'sidebar');

function productos_type() {

    $labels = array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos',
    );

    $args = array(
        'label' => 'Productos',
        'description' => 'Productos de Platzi',
        'labels' => $labels,
        'supports' => array('title','editor','thumbnail','revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => false,
    );
    register_post_type('producto', $args);
}
add_action('init', 'productos_type');

// Taxonomy
add_action('init', 'pgRegisterTax');
function pgRegisterTax() {
    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Categorías de Productos',
            'singular_name' => 'Categoría de Productos'
        ),
        'show_in_nav_menu' => true,
        'show_admin_column' => true,
        'rewrite' => array(
            'slug' => 'categoria-productos',

        ),
    );
    register_taxonomy('categoria-productos', array('producto'), $args);
}

add_action( 'phpmailer_init', function( $phpmailer ) {
    $phpmailer->Host     = getenv_docker('WORDPRESS_MAILHOG_HOST', 'mailhog');
    $phpmailer->Port     = getenv_docker('WORDPRESS_MAILHOG_PORT', '1025');
    $phpmailer->SMTPAuth = false;
    $phpmailer->isSMTP();
} );


function pgFiltroProductos() {
    $args = array(
        'post_type' => 'producto',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'order_by' => 'title',
    );
    if ($_POST['categoria']) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categoria-productos',
                'field' => 'slug',
                'terms' => $_POST['categoria'],
            )
        );
    }

    $productos = new WP_Query($args);
    
    if ($productos->have_posts()) {
        $return = array();
        while ($productos->have_posts()) {
            $productos->the_post();
            $return[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title(),
            );
        }
        wp_send_json($return);
    }
}
add_action('wp_ajax_pgFiltroProductos', 'pgFiltroProductos');
add_action('wp_ajax_nopriv_pgFiltroProductos', 'pgFiltroProductos');



// Peticiones a la API wordpress
// Novedades
function novedadesAPI() {
    register_rest_route('pg/v1', '/novedades/(?P<cantidad>\d+)', array(
        'methods' => 'GET',
        'callback' => 'pedidoNovedades',
    ));
}
add_action('rest_api_init', 'novedadesAPI');

function pedidoNovedades($data) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $data['cantidad'],
        'order' => 'ASC',
        'order_by' => 'title',
    );

    $novedades = new WP_Query($args);

    if ($novedades->have_posts()) {
        $return = array();
        while ($novedades->have_posts()) {
            $novedades->the_post();
            $return[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title(),
            );
        }
        return $return;
    }
}

// REgistro de nuestro bloque Gutengberg
function pgRegisterBlock() {
    // Tomamos el archivo PHP generado en el Build
    $assets = include_once get_template_directory().'/blocks/build/index.asset.php';

    wp_register_script(
        'pg-block', // Handle del Script
        get_template_directory_uri().'/blocks/build/index.js', // Usamos get_template_directory_uri() para recibir la URL del directorio y no el Path
        $assets['dependencies'], // Array de dependencias generado en el Build
        $assets['version'] // Cada Build cambia la versión para no tener conflictos de caché
    );

    register_block_type(
        'pg/basic', // Nombre del bloque
        array(
            'editor_script' => 'pg-block', // Handler del Script que registramos arriba
            'attributes'      => array( // Repetimos los atributos del bloque, pero cambiamos los objetos por arrays
                'content' => array(
                    'type'    => 'string',
                    'default' => 'Hello world'
                ),
                'mediaURL' => array(
                    'type'    => 'string'
                ),
                'mediaAlt' => array(
                    'type'    => 'string'
                )
            ),
            'render_callback' => 'pgRenderDinamycBlock' // Función de callback para generar el SSR (Server Side Render)
        )
    );
}
add_action('init', 'pgRegisterBlock');



// Para bloque dinamico
function pgRenderDinamycBlock($attributes, $content) {
    return (
        '<h1 class="my-3">'.$attributes['content'].'</h1>
        <img src="'.$attributes['mediaURL'].'" alt="'.$attributes['mediaAlt'].'" />
        <hr>'
    );
}

// function acfRegisterBlocks() {
//     acf_register_block(
//         array(
//             'name' => 'pg-institucional',
//             'title' => 'Institucional',
//             'description' => '',
//             'render_template' => get_template_directory().'/template-parts/institucional.php',
//             'category' => 'layout',
//             'icon' => 'smiley',
//             'mode' => 'edit'
//         )
//     );
// }
// add_action('acf/init', 'acfRegisterBlocks');


?>