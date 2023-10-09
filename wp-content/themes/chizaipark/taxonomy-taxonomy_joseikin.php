<?php

/**
 * The template for displaying Archive pages
 */
$area = get_term_by("slug", $taxonomy_joseikin , 'taxonomy_joseikin');
$joseikin_cate_list = new WP_Query(
	array(
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'post_type' => 'joseikin',
		'paged' => get_query_paged(),
		'tax_query' => array(
			array(
				'taxonomy' => 'taxonomy_joseikin',
				'terms' => $area,
				'field' => 'slug',
			)
		)
	)
);
?>
<?php get_header(); ?>
<div id="main" class="df">
	<h2 class="mainTitle">助成金情報</h2>
</div>
<div id="content">
	<?php get_template_part('template-parts/site-breadcrumb'); ?>
	<!-- #breadcrumbs -->
	<div class="bigInner">
		<div class="wrapContent">
			<div class="contentLetf areaInfomation">
				<h2 class="infoTitle">新着助成金制度</h2>
				<!-- boxNarrow -->
				<?php if ($joseikin_cate_list->have_posts()) : ?>
					<ul class="listInfo">
						<?php while ($joseikin_cate_list->have_posts()) : $joseikin_cate_list->the_post();
							get_template_part('template-parts/joseikin/joseikin-item');
						endwhile; wp_reset_postdata(); ?>
					</ul>
				<?php else :
					get_template_part('template-parts/item-none');
				endif; ?>
				<!-- listInfo -->
				<?php if (isset($joseikin_cate_list)) :
					theme_pagination($joseikin_cate_list);
				endif; ?>
				<!-- pagingNav -->
				<?php get_template_part('template-parts/home/home-searchMap'); ?>
				<!-- searchMap -->
			</div>
			<?php get_template_part('template-parts/joseikin/sideBar') ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>