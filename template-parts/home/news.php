<section class="home-news">
    <h2>Naujienos</h2>
    <?php $categories = get_terms([
        'taxonomy' => 'news_category',
        'hide_empty' => false,
    ]); ?>

    <?php if ($categories) : ?>
        <div class="categories-row">
            <button class="category-select-btn" id="all-news-button" data-category="all">
                <?= esc_html__('Visos naujienos', 'ktu-licejus'); ?>
            </button>
            <?php foreach ($categories as $category) : ?>
                <button class="category-select-btn" data-category="<?php echo esc_attr($category->slug); ?>">
                    <?= esc_html($category->name) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="content">
        <?php
        $news = new WP_Query([
            'post_type' => 'news',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        while ($news->have_posts()) :
            $news->the_post();
            get_template_part('template-parts/content', 'news');
        endwhile;
        ?>
    </div>
</section>