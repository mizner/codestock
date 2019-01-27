<?php
get_header();
/* Start the Loop */
while (have_posts()) :
    the_post();

    do_action('theme_view_main', get_queried_object());

endwhile; // End of the loop.

get_footer();
