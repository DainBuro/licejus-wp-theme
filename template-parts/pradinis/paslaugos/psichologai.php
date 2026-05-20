<section class="psychologists">
    <div class="page-top-info">
        <div class="page-path">
            <span>
                <?= esc_html__('Pradinis', 'ktu-licejus') ?>
            </span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>
                <?= esc_html__('Paslaugos', 'ktu-licejus') ?>
            </span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>
                <?= the_title() ?>
            </span>
        </div>
        <div class="title-and-updated-at">
            <h1><?= the_title() ?></h1>
            <span class="updated-at-timestamp"><?= esc_html__('Puslapis atnaujintas:', 'ktu-licejus') ?> <?= get_the_modified_time('Y-m-d') ?></span>
        </div>
        <div class="cards">
            <div class="card contact-card">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 41.7188V18.4688C0 17.25 0.5625 16.2188 1.5 15.4688L19.9688 1.78125C22.4062 0 25.5938 0 28.0312 1.78125L46.5 15.4688C47.4375 16.2188 48 17.25 48 18.4688V41.7188C48 45 45.2812 47.7188 42 47.7188H6C2.71875 47.7188 0 45 0 41.7188ZM1.5 21.4688V41.7188C1.5 44.25 3.5625 46.2188 6 46.2188H42C44.5312 46.2188 46.5 44.25 46.5 41.7188V21.4688L28.0312 35.1562C25.5938 36.9375 22.4062 36.9375 19.9688 35.1562L1.5 21.4688ZM46.5 18.4688C46.5 17.8125 46.125 17.0625 45.5625 16.6875L27.0938 3C25.3125 1.59375 22.6875 1.59375 20.9062 3L2.4375 16.6875C1.875 17.0625 1.5 17.8125 1.5 18.4688C1.5 19.2188 1.875 19.875 2.4375 20.25L20.9062 33.9375C22.7812 35.3438 25.3125 35.3438 27.0938 33.9375L45.5625 20.25C46.125 19.875 46.5 19.2188 46.5 18.4688Z" fill="#68253C" />
                </svg>
                <span><?= esc_html__('Parašyk psichologui', 'ktu-licejus') ?></span>
            </div>
            <div class="card contact-card">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M34.5 3.375L30.6562 12.4688C30.2812 13.4062 30.5625 14.625 31.4062 15.2812L36.2812 19.3125C36.4688 19.5 36.5625 19.875 36.4688 20.1562C33.2812 27.4688 27.5625 33.375 20.4375 36.75C20.0625 36.8438 19.6875 36.8438 19.5 36.5625L15.2812 31.4062C14.625 30.5625 13.5 30.2812 12.4688 30.6562L3.375 34.5C2.25 34.9688 1.6875 36.1875 1.96875 37.4062L2.15625 38.0625C3.65625 43.5 8.8125 47.9062 15 46.6875C30.8438 43.4062 43.4062 30.8438 46.6875 15C47.9062 8.8125 43.5 3.65625 38.0625 2.15625L37.4062 1.96875C36.1875 1.6875 34.9688 2.25 34.5 3.375ZM37.7812 0.5625L38.4375 0.65625C44.4375 2.34375 49.5938 8.15625 48.0938 15.2812C44.7188 31.7812 31.7812 44.7188 15.2812 48.0938C8.15625 49.5938 2.34375 44.4375 0.65625 38.4375L0.5625 37.7812C0 35.9062 1.03125 33.8438 2.8125 33.0938L11.9062 29.3438C13.5 28.5938 15.375 29.0625 16.5 30.4688L20.3438 35.1562C26.7188 31.9688 31.875 26.625 34.875 20.0625L30.4688 16.5C29.0625 15.375 28.5938 13.5 29.3438 11.9062L33.0938 2.8125C33.8438 0.9375 35.9062 0 37.7812 0.5625Z" fill="#68253C" />
                </svg>
                <span><?= esc_html__('Psichologų kontaktai', 'ktu-licejus') ?></span>
            </div>
        </div>
    </div>

    <?php get_template_part('template-parts/pradinis/paslaugos/psichologai/description-text') ?>
    <?php get_template_part('template-parts/pradinis/paslaugos/psichologai/contacts') ?>
</section>