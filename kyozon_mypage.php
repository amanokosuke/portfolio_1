<?php

function add_user_history() {
	wp_reset_postdata();
    $user = wp_get_current_user();
    if ($user->ID == 0) {
        return;
    }
    if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) {
        return;
    }

    $post = get_post(get_the_ID());
    $post_id = $post->ID;
    $article_type = get_article_type($post_id);
    if (is_article($article_type) == false) {
        return;
    }

    $post_url = get_permalink($post_id);
    $post_title = get_article_title($post_id, $article_type);

    global $wpdb;
    $wpdb->insert('user_history', [
        'ID'                 => wp_generate_uuid4(),
        'user_id'            => $user->ID,
        'post_id'            => $post_id,
        'post_title'         => $post_title,
        'post_url'           => $post_url,
        'register_timestamp' => ceil(microtime(true) * 1000)
    ], [
        '%s',
        '%d',
        '%s',
        '%s',
        '%s',
        '%d'
    ]);
}

function get_article_type($postId) {
    $terms = get_the_terms($postId, "article_type");
    $slug = $terms[0]->slug;
    return $slug;
}

function is_article($article_type) {
    if ($article_type == "service_subcategory_article_type") {
        return true;
    }
    if ($article_type == "service_article_type") {
        return true;
    }
    if ($article_type == "service_client_article_type") {
        return true;
    }
    return false;
}

function get_article_title($postId, $slug) {

    if ($slug == "service_category_type") {
        return get_post_meta($postId, "category_name", true);
    }
    if ($slug == "service_category_article_list_type") {
        return get_post_meta($postId, "category_name", true);
    }
    if ($slug == "service_subcategory_type") {
        return get_post_meta($postId, "category_name", true);
    }
    if ($slug == "service_subcategory_article_list_type") {
        return get_post_meta($postId, "category_name", true);
    }
    if ($slug == "service_subcategory_article_type") {
        return get_post_meta($postId, "article_name", true);
    }
    if ($slug == "service_article_type") {
        return get_post_meta($postId, "service_name", true);
    }
    if ($slug == "service_client_article_type") {
        return get_post_meta($postId, "article_name", true);
    }
    if ($slug == "service_article_attchement_type") {
        return get_post_meta($postId, "attchement_name", true);
    }
    return null;
}

function show_add_favorite($pageId) {
	if (!is_user_logged_in()) {
		echo '<a class="header_login header_login_button favorite_icon"  href="#" data-mfp-src="'.home_url().'/login">'.HEART.'</a>';
        return;
    }
	 $user = wp_get_current_user();
    global $wpdb;
    $count = $wpdb->get_var($wpdb->prepare("
		SELECT count(*) 
		FROM user_favorite
		WHERE user_id = %s AND post_id = %s
	", $user->ID, $pageId));
    if (strcmp($count, '0') == 0) {
        echo "<div class='favorite_icon' onclick='favorite_toggle($pageId)'>" . HEART . "</div>";
    }
    else {
        echo "<div class='favorite_icon favorite_icon_on' onclick='favorite_toggle($pageId)'>" . HEART . "</div>";
    }
}


const HEART = "<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><title></title><path d='M256,448a32,32,0,0,1-18-5.57c-78.59-53.35-112.62-89.93-131.39-112.8-40-48.75-59.15-98.8-58.61-153C48.63,114.52,98.46,64,159.08,64c44.08,0,74.61,24.83,92.39,45.51a6,6,0,0,0,9.06,0C278.31,88.81,308.84,64,352.92,64,413.54,64,463.37,114.52,464,176.64c.54,54.21-18.63,104.26-58.61,153-18.77,22.87-52.8,59.45-131.39,112.8A32,32,0,0,1,256,448Z'/></svg>";
