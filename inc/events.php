<?php

add_action('init', function () {
    register_post_type('event', [
        'labels' => [
            'name'          => __('Renginiai', 'ktu-licejus'),
            'singular_name' => __('Renginys', 'ktu-licejus'),
            'add_new_item'  => __('Naujas renginys', 'ktu-licejus'),
            'edit_item'     => __('Keisti renginį', 'ktu-licejus'),
            'all_items'     => __('Visi renginiai', 'ktu-licejus'),
            'not_found'     => __('Renginių nėra', 'ktu-licejus'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'custom-fields'],
        'rewrite' => ['slug' => 'events'],
        'show_in_rest' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-calendar-alt',
    ]);

    register_taxonomy('event_category', 'event', [
        'labels' => [
            'name'          => __('Renginių kategorijos', 'ktu-licejus'),
            'singular_name' => __('Kategorija', 'ktu-licejus'),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => false,
        'rewrite' => ['slug' => 'event-category'],
    ]);

    foreach (
        [
            'event_datetime',
            'event_end_time',
            'event_address_label',
            'event_address_color',
            'event_location_details',
        ] as $meta_key
    ) {
        register_post_meta('event', $meta_key, [
            'show_in_rest' => false,
            'single'       => true,
            'type'         => 'string',
        ]);
    }
});

add_action('add_meta_boxes', function () {
    add_meta_box(
        'event_details_meta_box',
        __('Renginio informacija', 'ktu-licejus'),
        'licejus_event_details_meta_box',
        'event',
        'normal',
        'high',
    );
});

function licejus_event_details_meta_box($post)
{
    wp_nonce_field('licejus_event_details', 'licejus_event_details_nonce');

    $datetime         = get_post_meta($post->ID, 'event_datetime', true);
    $end_time         = get_post_meta($post->ID, 'event_end_time', true);
    $address_label    = get_post_meta($post->ID, 'event_address_label', true);
    $address_color    = get_post_meta($post->ID, 'event_address_color', true) ?: 'yellow';
    $location_details = get_post_meta($post->ID, 'event_location_details', true);

    $colors = [
        'yellow' => __('Geltona', 'ktu-licejus'),
        'green'  => __('Žalia', 'ktu-licejus'),
        'red'   => __('Raudona', 'ktu-licejus'),
    ];
?>
    <p>
        <label for="event_datetime"><strong><?= esc_html__('Pradžios data ir laikas', 'ktu-licejus'); ?></strong></label><br>
        <input type="datetime-local" id="event_datetime" name="event_datetime"
            value="<?= esc_attr($datetime); ?>" style="width: 100%; max-width: 320px;" />
    </p>
    <p>
        <label for="event_end_time"><strong><?= esc_html__('Pabaigos laikas (nebūtinas)', 'ktu-licejus'); ?></strong></label><br>
        <input type="time" id="event_end_time" name="event_end_time"
            value="<?= esc_attr($end_time); ?>" style="width: 100%; max-width: 200px;" />
    </p>
    <p>
        <label for="event_address_label"><strong><?= esc_html__('Adreso etiketė (spalvotas burbulas)', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="event_address_label" name="event_address_label"
            value="<?= esc_attr($address_label); ?>" style="width: 100%; max-width: 420px;"
            placeholder="<?= esc_attr__('Pvz. Vaidoto g. 11', 'ktu-licejus'); ?>" />
    </p>
    <p>
        <label for="event_address_color"><strong><?= esc_html__('Etiketės spalva', 'ktu-licejus'); ?></strong></label><br>
        <select id="event_address_color" name="event_address_color">
            <?php foreach ($colors as $value => $label) : ?>
                <option value="<?= esc_attr($value); ?>" <?php selected($address_color, $value); ?>>
                    <?= esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="event_location_details"><strong><?= esc_html__('Vietos detalės / pilnas adresas', 'ktu-licejus'); ?></strong></label><br>
        <textarea id="event_location_details" name="event_location_details"
            rows="2" style="width: 100%; max-width: 420px;"
            placeholder="<?= esc_attr__('Pvz. 212 kab. online', 'ktu-licejus'); ?>"><?= esc_textarea($location_details); ?></textarea>
    </p>
<?php
}

add_action('save_post_event', function ($post_id) {
    if (
        !isset($_POST['licejus_event_details_nonce']) ||
        !wp_verify_nonce($_POST['licejus_event_details_nonce'], 'licejus_event_details')
    ) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $fields = [
        'event_datetime'         => 'sanitize_text_field',
        'event_end_time'         => 'sanitize_text_field',
        'event_address_label'    => 'sanitize_text_field',
        'event_address_color'    => 'sanitize_text_field',
        'event_location_details' => 'sanitize_textarea_field',
    ];

    foreach ($fields as $key => $sanitizer) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, call_user_func($sanitizer, wp_unslash($_POST[$key])));
        }
    }
});
