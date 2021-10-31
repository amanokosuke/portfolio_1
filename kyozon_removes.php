<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
add_filter('emoji_svg_url', '__return_false');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('embed_head', 'print_embed_styles');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
// <link rel="alternate" type="application/rss+xml" title="" href="..." />
remove_action('wp_head', 'feed_links', 2);
// <link rel="alternate" type="application/rss+xml" title="" href="..." />
remove_action('wp_head', 'feed_links_extra', 3);
// <link rel="EditURI" type="application/rsd+xml" title="RSD" href="..." />
remove_action('wp_head', 'rsd_link');
// <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="..." />
remove_action('wp_head', 'wlwmanifest_link');
// <link rel="next" href="...">, <link rel="prev" href="">
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
// <link rel="canonical" href="...">
remove_action('wp_head', 'rel_canonical');
// <meta name="generator" content="WordPress X.X">
remove_action('wp_head', 'wp_generator');
// <link rel='shortlink' href='...' />
remove_action('wp_head', 'wp_shortlink_wp_head');
// 絵文字用スクリプト(公開側)
remove_action('wp_head', 'print_emoji_detection_script', 7);
// 絵文字用スタイル(公開側)
remove_action('wp_print_styles', 'print_emoji_styles');
// <link rel='https://api.w.org/' href='...' />
remove_action('wp_head', 'rest_output_link_wp_head');
// <link rel="alternate" type="application/json+oembed" href="http://example.com/wp-json/oembed/1.0/embed?url=記事URL" /> ほか
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// <script type='text/javascript' src='http://example.com/wp-includes/js/wp-embed.min.js?ver=X.X'></script>
remove_action('wp_head', 'wp_oembed_add_host_js');
