<?php
  if (post_password_required()) {
     return;
   }
?>
<!-- comments start -->
<div class="comments-area">
   <?php if (have_comments()) :?>
   <h3 class="comments-count"><?php echo 'コメント一覧'; ?></h3>
   <!-- comments-list start -->
   <ul class="comments-list">
     <?php wp_list_comments(array(
       'style'=>'ul',
       'type'=>'comment',
       'callback'=>'mytheme_comments'
      )); ?>
   </ul>
   <?php if (get_comment_pages_count() > 1) : ?>
   <ul class="comments-nav">
     <li class="comments-prev"><?php previous_comments_link('＜＜ 前のコメント'); ?></li>
     <li class="comments-next"><?php next_comments_link('次のコメント ＞＞'); ?></li>
   </ul>
   <?php endif; ?>
  <?php endif; ?>
  <!-- comments-list end -->
  <!-- comments-form start -->
  <?php
	
	$name = 'ニックネーム';
$mail = 'メールアドレス';
     $comments_args = array(
       'fields' => array(
         'author' =>
      '<p class="comment-form-author">' .
      '<label for="author">'.$name.'</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p>',
 
    'email' =>
      '<p class="comment-form-email"><label for="email">'.$mail.'</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></p>',
     ),
     'title_reply' => 'コメントはこちらから',
     'comment_notes_before' => '<p class="comments-notes">※投稿したコメントにはニックネームが表示されます。メールアドレスは表示されません<br>
※内容によっては編集部で修正・削除することがあります</p>',
     'comment_notes_after' => '',
	'logged_in_as'  => '<p class="comment-form-author">' .
      '<label for="author">'.$name.'</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p>',
     'label_submit' => 'コメントを送信する',
         'action'=>'/wp-comments-post.php'
   );
   comment_form($comments_args);
  ?>
  <!-- comments-form end -->
</div>
<!-- comments end -->