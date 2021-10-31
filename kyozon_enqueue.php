<?php
function add_my_styles_and_scripts() {
    //プラグインIDを指定し解除する
    wp_dequeue_style('wp-block-library');

    //kyozon
    wp_enqueue_script('kyozon-script', get_bloginfo('url') . '/kyozon-theme/js/script.js', array('jquery'), '1.8.0', false);
    wp_enqueue_style('kyozon-theme-reset', get_bloginfo('url') . '/kyozon-theme/css/reset.css', [], '1.8.0', 'all');
    wp_enqueue_style('kyozon-theme-style', get_bloginfo('url') . '/kyozon-theme/style.css', [], '1.8.0', 'all');

    //
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_bloginfo('url') . '/kyozon-theme/js/jquery-3.4.1.min.js', null, "3.4.1", false);

    //
    wp_deregister_script('jquery-migrate');
    wp_enqueue_script('jquery-migrate', get_bloginfo('url') . '/kyozon-theme/js/jquery-migrate-3.2.0.min.js', array('jquery'), "3.2.0", false);

    //
    wp_enqueue_script('jquery.magnific-popup', get_bloginfo('url') . '/kyozon-theme/js/jquery.magnific-popup.js', array('jquery'), "1.1.0", false);
    wp_enqueue_style('magnific-popup', get_bloginfo('url') . '/kyozon-theme/css/magnific-popup.css', [], "1.1.0", 'all');

    //
    wp_enqueue_script('jquery.balloon.min', get_bloginfo('url') . '/kyozon-theme/js/jquery.balloon.min.js', array('jquery'), "1.1.2", false);

    //
    wp_deregister_script('wpp-js');
    wp_enqueue_script('wpp-js', get_bloginfo('url') . '/wpp/js/wpp-5.0.0.min.js', [], '5.0.0', true);

    //
    wp_deregister_script('js.cookie');
    wp_enqueue_script('js.cookie', get_bloginfo('url') . '/kyozon-theme/js/js.cookie-2.2.1.min.js', array('jquery'), '2.2.1', true);

    //
    wp_deregister_style('aioseop-toolbar-menu');

    //
    wp_deregister_style('wordpress-popular-posts-css');
    wp_enqueue_style('wordpress-popular-posts-css', get_bloginfo('url') . '/wpp/css/wpp.css', [], null, 'all');

    //
    wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/4d4380fa1a.js', [], null, false);
}

add_action('wp_enqueue_scripts', 'add_my_styles_and_scripts', 9999);