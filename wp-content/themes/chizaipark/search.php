<?php

/**
 * The template for displaying Search Results pages
 */
$keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$args = array(
	'post_type' => array('post', 'joseikin', 'seminar'),
	's' => $keyword,
	'posts_per_page' => 10,
	'paged' => get_query_paged(),
	'post_status' => 'publish',	
);
$query = new WP_Query($args);

get_header(); ?>

<div id="main" class="df">
</div>
<div id="content">
	<div class="areaVenture">
		<div class="inner">
			<div class="boxPost">
				<?php if ($query->have_posts()) : ?>
					<h1 class="page-title"><?php printf(__('Search Results for: %s', THEME_NAME), get_search_query()); ?></h1>
					<ul class="boxList">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<?php get_template_part('template-parts/search-result') ?>
						<?php endwhile;
						wp_reset_query(); ?>
					</ul>
				<?php else : ?>
					<?php get_template_part('template-parts/no-result') ?>
				<?php endif; ?>
				<?php theme_pagination($query); ?>
				<!-- pagingNav -->
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>