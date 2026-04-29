<section class="home-events">
    <h2><?= esc_html__('Svarbiausi renginiai', 'ktu-licejus'); ?></h2>

    <?php
    $events = new WP_Query([
        'post_type'      => 'event',
        'posts_per_page' => 8,
        'meta_key'       => 'event_datetime',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => [
            [
                'key'     => 'event_datetime',
                'value'   => current_time('Y-m-d H:i:s'),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ],
        ],
    ]);
    ?>

    <?php if ($events->have_posts()) : ?>
        <ul class="events-list">
            <?php while ($events->have_posts()) :
                $events->the_post();
                get_template_part('template-parts/content', 'event');
            endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p class="no-events"><?= esc_html__('Artimiausių renginių nėra.', 'ktu-licejus'); ?></p>
    <?php endif; ?>
</section>
