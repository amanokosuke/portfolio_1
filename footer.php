<footer>
	<div class="footer_a">
		<div class="wrapper">
			<div class="footer_a1">
				<h3>  <img src="/kyozon-theme/img/keisai_rogo.png" alt="kyozon"></h3>
				<?php if (!is_user_logged_in()) { ?>
				<a class="header_login header_login_button footer_login"  href="#"
						   data-mfp-src="<?= home_url() ?>/login">ログイン</a>
				<?php } ?>
				<div class="header_sns">
                    <?=share_buttons()?>
				</div>
			</div>
			<div class="footer_a2">
				<div class="footer_list">
					<h3 class="for_user">for User</h3>
					<ul>
						<li><a href="/company/introduction">kyozon.とは</a></li>
						<li><a class="header_login_button" href="#"
						   data-mfp-src="<?= home_url() ?>/register">会員登録</a></li>
						
						<li>サービスカテゴリー</li>
						<li><ul class="footer_small_list">
								<div>
									<li><a href="/list/marketing/">マーケティング</a></li>
									<li><a href="/list/sales/">セールス</a></li>
									<li><a href="/list/service/">サービス</a></li>
									<li><a href="/list/cx/">カスタマーエクスペリエンス</a></li>

								</div>
								<div class="footer_small">
									<li><a href="/list/communication/">コミュニケーション</a></li>
									<li><a href="/list/data/">データ活用</a></li>
									<li><a href="/list/wlb/">働き方改革</a></li>
									<li><a href="/list/industry/">業界別サービス</a></li>
									<li><a href="/list/sdgs/">SDGs</a></li>
								</div>
							</ul>
						</li>
						<li>記事カテゴリー</li>
						<li><ul class="footer_small_list">
								<div>
									<li><a href="/list/marketing/article/">マーケティング</a></li>
									<li><a href="/list/sales/article/">セールス</a></li>
									<li><a href="/list/service/article/">サービス</a></li>
									<li><a href="/list/cx/article/">カスタマーエクスペリエンス</a></li>
								</div>
								<div class="footer_small">
									<li><a href="/list/communication/article/">コミュニケーション</a></li>
									<li><a href="/list/data/article/">データ活用</a></li>
									<li><a href="/list/wlb/article/">働き方改革</a></li>
									<li><a href="/list/industry/article/">業界別サービス</a></li>
									<li><a href="/list/sdgs/article/">SDGs</a></li>

								</div>
							</ul>
						</li>
					</ul>
				</div>
				<div class="footer_list">
					<h3>for Client</h3>
					<ul>
						<li><a href="/company/service-discription/">サービス掲載のご説明</a></li>
						<li><a href="/company/request/">サービス掲載のお申し込み</a></li>
					</ul>

					<h3 class="footer_interval">About me</h3>
					<ul>
						<li><a href="/company/contact/">お問い合わせ</a></li>
						<li><a href="/company/terms-of-use/">利用規約</a></li>
						<li><a href="https://www.comix.co.jp/privacypolicy.html">個人情報保護方針</a></li>
						<li><a href="https://www.comix.co.jp/company/">会社概要</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="footer_b">
		<div class="wrapper">
			<h3><img src="/kyozon-theme/img/comix.png" alt="COMIX"></h3>

			<small>Copyright(C) COMIX All Rights Reserved.</small>
		</div>
	</div>

</footer>
<?php wp_footer(); ?>
<div id="satori__creative_container">
    <script id="-_-satori_creative-_-" src="//delivery.satr.jp/js/creative_set.js" data-key="7ec4d6210cba330d"></script>
</div>
</body>
</html>


<?php add_user_history(); ?>