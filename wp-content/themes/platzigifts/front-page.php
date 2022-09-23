<?php get_header(); ?>

<main class="container my-3">
<?php if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
            <h1 class="my-3"><?php the_title(); ?></h1>
            <?php the_content(); ?>
<?php   }
    }?>


    <div class="lista-productos my-5">
        <h2 class="text-center">Productos</h2>

        <div class="row">
        <?php
        $args = array(
            'post_type' => 'producto',
            'post_per_page' => -1,
            'order' => 'DESC',
            'order_by' => 'title',
        );

        $productos = new WP_Query($args);

        if ($productos->have_posts()) {
            while ($productos->have_posts()) {
                $productos->the_post();
                ?>
                <div class="col-4">
                    <figure>
                        <?php the_post_thumbnail('large'); ?>
                    </figure>
                    <h4 class="my-3 text-center">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>
            <?php
            }
        }
        ?>
        </div>
    </div>

</main>


<?php get_footer(); ?>