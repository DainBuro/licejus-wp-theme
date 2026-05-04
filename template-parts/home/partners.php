<section class="home-partners">
    <h2><?= esc_html__('Partneriai', 'ktu-licejus'); ?></h2>

    <?php
    $partners = new WP_Query([
        'post_type'      => 'partner',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ]);
    ?>

    <?php if ($partners->have_posts()) : ?>
        <ul class="partners-list">
            <?php while ($partners->have_posts()) :
                $partners->the_post();
                $url = get_post_meta(get_the_ID(), 'partner_url', true);
            ?>
                <li class="partner-item">
                    <?php if ($url) : ?>
                        <a class="partner-link" href="<?= esc_url($url); ?>"
                            target="_blank" rel="noopener noreferrer"
                            aria-label="<?= esc_attr(get_the_title()); ?>">
                            <?php if (has_post_thumbnail()) :
                                the_post_thumbnail('medium', ['alt' => esc_attr(get_the_title())]);
                            else : ?>
                                <span class="partner-name"><?php the_title(); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php else : ?>
                        <span class="partner-link">
                            <?php if (has_post_thumbnail()) :
                                the_post_thumbnail('medium', ['alt' => esc_attr(get_the_title())]);
                            else : ?>
                                <span class="partner-name"><?php the_title(); ?></span>
                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</section>
