<?php
add_editor_style('style.css');
add_action('init', function () {
    remove_filter('the_excerpt', 'wpautop');
    //自動挿入のPタグBRタグ削除
    remove_filter('the_content', 'wpautop');
});
add_filter('tiny_mce_before_init', function ($init) {
    $init['wpautop'] = false;
    $init['apply_source_formatting'] = true;
    return $init;
});

function set_slug_date_on_edit() {
    $post = get_post(get_the_ID());
    $slug = $post->post_name;

    if ($slug == 'kyozonupdate') {
        ?>
        <script>
            jQuery(function ($) {
                $('#post_name').val("<?=str_replace(".", "", uniqid("", true))?>");
            });
        </script>
        <?php
    }
}
add_action('admin_head-post.php', 'set_slug_date_on_edit');

function set_slug_date_on_new() {
    ?>
    <script>
        jQuery(function ($) {
            $('#post_name').val("<?=str_replace(".", "", uniqid("", true))?>");
        });
    </script>
<?php }

add_action('admin_head-post-new.php', 'set_slug_date_on_new');