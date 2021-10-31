<?php

//ログイン時もコメントに名前を入力
function my_pre_comment_author_name($name) {
    $user = wp_get_current_user();
    if ($user->ID && isset($_POST['author']))
        $name = trim(strip_tags($_POST['author']));
    return $name;
}
add_filter('pre_comment_author_name', 'my_pre_comment_author_name');

// コメント順番
function move_comment_field_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter('comment_form_fields', 'move_comment_field_to_bottom');

function mytheme_comments($comment, $args, $depth){
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>"
         class="comments-wrapper">
        <div class="comments-meta">
            <?php echo get_avatar($comment, $args['avatar_size']) ?>
            <ul class="comments-meta-list">
                <li class="comments-author-name">
                              <?php echo '<p>ニックネーム:', get_comment_author_link(), '</p>' ?>
                </li>

                <div class="comments-content">
                    <?php comment_text() ?>
                </div>

                <li class="comments-date">
                    <a>
                        <?php echo get_comment_date(), get_comment_time() ?></a>
                    <span><?php edit_comment_link('（編集する）') ?></span>
                </li>

                <div class="comments-reply">
                    <?php comment_reply_link(array_merge($args, [
                        'reply_text' => '返信する',
                        'add_below' => $add_below,
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    ]))
                    ?>
                </div>
            </ul>
        </div>
        <!-- comment-meta -->


    </div>
    <!-- comment-comment_ID -->
    <?php
    }
