<?php

add_action('wp_ajax_filter_news', 'licejus_filter_news');
add_action('wp_ajax_nopriv_filter_news', 'licejus_filter_news');

function licejus_filter_news()
{
    check_ajax_referer('licejus_news_filter', 'nonce');

    $category = isset($_POST['category']) ? sanitize_text_field(wp_unslash($_POST['category'])) : '';

    $args = [
        'post_type' => 'news',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    if ($category && $category !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => $category,
            ],
        ];
    }

    $news = new WP_Query($args);

    ob_start();
    if ($news->have_posts()) {
        while ($news->have_posts()) {
            $news->the_post();
            get_template_part('template-parts/content', 'news');
        }
    } else {
        echo '<p class="no-news">' . esc_html__('Naujienų nėra.', 'ktu-licejus') . '</p>';
    }
    wp_reset_postdata();

    wp_send_json_success(['html' => ob_get_clean()]);
}
