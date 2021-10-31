<?php
/**
 * Template Name: メール確認完了画面
 * Template Post Type: page
 */
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
	<script type="text/javascript">
        function register_done() {
            window.parent.login_complete();
        }
	</script>
</head>
<main>
	<div class="popup_container">
		<div class="popup_bar">
		</div>
		<div class="popupu_header">
			<h1>本人確認のメールを送信しました</h1>
		</div>
		<div class="popup_body">
			<div class="form_container">
				<div class="form_body">
					<div class="form_row form_message">
						ご入力いただいたアドレスにメールをお送りしました<br>
						メールに記載のURLより、会員登録を完了させてください
					</div>
				</div>
			</div>
			<div class="form_footer">
				<a href="#" onclick="register_done()">閉じる</a>
			</div>
		</div>
		<div class="popupu_footer">

		</div>
	</div>
</main>
