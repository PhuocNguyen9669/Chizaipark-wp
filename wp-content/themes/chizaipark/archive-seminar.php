<?php

/**
 * The template for displaying Archive pages
 */
$seminar_list = new WP_Query(array(
	'posts_per_page' => '10',
	'post_type' => 'seminar',
	'post_status' => 'publish',
	'paged' => get_query_paged(),
	'hide_empty' => false,
	'tax_query' => array(
		array(
			'taxonomy' => 'taxonomy_seminar',
			'field' => 'slug',
			'operator' => 'EXISTS',
		),
	),
));
get_header(); ?>
<div id="main" class="df">
	<h2 class="mainTitle">セミナー情報</h2>
</div>
<div id="content">
	<?php get_template_part('template-parts/site-breadcrumb'); ?>
	<!-- #breadcrumbs -->
	<div class="bigInner">
		<div class="wrapContent">
			<div class="contentLetf areaSeminar">
				<h2 class="infoTitle">セミナー情報</h2>
				<p class="numnews">200件中1〜10件</p>
				<?php
				if ($seminar_list->have_posts()) : ?>
					<ul class="listSemina">
						<?php while ($seminar_list->have_posts()) : $seminar_list->the_post();
							get_template_part('template-parts/seminar/seminar-item');
						endwhile; wp_reset_postdata(); ?>
					</ul>
				<?php else :
					get_template_part('template-parts/item-none');
				endif;
				?>
				<?php theme_pagination($seminar_list); ?>
				<!-- pagingNav -->
			</div>
			<?php get_template_part('template-parts/joseikin/sideBar'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>