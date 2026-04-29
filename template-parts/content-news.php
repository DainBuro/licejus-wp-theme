<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail(); ?>
    <?php endif; ?>
    <?php
    $categories = get_the_terms(get_the_ID(), 'news_category');
    $day_diff = floor((time() - get_the_time('U', get_the_ID())) / DAY_IN_SECONDS);
    $day_diff_text = $day_diff == 0 ? 'Šiandien' : ('Prieš ' . ($day_diff > 30 ? floor($day_diff / 30) . ' mėn.' : $day_diff . ' d.'));
    ?>
    <div class="info-row">
        <div class="left">

            <spam class="date"><?= esc_html($day_diff_text); ?></spam>
            <?php if ($categories) : ?>
                <div class="news-post-categories">
                    <?php foreach ($categories as $category) : ?>
                        <span><?php echo esc_html($category->name); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php $address = get_post_meta(get_the_ID(), 'address', true); ?>
        <?php if ($address) : ?>
            <span class="address"><?php echo esc_html($address); ?></span>
        <?php endif; ?>
    </div>

    <span class="news-title"><?php the_title(); ?></span>
</article>