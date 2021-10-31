<?php
/**
 * Template Name: メール確認入力画面
 * Template Post Type: page
 */
$email = "";
$error = "";

if (isset($_POST['register_nonce'])) {
    //nonceチェック
    if (!wp_verify_nonce($_POST['register_nonce'], 'register')) {
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
        if (strcmp($_POST['user_email'], $_POST['user_email2']) != 0) {
            $error .= "メールアドレスが一致しません。";
        }
    }
    if (!$error) {
        //ユーザー取得
        $user = get_user_by('email', $email);
        if (false === $user) {
            //ユーザ作成
            $pass = uniqid();
            $userdata = [
                'first_name' => '',
                'last_name'  => '',
                'user_login' => $email,
                'user_email' => $email,
                'role'       => 'pending',
                'user_pass'  => $pass
            ];
            $user_id = wp_insert_user($userdata);
            if (is_wp_error($user_id)) {
                $error .= "ユーザ登録送信エラー";
            }
        }else {
            $pending = false;
            foreach ($user->roles as $value) {
                if(strcmp($value,"pending") == 0){
                    $pending = true;
                    break;
                }
            }
            if( $pending ){
                $pass = uniqid();
                $userdata = [
                    'ID'        => $user->ID,
                    'user_pass' => $pass
                ];
                $user_id = wp_update_user($userdata);
            } else {
                $error .= "既に登録されています";
            }
        }
    }
    if (!$error) {
        //ユーザメール発行
        $multiple_recipients = [$email];
        $subj = '【重要／kyozon.】会員登録手続きのご案内';
        $url = "https://kyozon.net/register/profile-entry/?email=" . urlencode($email) . "&key=" . $pass;
        $body = <<<EOM
この度は「kyozon.」にご登録のお申し込みをいただきまして、誠にありがとうございます。
下記URLにアクセスして、会員登録手続きを行ってください（登録手続きはまだ完了していません）。

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

======================================================================
　株式会社コミクス
　東京都渋谷区円山町15-4　近藤ビル2階・6階

EOM;
        if (wp_mail($multiple_recipients, $subj, $body)) {
            wp_safe_redirect("/register/mail-complete");
        }
        else {
            $error .= "メール送信エラー";
        }
    }
}
?>
<!-- -->
<head>
<?php
    wp_head();
    ?>
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
			<h1>会員登録</h1>
		</div>
		<div class="popup_body">
			<div class="form_header">
				<h2>メールアドレスで登録</h2>
			</div>
			<div class="form_container">
				<div class="form_body">
					<form action="<?php the_permalink(); ?>"
						  method="post">
                        <?php wp_nonce_field('register', 'register_nonce') ?>
						<div class="form_row">
							<input type="email"
								   name="user_email"
								   placeholder="メールアドレス"
								   value="<?php echo $email; ?>"/>
						</div>
						<div class="form_row">
							<input type="email"
								   name="user_email2"
								    
								   placeholder="(確認用)"/>
						</div>
						<div class="form_row">
							<input type="submit"
								   label="会員登録(無料)">
						</div>
                        <?php if (!empty($error)): ?>
							<div class="form_row form_error">
								<p><?php echo $error; ?></p>
							</div>
                        <?php endif; ?>
					</form>
				</div>
			</div>
			<div class="form_footer">
				アカウントを作成すると、<a href="/company/terms-of-use/"
							   target="_blank">利用規約</a>・<a href="http://comix.co.jp/privacypolicy.html"
														   target="_blank">プライバシーポリシー</a>、<br>およびCookieの使用に同意したことになります
			</div>
		</div>
		<div class="popupu_footer">

		</div>
	</div>
</main>
