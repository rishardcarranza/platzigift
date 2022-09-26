<?php get_header(); ?>

<main class="container my-3">
<?php if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
            <h1 class="my-5"><?php the_title(); ?></h1>
            <div class="row">
                <div class="col-md-6 col-12">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <div class="col-md-6 col-12">
                    <?php echo do_shortcode('[contact-form-7 id="58" title="Formulario de contacto"]'); ?>
                </div>
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
            $current_post_id = get_the_ID();
            $taxonomy = get_the_terms($current_post_id, 'categoria-productos');
            $args = array(
                'post_type' => 'producto',
                'posts_per_page' => 6,
                'order' => 'ASC',
                'order_by' => 'title',
                'post__not_in' => array($current_post_id),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categoria-productos',
                        'field' => 'slug',
                        'terms' => $taxonomy[0]->slug,
                    )
                ),
            );
            $productos = new WP_Query($args);
            
            if ($productos->have_posts()) { ?>
                <h2 class="my-5 text-center">Productos relacionados</h2>
                <div class="row justify-content-center lista-productos">
                    <?php
                    while ($productos->have_posts()) {
                        $productos->the_post(); ?>
                        <div class="col-2 my-3 text-center">
                            <?php the_post_thumbnail('thumbnail') ?>
                            <h4>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        </div>
            <?php   } ?>
                </div>
    <?php   } ?>

<?php   } }?>
</main>


<?php get_footer(); ?>