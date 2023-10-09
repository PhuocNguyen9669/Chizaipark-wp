
<?php
/* 
*	Template Name: Contact Finish Template
*/
session_start();
$email = isset($_SESSION['cf7_submission']['your_mail']) ? $_SESSION['cf7_submission']['your_mail'] : '';
unset($_SESSION['cf7_submission']['your_mail']);
?>
<?php get_header(); ?>
<!-- #header -->
<div id="content">
    <?php get_template_part('template-parts/site-breadcrumb'); ?>
    <!-- #breadcrumbs -->
    <div class="areaContact Step3">
        <div class="bigInner">
            <ul class="contactStep">
                <li class="step1">フォーム入力</li>
                <li class="step2">入力内容確認</li>
                <li class="step3 active">登録完了</li>
            </ul>
            <div class="formFinish">
                <h2 class="finishTitle">下記のメールアドレス宛に、お問い合わせ内容を送信致しました。ご確認くださいませ。</h2>
                <p class="iconFinish"><img src="<?php themeUrl(); ?>/assets/images/register/finish-checked.svg" alt=""></p>
                <p class="mailFinish"><?php echo $email; ?></p>
                <div class="contentFinish">
                    <p class="finishText">ご入力いただいたメールアドレスに受付完了について記載されたメールが送信されます。<br>なお、上記の内容のメールが届かない場合は「info@chizai-park.com」よりご連絡ください。</p>
                    <ul class="finishList">
                        <li>・フリーメールアドレスでのご登録は、登録完了手続きメールの到着が遅れる場合がございます</li>
                        <li>・自動的に迷惑メールフィルタで迷惑メールとして別フォルダに振り分けられている場合があります。</li>
                        <li>・メールは「<a href="mailto:info@chizai-park.com">info@chizai-park.com</a>」より送信されますので、受信拒否機能を設定されている場合は、ドメイン「<a href="https://chizai-park.com" target="_blank">chizai-park.com」</a>のメールが<br class="pc">受信できるように設定後、改めてお試しください。</li>
                        <li>・登録していただいたメールアドレスが間違っていたと予想される場合は、登録手続きを最初からやり直してください。</li>
                    </ul>
                    <p class="toTopPage"><a href="<?php homeUrl(); ?>">TOPへ戻る</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #content -->
<?php get_footer(); ?>


