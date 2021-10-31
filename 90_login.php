<?php
/**
 * Template Name: ログイン画面
 * Template Post Type: page
 */
$email = "";
$error = "";

if (isset($_POST['login_nonce'])) {
    //nonceチェック
    if (!wp_verify_nonce($_POST['login_nonce'], 'login')) {
        $error .= '不正な遷移です';
    } else {
        //入力チェック
        if (!empty($_POST['user_email'])) {
            $email = $_POST['user_email'];
        } else {
            $error .= "メールアドレスを入力してください";
        }
        if (!empty($_POST['user_pass'])) {
            $password = $_POST['user_pass'];
        } else {
            $error .= "パスワードを入力してください";
        }
    }

    if (!$error) {
        //ユーザー取得
        $user = get_user_by('email', $email);
        if (false === $user) {
            $error .= "メールアドレスが間違っています。";
        } else {
            //ログイン実行
            $creds = [];
            $creds['user_login'] = $user->data->user_login;
            $creds['user_password'] = $password;
            $creds['remember'] = true;
            $user = wp_signon($creds, false);
            if (is_wp_error($user)) {
                if (array_key_exists('incorrect_password', $user->errors)) {
                    $error .= "パスワードが間違っています。";
                } else {
                    $error .= "ログインに失敗しました。";
                }
            } else { ?>
                <head>
                    <script>
                        window.parent.login_complete();
                    </script>
                </head>
                <?php
                exit();
            }
        }
    }
}
?>
<!-- -->
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
        <div class="popup_bar" id="popup_bar_login">
        </div>
        <div class="popupu_header">
            <h1>ログイン</h1>
        </div>
<!--         <div class="popup_flex"> -->
            <div class="popup_body" id="popup_body_login">
                <div class="form_container" 　id="form_container_login">
                    <div class="form_body" id="form_body_login">
                        <div class="form_row">
                            <h2>メールアドレスで登録</h2>
                        </div>
                        <form action="<?php the_permalink(); ?>"
                              method="post">
                            <?php wp_nonce_field('login', 'login_nonce') ?>

                            <div class="form_row">
                                <input type="email"
                                       name="user_email"
                                       placeholder="メールアドレス"
                                       value="<?php echo $email; ?>"/>
                            </div>
                            <div class="form_row">
                                <input type="password"
                                       placeholder="パスワード"
                                       name="user_pass"/>
                            </div>
                            <div class="form_row">
                                <input type="checkbox"
                                       name="keep_login"/>ログインしたままにする
                            </div>
                            <div class="form_row">
                                <input type="submit" label="ログインする">
                            </div>
                            <?php if (!empty($error)): ?>
                                <div class="form_row form_error">
                                    <p><?php echo $error; ?></p>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <div class="form_footer_password">
                    パスワードを忘れた方は<a href="/register/pw-remind/">こちら</a>&nbsp;&nbsp;
                </div>
            </div>
            <!---
            <div class="popup_sns">
                <div class="form_container" id="form_container_login">
                    <div class="form_body">
                        <div class="form_row">
                            <h2>SNSアカウントでログイン</h2>
                        </div>
                        <div class="form_row">
                            <a class="popup_facebook">Facebookでログイン</a>
                        </div>
                        <div class="form_row">
                            <a class="popup_twitter">Twitterでログイン</a>
                        </div>
                    </div>
                </div>
            </div>
            --->
<!--         </div> -->
        <div class="form_resister">
            <a href="/register/">会員登録はこちら</a>
        </div>

        <div class="popupu_footer">

        </div>
    </div>
</main>
