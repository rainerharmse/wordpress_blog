<?php get_header(); ?>

	<div class="blog-content-container">

        <div class="blog-inner-container">
            <h1>Only use this one the BLog Page</h1>
            <?php

            if( have_posts() ):

                while( have_posts() ): the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile;

            endif;

            ?>

        </div>


	</div>
<?php get_footer(); ?>


