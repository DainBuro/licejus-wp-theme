<?php

/**
 * Theme Customizer - Organizacijos informacija
 *
 * @package ktu-licejus
 */

/**
 * Render org contact info block.
 * Used in org.php and as the selective refresh callback.
 */
function licejus_render_organization_info()
{
    $org_name           = get_theme_mod('org_name', 'KTU inžinerijos licėjus');
    $org_type           = get_theme_mod('org_type', 'Biudžetinė įstaiga');
    $address            = get_theme_mod('org_address', 'S.Lozoraičio g. 13, LT-50137 Kaunas');
    $phone              = get_theme_mod('org_phone', '+370 37 312060');
    $email              = get_theme_mod('org_email', 'rastine@inzinerijoslicejus.ktu.edu');
    $url                = get_theme_mod('org_url', 'inzinerijoslicejus.ktu.edu');
    $data_register_code = get_theme_mod('org_data_register_code', '190136353');

    echo '<strong>' . esc_html($org_name) . '</strong><br/>';
    echo esc_html($org_type) . ', ' . '<br/><br/>';
    echo esc_html($address) . '<br/>';
    echo esc_html__('Tel./faks.', 'ktu-licejus') . ' ';
    echo '<a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a><br/>';
    echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a><br/>';
    echo '<a href="https://' . esc_attr($url) . '">' . esc_html($url) . '</a><br/><br/>';
    echo esc_html__('Duomenys kaupiami ir saugomi Juridinių asmenų registre', 'ktu-licejus') . '<br/>';
    echo esc_html__('Kodas', 'ktu-licejus') . ' ' . esc_html($data_register_code);
}

function licejus_customize_organization_info($wp_customize)
{
    $wp_customize->add_section('org-customizer', [
        'title'    => __('Organizacijos informacija', 'ktu-licejus'),
        'priority' => 160,
    ]);

    // Organization name
    $wp_customize->add_setting('org_name', [
        'default'           => 'KTU inžinerijos licėjus',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_name', [
        'label'   => __('Organizacijos pavadinimas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'text',
    ]);

    // Organization type
    $wp_customize->add_setting('org_type', [
        'default'           => 'Biudžetinė įstaiga',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_type', [
        'label'   => __('Įstaigos tipas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'text',
    ]);

    // Address
    $wp_customize->add_setting('org_address', [
        'default'           => 'S.Lozoraičio g. 13, LT-50137 Kaunas',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_address', [
        'label'   => __('Adresas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'text',
    ]);

    // Phone
    $wp_customize->add_setting('org_phone', [
        'default'           => '+370 37 312060',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_phone', [
        'label'   => __('Telefonas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'text',
    ]);

    // Email
    $wp_customize->add_setting('org_email', [
        'default'           => 'rastine@inzinerijoslicejus.ktu.edu',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_email', [
        'label'   => __('El. paštas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'email',
    ]);

    // Website link
    $wp_customize->add_setting('org_url', [
        'default'           => 'inzinerijoslicejus.ktu.edu',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_url', [
        'label'   => __('Internetinė nuoroda', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'text',
    ]);

    // Data register code
    $wp_customize->add_setting('org_data_register_code', [
        'default'           => '190136353',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('org_data_register_code', [
        'label'   => __('Juridinių asmenų registro kodas', 'ktu-licejus'),
        'section' => 'org-customizer',
        'type'    => 'number',
    ]);

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('org-info-partial-refresh', [
            'selector' => '.contacts-wrapper .org-contacts',
            'settings' => [
                'org_name',
                'org_type',
                'org_address',
                'org_phone',
                'org_email',
                'org_url',
                'org_data_register_code',
            ],
            'render_callback'     => 'licejus_render_organization_info',
            'container_inclusive' => false,
        ]);
    }
}

function licejus_render_all_subdivisions_info()
{
    define('SUBDIVISION_COUNT', 3);

    for ($index = 1; $index <= SUBDIVISION_COUNT; $index++) {
        licejus_render_subdivision_info($index);
    }
}

function licejus_render_subdivision_info($index)
{
    $subdiv_street      = get_theme_mod("subdiv{$index}-street", 'gatvės nr.');
    $subdiv_postal_code = get_theme_mod("subdiv{$index}-postal-code", 'pašto kodas');
    $subdiv_tel         = get_theme_mod("subdiv{$index}-tel", 'tel.');
    $subdiv_mob         = get_theme_mod("subdiv{$index}-mob", 'mob.');

    echo '<div class="subdiv' . esc_attr($index) . '-wrapper">';
    echo '<strong>' . esc_html($subdiv_street) . '</strong><br/>';
    echo esc_html($subdiv_postal_code) . '<br/><hr/>';
    echo '<a href="tel:' . esc_attr($subdiv_tel) . '">' . esc_html__('Tel. ') . esc_html($subdiv_tel) . '</a><br/>';
    echo '<a href="tel:' . esc_attr($subdiv_mob) . '">' . esc_html__('Mob. ') . esc_html($subdiv_mob) . '</a><br/>';
    echo '</div>';
}

function licejus_customize_subdivision_info($wp_customize)
{
    $wp_customize->add_panel('subdivision-panel', [
        'title'    => __('Organizacijos padalinių informacija', 'ktu-licejus'),
        'priority' => 160,
    ]);

    $subdivisions = [
        1 => [
            'street'      => 'Vaidoto g. 11',
            'postal-code' => 'LT-45388, Kaunas',
            'tel'         => '+370 37 345875',
            'mob'         => '+370 682 03345',
        ],
        2 => [
            'street'      => 'S.Lozoraičio g. 13',
            'postal-code' => 'LT-50137, Kaunas',
            'tel'         => '+370 37 312060',
            'mob'         => '+370 682 08668',
        ],
        3 => [
            'street'      => 'Geležinio Vilko g. 28',
            'postal-code' => 'LT-49272, Kaunas',
            'tel'         => '+370 37 728736',
            'mob'         => '+370 619 79191',
        ],
    ];

    $fields = [
        'street'      => 'gatvės nr.',
        'postal-code' => 'pašto kodas',
        'tel'         => 'tel.',
        'mob'         => 'mob.',
    ];

    foreach ($subdivisions as $i => $defaults) {
        $section_id = "subdivision-{$i}";

        $wp_customize->add_section($section_id, [
            'title' => sprintf(__('Padalinys %d — %s', 'ktu-licejus'), $i, $defaults['street']),
            'panel' => 'subdivision-panel',
        ]);

        foreach ($fields as $field => $label_suffix) {
            $key = "subdiv{$i}-{$field}";

            $wp_customize->add_setting($key, [
                'default'           => $defaults[$field],
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            ]);

            $wp_customize->add_control($key, [
                'label'   => $label_suffix,
                'section' => $section_id,
                'type'    => 'text',
            ]);
        }

        if (isset($wp_customize->selective_refresh)) {
            $wp_customize->selective_refresh->add_partial("subdiv-partial-refresh-{$i}", [
                'selector' => ".contacts-wrapper .subdiv{$i}-wrapper",
                'settings' => [
                    "subdiv{$i}-street",
                    "subdiv{$i}-postal-code",
                    "subdiv{$i}-tel",
                    "subdiv{$i}-mob",
                ],
                'render_callback' => function () use ($i) {
                    licejus_render_subdivision_info($i);
                },
                'container_inclusive' => false,
            ]);
        }
    }
}

function licejus_customize_founder_info($wp_customize)
{
    $wp_customize->add_section('founder-customizer', [
        'title'    => __('Steigėjas', 'ktu-licejus'),
        'priority' => 160,
    ]);

    $wp_customize->add_setting('founder-picture', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'founder-picture', [
        'label'   => __('Steigėjo nuotrauka', 'ktu-licejus'),
        'section' => 'founder-customizer',
    ]));

    $wp_customize->add_setting('founder-name', [
        'default'           => 'Kauno miesto savivaldybė',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('founder-name', [
        'label'   => __('Steigėjo pavadinimas', 'ktu-licejus'),
        'section' => 'founder-customizer',
        'type'    => 'text',
    ]);

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('founder-partial-refresh', [
            'selector' => '.founder-info',
            'settings' => [
                'founder-picture',
                'founder-name',
            ],
            'render_callback' => 'licejus_render_founder_info',
            'container_inclusive' => false,
        ]);
    }
}

function licejus_render_founder_info()
{
    $founder_picture = get_theme_mod('founder-picture', '');
    $founder_name = get_theme_mod('founder-name', 'Steigėjas');

    echo '<div class="founder-info">';
    if ($founder_picture) {
        echo '<img src="' . esc_url($founder_picture) . '" alt="Steigėjas">';
    }
    echo '<div class="text">';
    echo '<span>' . esc_html__('Steigėjas') . ':' . '</span><br/>';
    echo '<span>' . esc_html($founder_name) . '</span>';
    echo '</div>';
    echo '</div>';
}

function licejus_customize_footer_legal_disclaimers($wp_customize)
{
    $wp_customize->add_section('legal-disclaimers-customizer', [
        'title'    => __('Sistemos legali informacija', 'ktu-licejus'),
        'priority' => 160,
    ]);

    $wp_customize->add_setting('copyright-year', [
        'default'           => '2025',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('copyright-year', [
        'label'   => __('Autorinės teisės', 'ktu-licejus'),
        'section' => 'legal-disclaimers-customizer',
        'type'    => 'number',
    ]);

    $wp_customize->add_setting('last-updated', [
        'default'           => '2025-06-30',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control('last-updated', [
        'label'   => __('Svetainė atnaujinta', 'ktu-licejus'),
        'section' => 'legal-disclaimers-customizer',
        'type'    => 'date',
    ]);

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('legal-disclaimers-partial-refresh', [
            'selector' => '.legal-disclaimers',
            'settings' => [
                'copyright-year',
                'last-updated',
            ],
            'render_callback' => 'licejus_render_footer_legal_disclaimers',
            'container_inclusive' => false,
        ]);
    }
}

function licejus_render_footer_legal_disclaimers()
{
    $copyright_year = get_theme_mod('copyright-year', 'metai');
    $org_name       = get_theme_mod('org_name', 'KTU inžinerijos licėjus');
    $last_updated   = get_theme_mod('last-updated', 'KTU inžinerijos licėjus');
    $sonoro_icon = '<svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.83705 3.64079C5.9852 3.64079 4.47901 5.1475 4.47901 7C4.47901 7.6175 3.97531 8.1214 3.35803 8.1214C2.74074 8.1214 2.23704 7.6175 2.23704 7C2.23704 4.37685 4.37037 2.23782 6.99755 2.23782C7.2247 2.23782 7.4568 2.25265 7.679 2.28723L8 0.06916C7.67405 0.01976 7.33825 0 6.99755 0C3.14074 0 0 3.14185 0 7C0 8.8525 1.50618 10.3592 3.35803 10.3592C5.2099 10.3592 6.71605 8.8525 6.71605 7C6.71605 6.3825 7.21975 5.8786 7.83705 5.8786C8.4543 5.8786 8.958 6.3825 8.958 7C8.958 9.62315 6.8247 11.7621 4.19753 11.7621C3.97037 11.7621 3.73827 11.7474 3.51605 11.7128L3.2 13.9309C3.52593 13.9803 3.86173 14 4.20247 14C8.05925 14 11.2 10.8582 11.2 7C11.2 5.1475 9.69385 3.64079 7.83705 3.64079Z" fill="white" fill-opacity="0.6"/></svg>';
    $sonoro_text = '<svg width="55" height="10" viewBox="0 0 55 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.77344 0C5.00311 4.91717e-05 6.02029 0.410409 6.81543 1.24023L5.69922 2.6875C5.09176 2.11458 4.42502 1.82812 3.70898 1.82812C3.1212 1.82814 2.72168 2.15944 2.72168 2.55957C2.72187 2.92485 2.97804 3.18166 3.48633 3.35449C4.63223 3.78429 5.33419 4.07082 5.57129 4.19922C6.544 4.70804 7.03805 5.43919 7.0332 6.40234C7.0332 7.21241 6.71705 7.88453 6.08008 8.4082C5.45787 8.93173 4.61306 9.1884 3.58105 9.18848C2.06965 9.18848 0.8742 8.63495 0 7.51855L1.19531 6.10156C1.8176 6.85223 2.72654 7.31152 3.60059 7.31152C4.28693 7.31143 4.79586 6.9607 4.7959 6.4668C4.7959 6.1605 4.58775 5.90847 4.17285 5.71582C4.02948 5.65157 3.69832 5.52278 3.14062 5.31543C2.58277 5.10806 2.21696 4.94539 2.02441 4.85156C1.02198 4.37731 0.52832 3.62594 0.52832 2.6084C0.528367 1.84782 0.829389 1.22538 1.41699 0.731445C2.00469 0.237445 2.80044 0 3.77344 0ZM12.5742 0.0449219C13.9275 0.0449219 15.0438 0.489649 15.918 1.38379C16.7921 2.25816 17.2217 3.33982 17.2217 4.61426C17.2217 5.90349 16.792 6.98991 15.918 7.86426C15.0438 8.74356 13.9275 9.18848 12.5742 9.18848C11.2211 9.18844 10.1045 8.73862 9.23047 7.86426C8.35655 6.985 7.92677 5.90338 7.92676 4.61426C7.92676 3.33992 8.3565 2.25812 9.23047 1.38379C10.1045 0.489685 11.2211 0.0449574 12.5742 0.0449219ZM49.3945 0.0400391C50.7475 0.0400441 51.8643 0.484761 52.7383 1.37891C53.6126 2.25817 54.042 3.33998 54.042 4.60938C54.042 5.89851 53.6125 6.98506 52.7383 7.85938C51.8643 8.73867 50.7475 9.18359 49.3945 9.18359C48.041 9.18359 46.9248 8.73378 46.0508 7.85938C45.1765 6.98011 44.7471 5.89852 44.7471 4.60938C44.7471 3.33502 45.1765 2.25323 46.0508 1.37891C46.9248 0.484756 48.041 0.0400391 49.3945 0.0400391ZM32.9033 0.0449219C34.2566 0.0449444 35.3726 0.489615 36.2471 1.38867C37.1209 2.26303 37.5508 3.34468 37.5508 4.61914V8.9668H35.3086V7.83984C35.2986 7.84974 35.2937 7.86032 35.2842 7.87012C34.8097 8.40852 34.2512 8.78862 33.6191 8.99609C32.9624 9.21326 32.2516 9.20306 31.585 9.03027C30.8097 8.8278 30.1373 8.4431 29.5645 7.87012C28.7446 7.04522 28.3151 6.04195 28.2656 4.85645C28.2656 4.7774 28.2607 4.69819 28.2607 4.61914C28.2607 4.54009 28.2607 4.46089 28.2656 4.38184C28.3151 3.20631 28.7447 2.20376 29.5645 1.38379C30.3743 0.558917 31.3868 0.11406 32.6064 0.0546875C32.7002 0.0497475 32.7996 0.0449219 32.9033 0.0449219ZM22.7979 0.0595703C25.0895 0.0595703 26.952 1.92179 26.9473 4.21875V8.96191H24.7051V4.21875C24.7049 3.16173 23.8548 2.30762 22.7979 2.30762C21.7412 2.30775 20.8869 3.16182 20.8867 4.21875V8.96191H18.6445V4.21875C18.6447 1.92188 20.5015 0.0597085 22.7979 0.0595703ZM44.2383 0.0595703V2.30762H43.1172C42.0603 2.30762 41.2102 3.16173 41.2051 4.21875H41.2109V8.96191H38.9688V4.21875C38.9734 1.92179 40.8258 0.0595703 43.1172 0.0595703H44.2383ZM12.5742 2.14453C11.8878 2.14457 11.3147 2.38121 10.8555 2.86035C10.3912 3.33955 10.1689 3.92762 10.1689 4.61426C10.169 5.30086 10.3961 5.88884 10.8555 6.38281C11.3147 6.86197 11.8878 7.0986 12.5742 7.09863C13.2608 7.09863 13.819 6.86195 14.2783 6.38281C14.7425 5.88883 14.9795 5.30088 14.9795 4.61426C14.9795 3.92761 14.7376 3.33955 14.2783 2.86035C13.814 2.38124 13.2608 2.14453 12.5742 2.14453ZM32.9033 2.14453C32.2169 2.14453 31.6439 2.38617 31.1846 2.86035C30.7203 3.33955 30.498 3.92761 30.498 4.61426C30.4981 5.30088 30.7203 5.88883 31.1846 6.38281C31.6439 6.86195 32.2169 7.09863 32.9033 7.09863C33.5899 7.09861 34.1434 6.86199 34.6074 6.38281C35.0718 5.88886 35.3086 5.30082 35.3086 4.61426C35.3086 3.92767 35.0668 3.33953 34.6074 2.86035C34.1434 2.3812 33.5899 2.14455 32.9033 2.14453ZM49.3945 2.14453C48.7081 2.14453 48.1352 2.38133 47.6758 2.86035C47.2118 3.33955 46.9893 3.92761 46.9893 4.61426C46.9893 5.3009 47.2168 5.88882 47.6758 6.38281C48.1353 6.86186 48.7081 7.09863 49.3945 7.09863C50.081 7.09863 50.6391 6.86196 51.0986 6.38281C51.5576 5.88883 51.7998 5.30088 51.7998 4.61426C51.7998 3.92761 51.5576 3.33955 51.0986 2.86035C50.6341 2.3812 50.081 2.14454 49.3945 2.14453Z" fill="white" fill-opacity="0.6"/></svg>';

    echo '<div class="legal-disclaimers">';
    echo '<div class="left">';
    echo '<span>' . '© ' . esc_html($copyright_year) . '. ' . esc_html($org_name) . '.</span><br/>';
    echo '<span>' . esc_html__('Visos teisės saugomos. Kopijuoti turinį be sutikimo griežtai draudžiama.', 'ktu-licejus') . '</span>';
    echo '</div>';
    echo '<div class="right">';
    echo '<span>' . esc_html__('Svetainė atnaujinta', 'ktu-licejus') . ': ' . esc_html($last_updated) . '.</span><br/>';
    echo '<span>' . esc_html__('Sprendimas', 'ktu-licejus') . ' ' . $sonoro_icon . ' ' . $sonoro_text . '</span>';
    echo '</div>';
    echo '</div>';
}
