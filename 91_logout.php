<?php
/**
 * Template Name: ログアウト画面
 * Template Post Type: page
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    wp_logout();
?>
<head>
	<script>
        window.parent.login_complete();
	</script>
</head>
	<?php
	exit();
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
	<form action="<?php the_permalink(); ?>"
		  method="post">
        <?php wp_nonce_field('login', 'login_nonce') ?>
		<div class="popup_container">
			<div class="popup_bar">
			</div>
			<div class="popupu_header">
				<h1>ログアウト</h1>
			</div>
			<div class="popup_body">
				<div class="form_header">
					<h2>本当にログアウトしますか？</h2>
				</div>
				<div class="form_container">
					<div class="form_body">
						<div class="form_row">						
						</div>
						<div class="form_row">						
						</div>
						<div class="form_row">						
						</div>
						<div class="form_row">						
						</div>
						<div class="form_row">
							<input type="submit" label="ログアウト" value="ログアウトする">
						</div>
					</div>
				</div>
			</div>
			<div class="popupu_footer">

			</div>
		</div>
	</form>
</main>
