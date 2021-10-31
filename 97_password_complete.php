<?php
/**
 * Template Name: パスワード再発行完了画面
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
        function remind_done() {
            window.parent.login_complete();
        }
	</script>
</head>
<main>
	<div class="popup_container">
		<div class="popup_bar">
		</div>
		<div class="popupu_header">
			<h1>パスワードを再発行しました</h1>
		</div>
		<div class="popup_body">
			<div class="form_container">
				<div class="form_body">
					<div class="form_row form_message">
						仮パスワードを記載したメールをお送りしました<br>
						ご確認の上、ログインをしてください
					</div>
					<div class="form_row">
						<button onclick="remind_done()">ログイン画面へ</button>
					</div>
				</div>
			</div>
		</div>
		<div class="popupu_footer">

		</div>
	</div>
</main>