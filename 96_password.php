<?php
/**
 * Template Name: パスワード再発行画面
 * Template Post Type: page
 */

$email = "";
$error = "";
if (isset($_POST['pwremaind_nonce'])) {
    //nonceチェック
    if (!wp_verify_nonce($_POST['pwremaind_nonce'], 'pwremaind')) {
        $error .= '不正な遷移です';
    }
    else {
        //入力チェック
        if (!empty($_POST['user_email'])) {
            $email = $_POST['user_email'];
        }
        else {
            $error .= "メールアドレスを入力してください";
        }
    }
    if (!$error) {
        //ユーザー取得
        $user = get_user_by('email', $email);
        if (false === $user) {
            wp_safe_redirect("/register/pw-remind-complete?error=1");
        }
        else {
            $pass = uniqid();
            $userdata = [
                'ID'        => $user->ID,
                'user_pass' => $pass
            ];
            $user_id = wp_update_user($userdata);
            if (!is_wp_error($user_id)) {
                //ユーザメール発行
                $multiple_recipients = [$email];
                $subj = '【kyozon.】パスワード再設定のご案内';
                $body = <<<EOM
いつも「kyozon.」をご利用いただき、誠にありがとうございます。
仮パスワードを発行いたしましたので、ログインをしていただきパスワードを再設定してください。

 -----------------------------------------------------------------
　【仮パスワード】
$pass

https://kyozon.net/login/
 -----------------------------------------------------------------
※URLが2行以上になっているなどにより、クリックをしてもアクセスできない
　場合には、URLをコピーしてブラウザのアドレスバーに1行になるように
　貼り付けて画面を表示させてください。

======================================================================

本メールは送信専用メールアドレスからお送りしています。
ご返信いただいてもお答えできませんのでご了承ください。

「kyozon.」に関するお問い合わせは下記よりお願いいたします。
https://kyozon.net/company/contact/

======================================================================
　株式会社コミクス
　東京都渋谷区円山町15-4　近藤ビル2階・6階

EOM;
                if (wp_mail($multiple_recipients, $subj, $body)) {
                    wp_safe_redirect("/register/pw-remind-complete");
                }
                else {
                    wp_safe_redirect("/register/pw-remind-complete?error=2");
                }
            }
            else {
                wp_safe_redirect("/register/pw-remind-complete?error=3");
            }
        }
    }
    //ok
}
?>
<head>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700&display=swap&subset=japanese"
		  rel="stylesheet">

	<link rel="stylesheet"
		  href="/kyozon-theme/css/reset.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/style.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/css/popup_style.css">
</head>
<main>
    <div class="popup_container">
        <div class="popup_bar">
        </div>
        <div class="popupu_header">
            <h1>パスワード再発行</h1>
        </div>
        <div class="popup_body">
            <div class="form_container">
                <div class="form_body">
                    <form action="<?php the_permalink(); ?>"
                          method="post">
                        <?php wp_nonce_field('pwremaind', 'pwremaind_nonce') ?>
                        <div class="form_row form_message">
                            登録いただいたメールアドレスをご入力ください<br>
                            仮パスワードをメールでお送りさせていただきます
                        </div>
                        <div class="form_row">
                            <input type="email"
                                   name="user_email"
                                   placeholder="メールアドレス"/>
                        </div>
                        <div class="form_row">
                            <button type="submit">再発行</button>
                        </div>
                        <?php if (!empty($error)): ?>
                            <div class="form_row form_error">
                                <p><?php echo $error; ?></p>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="popupu_footer">

        </div>
    </div>
</main>
