<?php

add_action('init', function () {
    register_post_type('news', [
        'labels' => [
            'name'          => __('Naujienos', 'ktu-licejus'),
            'singular_name' => __('Straipsnis', 'ktu-licejus'),
            'add_new_item'  => __('Naujas straipsnis', 'ktu-licejus'),
            'edit_item'     => __('Keisti straipsnį', 'ktu-licejus'),
            'all_items'     => __('Visos naujienos', 'ktu-licejus'),
            'not_found'     => __('Naujienų nėra', 'ktu-licejus'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite' => ['slug' => 'news'],
        'show_in_rest' => false,
        'menu_position' => 5,
    ]);

    register_taxonomy('news_category', 'news', [
        'labels' => [
            'name'          => __('Naujienų kategorijos', 'ktu-licejus'),
            'singular_name' => __('Kategorija', 'ktu-licejus'),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => false,
        'rewrite' => ['slug' => 'news-category'],
    ]);

    register_post_meta('news', 'address', [
        'show_in_rest' => false,
        'single'       => true,
        'type'         => 'string',
    ]);
});

add_action('add_meta_boxes', function () {
    add_meta_box(
        'news_address_meta_box',
        __('Adresas', 'ktu-licejus'),
        'news_address_meta_box_callback',
        'news',
        'normal',
        'high',
    );
});

// Render the input field
function news_address_meta_box_callback($post)
{
    $address = get_post_meta($post->ID, 'address', true);
?>
    <input type="text" id="news_address" name="news_address" value="<?php echo esc_attr($address); ?>" style="width: 100%;" />
<?php
}

add_action('save_post_news', function ($post_id) {
    if (isset($_POST['news_address'])) {
        update_post_meta($post_id, 'address', sanitize_text_field($_POST['news_address']));
    }
});
