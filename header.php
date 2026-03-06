<?php
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header>
            <?php the_custom_logo(); ?>
            <?php licejus_social_links(); ?>
            <nav>
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'top-menu',
                        'menu_id'        => 'header-menu',
                        'link_before'    => '<i class="fa-solid"></i> ',
                    ]
                )
                ?>
            </nav>
        </header>