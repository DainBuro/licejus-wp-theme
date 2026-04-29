<?php

/**
 * Theme Customizer - Socialinės medijos nuorodos
 *
 * @package ktu-licejus
 */

function licejus_customize_social_media($wp_customize)
{
    $wp_customize->add_section('social_media', [
        'title'    => __('Socialinės medijos nuorodos', 'ktu-licejus'),
        'priority' => 160,
    ]);

    $social_links = [
        'facebook_url'   => ['label' => 'Facebook URL',  'default' => ''],
        'instagram_url'  => ['label' => 'Instagram URL', 'default' => ''],
        'youtube_url'    => ['label' => 'YouTube URL',   'default' => ''],
    ];

    foreach ($social_links as $id => $args) {
        $wp_customize->add_setting($id, [
            'default'           => $args['default'],
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ]);

        $wp_customize->add_control($id, [
            'label'   => $args['label'],
            'section' => 'social_media',
            'type'    => 'url',
        ]);
    }

    if (isset($wp_customize->selective_refresh)) {
        foreach (array_keys($social_links) as $id) {
            $wp_customize->selective_refresh->add_partial($id, [
                'selector'            => '.social-links',
                'settings'            => [$id],
                'render_callback'     => 'licejus_render_social_links_content',
                'container_inclusive' => false,
            ]);
        }
    }
}

function licejus_social_links()
{
    $socials = [
        'facebook_url'  => 'fa-facebook-f',
        'instagram_url' => 'fa-instagram',
        'youtube_url'   => 'fa-youtube',
    ];

    $output = '';
    foreach ($socials as $setting => $icon) {
        $url = get_theme_mod($setting);
        if ($url) {
            $output .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer"><i class="fa-brands %s"></i></a>',
                esc_url($url),
                esc_attr($icon)
            );
        }
    }

    echo '<div class="social-links">' . $output . '</div>';
}

function licejus_render_social_links_content()
{
    $socials = [
        'facebook_url'  => 'fa-facebook-f',
        'instagram_url' => 'fa-instagram',
        'youtube_url'   => 'fa-youtube',
    ];

    $output = '';
    foreach ($socials as $setting => $icon) {
        $url = get_theme_mod($setting);
        if ($url) {
            $output .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer"><i class="fa-brands %s"></i></a>',
                esc_url($url),
                esc_attr($icon)
            );
        }
    }

    echo $output;
}
