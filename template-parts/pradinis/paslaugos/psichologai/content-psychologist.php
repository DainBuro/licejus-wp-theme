<?php

$name          = get_post_meta(get_the_ID(), 'psychologist_name', true);
$lastname      = get_post_meta(get_the_ID(), 'psychologist_lastname', true);
$profession    = get_post_meta(get_the_ID(), 'psychologist_profession', true);
$room          = get_post_meta(get_the_ID(), 'psychologist_room', true);
$address       = get_post_meta(get_the_ID(), 'psychologist_address', true);
$address_color = get_post_meta(get_the_ID(), 'psychologist_address_color', true) ?: 'yellow';
$phone_number  = get_post_meta(get_the_ID(), 'psychologist_phone_number', true);
$email         = get_post_meta(get_the_ID(), 'psychologist_email', true);
?>

<div class="psychologist-card card">
    <div class="left">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M38.9062 40.7812C43.5938 36.75 46.5 30.6562 46.5 24C46.5 11.625 36.4688 1.5 24 1.5C11.625 1.5 1.5 11.625 1.5 24C1.5 30.6562 4.40625 36.75 9.09375 40.7812C9.65625 34.7812 14.8125 30 21 30H27C33.2812 30 38.3438 34.7812 38.9062 40.7812ZM37.5 42C37.5 36.1875 32.8125 31.5 27 31.5H21C15.1875 31.5 10.5 36.1875 10.5 42C14.25 44.8125 18.9375 46.5 24 46.5C29.0625 46.5 33.75 44.8125 37.5 42ZM24 48C10.7812 48 0 37.2188 0 24C0 10.7812 10.7812 0 24 0C37.2188 0 48 10.7812 48 24C48 37.2188 37.2188 48 24 48ZM31.5 18C31.5 22.125 28.125 25.5 24 25.5C19.875 25.5 16.5 22.125 16.5 18C16.5 13.875 19.875 10.5 24 10.5C28.125 10.5 31.5 13.875 31.5 18ZM24 12C20.7188 12 18 14.7188 18 18C18 21.2812 20.7188 24 24 24C27.2812 24 30 21.2812 30 18C30 14.7188 27.2812 12 24 12Z" fill="#68253C" />
        </svg>
    </div>
    <div class="right">
        <?php if ($name && $lastname) : ?>
            <div class="top-row">
                <span><?= $name . ' ' . $lastname ?></span>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <span class="profession"><?= $profession ?></span>
            <div class="location">
                <span class="room"><?= $room ?></span>
                <span class="address address--<?= esc_attr($address_color); ?>"><?= $address ?></span>
            </div>
            <span class="highlight-undertext"><?= $phone_number ?></span>
            <span class="highlight-undertext"><?= $email ?></span>
        <?php endif; ?>
    </div>
</div>