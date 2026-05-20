<?php

add_action('init', function () {
    register_post_type('psychologist', [
        'labels' => [
            'name'          => __('Psichologai', 'ktu-licejus'),
            'singular_name' => __('Psichologas', 'ktu-licejus'),
            'add_new_item'  => __('Naujas psichologas', 'ktu-licejus'),
            'edit_item'     => __('Keisti psichologą', 'ktu-licejus'),
            'all_items'     => __('Visi psichologai', 'ktu-licejus'),
            'not_found'     => __('Psichologų nėra', 'ktu-licejus'),
        ],
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports' => ['custom-fields'],
        'show_in_rest'  => false,
        'menu_position' => 8,
        'menu_icon'     => 'dashicons-microphone',
    ]);

    foreach (
        [
            'psychologist_name',
            'psychologist_lastname',
            'psychologist_profession',
            'psychologist_room',
            'psychologist_address',
            'psychologist_phone_number',
            'psychologist_email',
        ] as $meta_key
    ) {
        register_post_meta('psychologist', $meta_key, [
            'show_in_rest' => false,
            'single'       => true,
            'type'         => 'string',
        ]);
    };
});

add_action('add_meta_boxes', function () {
    add_meta_box(
        'psychogist_details_meta_box',
        __('Psichologo informacija', 'ktu-licejus'),
        'licejus_psychologist_details_meta_box',
        'psychologist',
        'normal',
        'high',
    );
});

function licejus_psychologist_details_meta_box($post)
{
    wp_nonce_field('licejus_psychologist_details', 'licejus_psychologist_details_nonce');

    $name          = get_post_meta($post->ID, 'psychologist_name', true);
    $lastname      = get_post_meta($post->ID, 'psychologist_lastname', true);
    $profession    = get_post_meta($post->ID, 'psychologist_profession', true);
    $room          = get_post_meta($post->ID, 'psychologist_room', true);
    $address       = get_post_meta($post->ID, 'psychologist_address', true);
    $address_color = get_post_meta($post->ID, 'psychologist_address_color', true) ?: 'yellow';
    $phone_number  = get_post_meta($post->ID, 'psychologist_phone_number', true);
    $email         = get_post_meta($post->ID, 'psychologist_email', true);

    $colors = [
        'yellow' => __('Geltona', 'ktu-licejus'),
        'green'  => __('Žalia', 'ktu-licejus'),
        'red'   => __('Raudona', 'ktu-licejus'),
    ];
?>
    <p>
        <label for="psychologist_name"><strong><?= esc_html__('Vardas', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_name" name="psychologist_name"
            value="<?= esc_attr($name); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="psychologist_lastname"><strong><?= esc_html__('Pavardė', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_lastname" name="psychologist_lastname"
            value="<?= esc_attr($lastname); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="psychologist_profession"><strong><?= esc_html__('Pareigos', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_profession" name="psychologist_profession"
            value="<?= esc_attr($profession); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="psychologist_address"><strong><?= esc_html__('Adreso etiketė (spalvotas burbulas)', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_address" name="psychologist_address"
            value="<?= esc_attr($address); ?>" style="width: 100%;"
            placeholder="<?= esc_attr__('Pvz. Vaidoto g. 11', 'ktu-licejus'); ?>" />
    </p>
    <p>
        <label for="psychologist_address_color"><strong><?= esc_html__('Etiketės spalva', 'ktu-licejus'); ?></strong></label><br>
        <select id="psychologist_address_color" name="psychologist_address_color">
            <?php foreach ($colors as $value => $label) : ?>
                <option value="<?= esc_attr($value); ?>" <?php selected($address_color, $value); ?>>
                    <?= esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="psychologist_room"><strong><?= esc_html__('Kabinetas', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_room" name="psychologist_room"
            value="<?= esc_attr($room); ?>" style="width: 100%;"
            placeholder="<?= esc_attr__('Pvz. 212 kab. online', 'ktu-licejus'); ?>" />
    </p>
    <p>
        <label for="psychologist_phone_number"><strong><?= esc_html__('Telefono nr.', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_phone_number" name="psychologist_phone_number"
            value="<?= esc_attr($phone_number); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="psychologist_email"><strong><?= esc_html__('El. paštas', 'ktu-licejus'); ?></strong></label><br>
        <input type="text" id="psychologist_email" name="psychologist_email"
            value="<?= esc_attr($email); ?>" style="width: 100%;" />
    </p>
<?php
}


add_action('save_post_psychologist', function ($post_id) {
    static $running = false;
    if ($running) {
        return;
    }

    if (
        !isset($_POST['licejus_psychologist_details_nonce']) ||
        !wp_verify_nonce($_POST['licejus_psychologist_details_nonce'], 'licejus_psychologist_details')
    ) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $fields = [
        'psychologist_name'          => 'sanitize_text_field',
        'psychologist_lastname'      => 'sanitize_text_field',
        'psychologist_profession'    => 'sanitize_text_field',
        'psychologist_room'          => 'sanitize_text_field',
        'psychologist_address'       => 'sanitize_text_field',
        'psychologist_address_color' => 'sanitize_text_field',
        'psychologist_phone_number'  => 'sanitize_text_field',
        'psychologist_email'         => 'sanitize_text_field',
    ];

    foreach ($fields as $key => $sanitizer) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, call_user_func($sanitizer, wp_unslash($_POST[$key])));
        }
    }

    $name     = get_post_meta($post_id, 'psychologist_name', true);
    $lastname = get_post_meta($post_id, 'psychologist_lastname', true);
    $title    = trim("$name $lastname");

    if ($title !== '' && get_post_field('post_title', $post_id) !== $title) {
        $running = true;
        wp_update_post([
            'ID'         => $post_id,
            'post_title' => $title,
        ]);
        $running = false;
    }
});
