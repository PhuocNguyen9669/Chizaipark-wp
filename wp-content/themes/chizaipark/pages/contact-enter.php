<?php
/* 
*	Template Name: Contact Template
*/
?>
<?php get_header(); ?>
<div id="main" class="df">
	<h2 class="mainTitle">お問い合わせ</h2>
</div>
<div id="content">
    <?php get_template_part('template-parts/site-breadcrumb'); ?>
    <div class="areaContact Step1">
        <div class="bigInner">
            <ul class="contactStep">
                <li class="step1 active">フォーム入力</li>
                <li class="step2">入力内容確認</li>
                <li class="step3">登録完了</li>
            </ul>
            <div class="contactTable"></div>
            <h2 class="contactTitle">必須項目を入力して確認ボタンをクリックしてください。</h2>
            <div class="formContact">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>



