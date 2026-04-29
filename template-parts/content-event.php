<?php
$datetime_raw     = get_post_meta(get_the_ID(), 'event_datetime', true);
$end_time_raw     = get_post_meta(get_the_ID(), 'event_end_time', true);
$address_label    = get_post_meta(get_the_ID(), 'event_address_label', true);
$address_color    = get_post_meta(get_the_ID(), 'event_address_color', true) ?: 'yellow';
$location_details = get_post_meta(get_the_ID(), 'event_location_details', true);

$timestamp = $datetime_raw ? strtotime($datetime_raw) : false;

$categories = get_the_terms(get_the_ID(), 'event_category');
?>

<li <?php post_class('event-row'); ?>>
    <div class="event-date-short">
        <?php if ($timestamp) : ?>
            <span class="month"><?= esc_html(ucfirst(licejus_lt_month_genitive(date('n', $timestamp)))); ?></span>
            <span class="day"><?= esc_html(date('j', $timestamp)); ?></span>
        <?php endif; ?>
    </div>

    <div class="event-main">
        <?php if ($categories && !is_wp_error($categories)) : ?>
            <div class="event-categories">
                <?php
                $names = array_map(fn($t) => $t->name, $categories);
                echo esc_html(implode(', ', $names));
                ?>
            </div>
        <?php endif; ?>
        <h3 class="event-title"><?php the_title(); ?></h3>
    </div>

    <div class="event-location">
        <?php if ($address_label) : ?>
            <span class="event-address-badge event-address-badge--<?= esc_attr($address_color); ?>">
                <?= esc_html($address_label); ?>
            </span>
        <?php endif; ?>
        <?php if ($location_details) : ?>
            <span class="event-location-details"><?= esc_html($location_details); ?></span>
        <?php endif; ?>
    </div>

    <div class="event-date-full">
        <?php if ($timestamp) :
            $weekday_index = (int) date('N', $timestamp);
            $year  = date('Y', $timestamp);
            $month = licejus_lt_month_genitive(date('n', $timestamp));
            $day   = date('j', $timestamp);
            $start = date('H:i', $timestamp);
            $time  = $end_time_raw ? $start . '-' . $end_time_raw : $start;
        ?>
            <span class="full-date"><?= esc_html("$year $month $day d."); ?></span>
            <span class="weekday"><?= esc_html(licejus_lt_weekday($weekday_index)); ?></span>
            <span class="time"><?= esc_html($time); ?></span>
        <?php endif; ?>
    </div>
</li>
