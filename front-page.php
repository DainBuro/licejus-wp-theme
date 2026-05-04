<?php

/*
 * Template name: Front page
 */

get_header();
?>

<main>
    <?php get_template_part('template-parts/home/news') ?>
    <?php get_template_part('template-parts/home/events') ?>
    <?php get_template_part('template-parts/home/partners') ?>
</main>
<?php
get_footer();
