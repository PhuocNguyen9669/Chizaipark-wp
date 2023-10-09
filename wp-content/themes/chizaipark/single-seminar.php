<?php

/**
 * The template for displaying all single posts
 */

use function AC\Vendor\DI\value;

get_header(); ?>
<div id="content">
	<div id="main" class="df">
		<h2 class="mainTitle">セミナー情報</h2>
	</div>
	<?php get_template_part('template-parts/site-breadcrumb'); ?>
	<!-- #breadcrumbs -->
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="areaSaminarDetail">
				<div class="bigInner">
					<div class="wrapContent">
						<h2 class="infoTitle">オンラインセミナー：契約の基礎と知的財産権リスクに関わる取決めに<br>ついて </h2>
						<?php get_template_part('template-parts/seminar/social-item'); ?>
						<div class="contentSamiraDetail">
							<?php
							$senimar_data = [
								'seminar_purpose' => '目的',
								'seminar_target_details' => '対象者の詳細',
								'seminar_date_and_time' => '開催日時',
								'seminar_teacher' => '講師',
								'seminar_recruitment_period' => '募集期間',
								'seminar_contact_information' => '問い合わせ先',
								'seminar_name_company' => '会社名',
							];
							foreach ($senimar_data as $seminar_key => $seminar_label) :
								$seminar_value = get_field($seminar_key);
								if ($seminar_value) : ?>
									<h4><?php echo $seminar_label; ?></h4>
									<p><?php echo $seminar_value;  ?></p>
								<?php endif;
							endforeach;	?>
						</div>
						<p class="buttonSeminarDetail"><a href="<?php homeUrl(); ?>">応募ページへ移動</a></p>
					</div>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata();
	endif; ?>
</div>
<?php get_footer(); ?>