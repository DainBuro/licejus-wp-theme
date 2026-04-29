<?php

/**
 * Theme Customizer
 *
 * @package ktu-licejus
 */

require get_template_directory() . '/inc/customizer/social-media.php';
require get_template_directory() . '/inc/customizer/footer-customizer.php';

function licejus_customize_register($wp_customize)
{
    licejus_customize_social_media($wp_customize);
    licejus_customize_organization_info($wp_customize);
    licejus_customize_subdivision_info($wp_customize);
    licejus_customize_founder_info($wp_customize);
    licejus_customize_footer_legal_disclaimers($wp_customize);
}
add_action('customize_register', 'licejus_customize_register');
