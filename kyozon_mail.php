<?php
//メールアドレス変更時のメール送信STOP
add_filter('send_email_change_email', '__return_false');
//パスワード変更時のメール送信STOP
add_filter('send_password_change_email', '__return_false');
add_filter('wp_new_user_notification_email', 'custom_new_user_notification_email', 10, 3);
function custom_new_user_notification_email($wp_new_user_notification_email, $user, $blogname) {
    $to = $user->user_email;
    $subject = '【重要／kyozon.】会員登録手続きのご案内';
    $user = get_user_by('email', $to);
    $pass = uniqid();
    $userdata = [
        'ID' => $user->ID,
        'user_pass' => $pass
    ];
    $user_id = wp_update_user($userdata);
    $url = "https://kyozon.net/register/profile-entry/?email=" . urlencode($to) . "&key=" . $pass;
    $message = <<<EOM
この度は「kyozon.」のサービス掲載にお申し込みいただきまして、誠にありがとうございます。
貴社サービスの資料掲載にあたり、ご担当者様をユーザーとして仮登録させていただきました。
下記URLにアクセスして、会員情報登録を完了させてください。
ログインは会員情報登録完了後に可能になります。

ログインをしていただくと下記の機能が利用可能となります。
BASICプランの方：貴社サービスの資料ダウンロードやお気に入り登録をしたユーザーの会員情報が参照できます
FREEプランの方：貴社サービスの資料ダウンロードやお気に入り登録をしたユーザーの人数が参照できます

-----------------------------------------------------------------
【会員登録URL】
$url
-----------------------------------------------------------------
※URLが2行以上になっているなどにより、クリックをしてもアクセスできない
　場合には、URLをコピーしてブラウザのアドレスバーに1行になるように
　貼り付けて画面を表示させてください。

======================================================================

本メールは送信専用メールアドレスからお送りしています。
ご返信いただいてもお答えできませんのでご了承ください。

「kyozon.」に関するお問い合わせは下記よりお願いいたします。
https://kyozon.net/company/contact/
サポートデスクメールアドレス ｜ kyozon+support@comix.co.jp

======================================================================
　株式会社コミクス
　東京都渋谷区円山町15-4　近藤ビル2階・6階

EOM;
    $wp_new_user_notification_email['subject'] = $subject;
    $wp_new_user_notification_email['message'] = $message;
    return $wp_new_user_notification_email;
}