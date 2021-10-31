<?php
require get_template_directory() . '/kyozon_title_desc.php';
$title = get_kyozon_title();
$desc = get_kyozon_desc();
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr" xmlns="http://www.w3.org/1999/html">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PBDG8P7');</script>
<!-- End Google Tag Manager -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title><?=$title?></title>
	<meta name="description" content="<?=$desc?>"/>
	<meta name="twitter:card" content="<?=get_twitter_card()?>" />
	<meta property="og:url" content="<?=get_the_permalink()?>" />
	<?php if (strcmp(get_the_permalink(), (home_url() . "/")) == 0){?>
	<meta property="og:type" content="website">
	<?php } else { ?>
	<meta property="og:type" content="article">
	<?php } ?>
	<meta property="og:image" content="<?=get_ogimage_url()?>" />
	<meta property="og:title" content="<?=$title?>" />
	<meta property="og:description" content="<?=$desc?>" />
	<meta property="og:site_name" content="kyozon." />
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png">
    <?php
    wp_head();
    ?>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700&display=swap&subset=japanese"
		  rel="stylesheet">
	<script crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v6.0"></script>
	<script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script type="text/javascript">
        var is_logined = <?=is_user_logged_in() ? 1:0?>;
    </script>
</head>
<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBDG8P7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="fb-root"></div>
<header>
	<div class="header_1">
		<div class="wrapper">
			<div class="flex_row">
				<div class="header_button">
                    <?php if (!is_user_logged_in()) { ?>
						<a id="login_button"
                           class="header_login header_login_button"
                           href="#"
						   data-mfp-src="<?= home_url() ?>/login">ログイン</a>
						<a class="header_login_button"
                           href="#"
						   data-mfp-src="<?= home_url() ?>/register">会員登録</a>
                    <?php } else {
                        $user = wp_get_current_user();
                        $first_name = get_user_meta($user->ID, 'first_name', true);
                        $last_name = get_user_meta($user->ID, 'last_name', true); ?>
					<div class="header_button_logout_column">
						<a href="/mypage/pages/profile"
                           href="#"
						   class="header_signup"><?= $last_name ?>&nbsp;<?= $first_name ?>さん</a>
						<a class="header_login_button"
                           href="#"
						   data-mfp-src="<?= home_url() ?>/logout">ログアウト</a>
					</div>
                    <?php } ?>
				</div>
				<div class="header_button_sp">
                    <?php if (!is_user_logged_in()) { ?>
                    <a class="header_login_button"
                       data-mfp-src="<?= home_url() ?>/login">
                        <img src="/kyozon-theme/img/login.png"
                             alt="kyozon">
                        <p>ログイン</p>
                    </a>
                    <a class="header_login_button"
                       data-mfp-src="<?= home_url() ?>/register">
                        <img src="/kyozon-theme/img/signup.png"
                             alt="kyozon">
                        <p>会員登録</p>
                    </a>
                    <?php } else {
                        $user = wp_get_current_user();
                        $first_name = get_user_meta($user->ID, 'first_name', true);
                        $last_name = get_user_meta($user->ID, 'last_name', true); ?>
                    <a href="/mypage/pages/"
                       class="header_signup">
                        <p><?= $last_name ?>&nbsp;<?= $first_name ?>さん</p>
                    </a>
                    <?php } ?>
				</div>
				<div class="header_logo">
					<div class="rogo">
                    <?php if (strcmp(get_the_permalink(), (home_url() . "/")) == 0) { ?>
                        <a href="<?php echo home_url(); ?>">
                            <h1>
                                <img src="https://kyozon.net/images/logo.png" alt="kyozon.">
                            </h1>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo home_url(); ?>">
                            <img src="https://kyozon.net/images/logo.png" alt="kyozon.">
                        </a>
                    <?php } ?>
					</div>
				</div>
				<div class="top_search">
					<form method="get" action="/" class="top_search_kensaku">
						<input type="text"
							   name="q"
							   size="25"
							   placeholder="　キーワード検索"
							   value="<?php if( isset($_GET["q"])){ echo $_GET["q"]; } ?>">
						<input type="submit"
							   value="検索"
							   class="icn_search">
					</form>
					<div class="page_top_button">
						<a href="#top">TOP</a>
					</div>
				</div>
				<div class="sp_menu" id="sp_menu">
					<span class="menu_line menu_line1"></span>
					<span class="menu_line menu_line2"></span>
					<span class="menu_line menu_line3"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="header_2">
		<div class="wrapper" id="header_2_wrapper">
			<!--ヘッダーメニュー-->
			<div id="header_nav"
				 class="header_nav">
				<ul>
					<li><a href="<?php echo esc_url(home_url('/')); ?>">トップページ</a></li>
					<li>
						<div class="dropdown">
							<button class="dropbtn">サービスを探す</button>
							<div class="dropdown-content">
                                <?php
                                $terms = get_service_categories('0');
                                foreach ($terms as $term):
                                    ?>
									<a href="/list/<?= $term->slug ?>"><?= $term->name ?></a>
                                <?php
                                endforeach;
                                ?>
							</div>
						</div>
					</li>
					<li>
						<div class="dropdown">
							<button class="dropbtn">記事を探す</button>
							<div class="dropdown-content">
                                <?php
                                $terms = get_service_categories('0');
                                foreach ($terms as $term):
                                    ?>
									<a href="/list/<?= $term->slug ?>/article"><?= $term->name ?></a>
                                <?php
                                endforeach;
                                ?>
							</div>
						</div>
					</li>

					<?php if (is_user_logged_in()) { ?>
					<li><a href="/mypage/pages/">マイページ</a></li>
                    <?php } else { ?>
					<li><a href="/company/introduction">kyozon.とは</a></li>
                    <?php } ?>
				</ul>
			</div>
			<div class="header_sns">
                <?= share_buttons() ?>
			</div>
		</div>
	</div>
	<nav class="header_2_sp">
		<h2>Menu</h2>
		<ul>
            <?php if (!is_user_logged_in()) { ?>
            <li>
                <a class="header_login_button" data-mfp-src="<?= home_url() ?>/login">
                    <p>ログイン</p>
                </a>
            </li>
            <li>
                <a class="header_login_button" data-mfp-src="<?= home_url() ?>/register">
                <p>会員登録</p>
                </a>
            </li>
            <?php } ?>
			<?php if (is_user_logged_in()) { ?>
            <li><a href="/mypage/pages/">マイページ</a></li>
            <?php } else { ?>
            <li><a href="/company/introduction">kyozon.とは</a></li>
            <?php } ?>
			<li>
				<div class="dropdown_sp">
                    <li>記事を探す</li>
                    <div class="dropdown-content_sp">
                    <?php
                    $terms = get_service_categories('0');
                    foreach ($terms as $term):?>
                        <a href="/list/<?= $term->slug ?>/article"><?= $term->name ?></a>
                    <?php
                    endforeach;
                    ?>
                    </div>
                </div>
			</li>
			<li>
				<div class="dropdown_sp">
                    <li>サービスを探す</li>
                    <div class="dropdown-content_sp">
                    <?php
                    $terms = get_service_categories('0');
                    foreach ($terms as $term):?>
                        <a href="/list/<?= $term->slug ?>"><?= $term->name ?></a>
                    <?php
                    endforeach;
                    ?>
                    </div>
                </div>
			</li>
			<li>
                <a href="<?php echo esc_url(home_url('/')); ?>/company/service-discription" class="nav_interval">サービスを掲載したい</a>
            </li>
            <?php
            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                $first_name = get_user_meta($user->ID, 'first_name', true);
                $last_name = get_user_meta($user->ID, 'last_name', true); ?>
            <li>
                <a class="header_login_button" data-mfp-src="<?= home_url() ?>/logout">
                    <p>ログアウト</p>
                </a>
            </li>
            <?php } ?>
		</ul>
		<div class="header_sns">
            <?= share_buttons() ?>
		</div>
	</nav>
</header>
