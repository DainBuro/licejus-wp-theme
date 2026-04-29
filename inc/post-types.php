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

    foreach (['address', 'address_color'] as $meta_key) {
        register_post_meta('news', $meta_key, [
            'show_in_rest' => false,
            'single'       => true,
            'type'         => 'string',
        ]);
    }
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
    $address       = get_post_meta($post->ID, 'address', true);
    $address_color = get_post_meta($post->ID, 'address_color', true) ?: 'yellow';

    $colors = [
        'yellow' => __('Geltona', 'ktu-licejus'),
        'green'  => __('Žalia', 'ktu-licejus'),
        'red'    => __('Raudona', 'ktu-licejus'),
    ];
?>
    <p>
        <label for="news_address"><strong><?= esc_html__('Adresas', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="news_address" name="news_address"
            value="<?php echo esc_attr($address); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="news_address_color">
            <strong><?= esc_html__('Etiketės spalva', 'ktu-licejus'); ?></strong>
        </label><br>
        <select id="news_address_color" name="news_address_color">
            <?php foreach ($colors as $value => $label) : ?>
                <option value="<?= esc_attr($value); ?>" <?php selected($address_color, $value); ?>>
                    <?= esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
<?php
}

add_action('save_post_news', function ($post_id) {
    if (isset($_POST['news_address'])) {
        update_post_meta($post_id, 'address', sanitize_text_field(wp_unslash($_POST['news_address'])));
    }
    if (isset($_POST['news_address_color'])) {
        update_post_meta($post_id, 'address_color', sanitize_text_field(wp_unslash($_POST['news_address_color'])));
    }
});
