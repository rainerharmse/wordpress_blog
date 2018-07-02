<?php

/*
    Template Name: Main Template
*/

get_header(); ?>

<div class="main-content-container">
    <div class="window-pane left-pane">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
        endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
    <div class="window-pane right-pane">
        <h1>I can have a lekker heading herer</h1>
        <div id="particles-js"></div>



    </div>
</div>


<?php get_footer(); ?>
