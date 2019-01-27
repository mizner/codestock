<?php
/**
 * The template used for displaying a Hero block.
 *
 * @package _s
 */
// Set up fields.
$title = get_field('title');
$text = get_field('description');
$link = get_field('link');
$image = get_field('image');
?>
<section class="hero-block">
    <div class="hero-content">
        <?php if ($title) : ?>
            <h2 class="hero-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="hero-description"><?php echo esc_html($text); ?></p>
        <?php endif; ?>

        <?php
        if ($link) :?>
            <a class="button button-hero"
               href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
        <?php endif; ?>
    </div><!-- .hero-content-->
    <?php
    if ($image) : ?>
        <figure class="image-background" aria-hidden="true">
            <?php
            echo wp_get_attachment_image($image['id'], 'full'); ?>
        </figure><!-- .image-background -->
    <?php endif ?>
</section><!-- .hero -->