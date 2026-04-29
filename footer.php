    <footer class="site-footer">
        <div class="footer-content">
            <div class="contacts-wrapper">
                <div class="left">
                    <?php the_custom_logo(); ?>
                    <div class="org-contacts">
                        <?php licejus_render_organization_info(); ?>
                    </div>
                </div>
                <div class="right">
                    <div class="subdivisions-info">
                        <?php licejus_render_all_subdivisions_info(); ?>
                    </div>
                    <a href="" class="user-policies">
                        <?php esc_html_e('Privatumo ir slapukų politika', 'ktu-licejus'); ?>
                    </a>
                </div>
            </div>
            <div class="city-socials">
                <div class="left">
                    <?php licejus_render_founder_info() ?>
                </div>
                <div class="right">
                    <?php esc_html_e('Sekite mus:', 'ktu-licejus') ?>
                    <?php licejus_social_links(); ?>
                </div>
            </div>
        </div>
        <?php licejus_render_footer_legal_disclaimers(); ?>
    </footer>
    </div><!-- #page -->

    <?php wp_footer(); ?>

    </body>

    </html>