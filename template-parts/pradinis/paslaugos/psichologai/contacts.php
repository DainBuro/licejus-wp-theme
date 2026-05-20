<section class="psychologist-contacts">
    <h2><?= esc_html__('Psichologų kontaktai', 'ktu-licejus') ?></h2>
    <?php
    $psychologists = new WP_Query([
        'post_type'      => 'psychologist',
        'posts_per_page' => 4,
    ])
    ?>
    <?php if ($psychologists->have_posts()) : ?>
        <div class="psychologists-list">
            <?php while ($psychologists->have_posts()) :
                $psychologists->the_post();
                get_template_part('template-parts/pradinis/paslaugos/psichologai/content-psychologist');
            endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
</section>