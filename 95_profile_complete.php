<?php
/**
 * Template Name: 会員情報登録完了画面
 * Template Post Type: page
 */
?>

<?php get_header(); ?>
<head>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700&display=swap&subset=japanese"
		  rel="stylesheet">

	<link rel="stylesheet"
		  href="/kyozon-theme/css/reset.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/style.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/css/popup_style.css">
	<style>
		.popup_base {
			display: flex;
			justify-content: center;
		}

		.popup_container {
			width: 80% !important;
		}
	</style>
	<script type="text/javascript">
        function goto_top() {
            document.location.href = "/";
        }

        function goto_mypage() {
            document.location.href = "/mypage/pages/";
        }
	</script>
</head>
<main>
	<div class="popup_base">
		<div class="popup_container">
			<div class="popupu_header">
				<h1>会員情報登録完了</h1>
			</div>
			<div class="popup_body">
				<div class="form_container">
					<div class="form_body">
						<div class="form_row form_message">
							会員登録が完了しました<br>
							引き続きご利用ください
						</div>
						<div class="form_row ">
							<button onclick="goto_top()">トップページへ</button>
						</div>

						<div class="form_row ">
							<button onclick="goto_mypage()">マイページへ</button>
						</div>
					</div>
				</div>
			</div>
			<div class="popupu_footer">

			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
