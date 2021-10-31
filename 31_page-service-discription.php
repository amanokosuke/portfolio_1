<!--
Template Name: 情報掲載について
Template Post Type: post, page, company
-->

<?php get_header(); ?>

<main>
  <div class="index_main ">


    <div class="index_contents not_sidebar">
      <div class="pankuzu">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
          <?php if(function_exists('bcn_display'))
          {
            bcn_display();
          }?>
</div>
      </div>

    <div class="service_discription">
      <div class="discription_top">
        <h2>あらゆるツールと共存する</h2>
      </div>
      <div class="discription_introduction">
        <h3>Kyozon.とは</h3>
        <div class="discription_introduction_2">
          <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          <img src="" alt="管理画面">
        </div>
      </div>
      <div class="discription_three">
        <h3>kyozonの３つの特徴</h3>
        <div class="discription_list">
          <div class="discription_content">
            <img src="" alt="資料を検索">
            <h3>リード獲得を支援します</h3>
              <div class="straght"></div>
              <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </div>
          <div class="discription_content">
            <img src="" alt="資料を検索">
            <h3>タイアップ記事広告</h3>
              <div class="straght"></div>
              <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </div>
          <div class="discription_content">
            <img src="" alt="資料を検索">
            <h3>見出し！！！</h3>
              <div class="straght"></div>
              <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </div>
        </div>

      </div>
      <div class="discription_plan">
        <h3>料金プラン</h3>
        <h4>資料1ダウンロード当たり￥2,000円</h4>
        <p>※他にもご希望に合わせたプランでご紹介いたします。質問等ございましたらお気軽にお問い合わせください。</p>
      </div>

      <div class="discription_end">
        <h3>サービスを掲載する前にまずお問い合わせください</h3>
        <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>/company/contact">お問合わせへ</a>
      </div>



    </div>

  </div>
</div>



</main>

<?php get_footer(); ?>
