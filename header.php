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
            <div class="top-part">
                <?php the_custom_logo(); ?>
                <div class="header-controlls">
                    <div class="media-buttons">
                        <?php licejus_social_links(); ?>
                    </div>
                    <div class="header-navigation">
                        <nav>
                            <?php
                            wp_nav_menu(
                                [
                                    'theme_location' => 'top-menu',
                                    'menu_id'        => 'header-menu',
                                    'link_before'    => '<i class="fa-solid"></i>',
                                ]
                            )
                            ?>
                        </nav>
                        <div class="expandable-buttons">
                            <div class="search-wrapper" id="search-wrapper">
                                <div class="search-bar" id="search-bar">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-bar__form">
                                        <input type="search" name="s" class="search-bar__input" id="search-bar__input">
                                    </form>
                                    <div class="search-button" id="search-button">
                                        <i class="fa-solid fa-magnifying-glass search-bar__icon"></i>
                                    </div>
                                </div>
                                <div class="close-search-button" id="close-search-button">
                                    <i class="fa-solid fa-xmark search-bar__icon"></i>
                                </div>
                            </div>
                            <div class="header-menu-toggle-button-wrapper">
                                <button class="header-menu-toggle" id="header-menu-toggle">
                                    <div class="header-menu-toggle__icon">
                                        <i class="fa-solid fa-bars header-menu-toggle__open-icon"></i>
                                        <i class="fa-solid fa-xmark header-menu-toggle__close-icon"></i>
                                    </div>
                                    <div class="button-text">
                                        <?php esc_html_e('Meniu', 'ktu-licejus') ?>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-part" id="bottom-part">
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'expandable-navigation-menu',
                        'menu_id'        => 'expandable-navigation-menu',
                    ]
                );
                ?>
            </div>

        </header>