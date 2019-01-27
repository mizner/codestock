<?php
get_header();
/* Start the Loop */
while (have_posts()) :
    the_post();
    ?>
    <h1>CONTENT!</h1>
    <?php
    $obj = get_queried_object();
//                $parsed = parse_blocks($obj->post_content);;
//               echo do_blocks(get_the_content());
//                var_dump($parsed);

    the_content();

endwhile; // End of the loop.

get_footer();
