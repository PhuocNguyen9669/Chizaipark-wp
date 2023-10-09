<?php
/**
 * The template for displaying Category pages
 */
$kigyou_list = new WP_Query(array(
	'posts_per_page' => '10',
	'post_type' => 'post',
	'paged' => get_query_paged(),
	'hide_empty' => false,
	'post_status' => 'publish',
));
get_header(); ?>
<div id="content">
	<?php get_template_part('template-parts/site-breadcrumb'); ?>
	<div class="areaVenture">
		<div class="inner">
			<div class="boxPost">
				<div class="boxName">
					<h3 class="boxTitle">新着知財ニュース</h3>
					<p class="boxCount"><span class="quantity">200</span>件中<span class="fPost">1</span>〜<span class="lPost">10</span>件</p>
				</div>
				<?php if ($kigyou_list->have_posts()) : ?>
					<ul class="boxList">
						<?php while ($kigyou_list->have_posts()) : $kigyou_list->the_post(); ?>
							<?php get_template_part('template-parts/kigyou/kigyou-item'); ?>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</ul>
				<?php
				else :
					get_template_part('template-parts/item-none');
				endif;
				?>
				<?php theme_pagination($kigyou_list); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>