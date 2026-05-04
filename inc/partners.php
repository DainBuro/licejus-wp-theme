<?php

add_action('init', function () {
    register_post_type('partner', [
        'labels' => [
            'name'          => __('Partneriai', 'ktu-licejus'),
            'singular_name' => __('Partneris', 'ktu-licejus'),
            'add_new_item'  => __('Naujas partneris', 'ktu-licejus'),
            'edit_item'     => __('Keisti partnerį', 'ktu-licejus'),
            'all_items'     => __('Visi partneriai', 'ktu-licejus'),
            'not_found'     => __('Partnerių nėra', 'ktu-licejus'),
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => ['title', 'thumbnail', 'page-attributes'],
        'show_in_rest'  => false,
        'menu_position' => 7,
        'menu_icon'     => 'dashicons-groups',
    ]);

    register_post_meta('partner', 'partner_url', [
        'show_in_rest' => false,
        'single'       => true,
        'type'         => 'string',
    ]);
});

add_action('add_meta_boxes', function () {
    add_meta_box(
        'partner_details_meta_box',
        __('Partnerio nuoroda', 'ktu-licejus'),
        'licejus_partner_details_meta_box',
        'partner',
        'normal',
        'high',
    );
});

function licejus_partner_details_meta_box($post)
{
    wp_nonce_field('licejus_partner_details', 'licejus_partner_details_nonce');
    $url = get_post_meta($post->ID, 'partner_url', true);
?>
    <p>
        <label for="partner_url">
            <strong><?= esc_html__('URL', 'ktu-licejus'); ?></strong>
        </label><br>
        <input type="url" id="partner_url" name="partner_url"
            value="<?= esc_attr($url); ?>" style="width: 100%; max-width: 480px;"
            placeholder="https://" />
    </p>
    <p class="description">
        <?= esc_html__('Įkelkite logotipą per "Featured image" laukelį.', 'ktu-licejus'); ?>
    </p>
<?php
}

add_action('save_post_partner', function ($post_id) {
    if (
        !isset($_POST['licejus_partner_details_nonce']) ||
        !wp_verify_nonce($_POST['licejus_partner_details_nonce'], 'licejus_partner_details')
    ) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['partner_url'])) {
        update_post_meta($post_id, 'partner_url', esc_url_raw(wp_unslash($_POST['partner_url'])));
    }
});
