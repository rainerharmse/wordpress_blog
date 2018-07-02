<?php

/*

    Template Name: Portfolio Template

*/

get_header(); ?>

        <?php

        $args = array('post_type' => 'portfolio', 'posts-per-page' => 3);
        $posts_array = get_posts( $args );

        if ($posts_array){

            foreach ( $posts_array as $post ) { ?>
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                <img src="<?php echo $image[0]; ?>" alt="">

                <a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>

            <?php }

        }

        ?>


<?php get_footer(); ?>



