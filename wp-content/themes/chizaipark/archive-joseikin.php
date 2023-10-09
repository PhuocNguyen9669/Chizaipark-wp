<?php

/**
 * The template for displaying Archive pages
 */
$searchTax = isset($_GET['prefecture']) ? $_GET['prefecture'] : '';
$joseikin_list = new WP_Query(array(
	'posts_per_page' => '5',
	'post_status' => 'publish',
	'post_type' => 'joseikin',
	'paged' => get_query_paged(),
	'tax_query' => array(
		array(
			'taxonomy' => 'taxonomy_joseikin',
			'field' => 'slug',
			'operator' => 'EXISTS',
		),
	),
));
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
				<div class="boxNarrow">
					<h3 class="narrowTitle">絞り込み</h3>
					<form action="<?php homeUrl() ?>/joseikin" method="get">
						<div class="narrowSearch">
							<div class="rowSearch">
								<select id="region">
									<option value="">地域で選択</option>
									<?php
									$terms = get_terms( array('taxonomy' => 'taxonomy_joseikin','hide_empty' => false, 'parent' => 0,));
									if (isset($terms)) :
										foreach ($terms as $term) : ?>
											<option value="<?php echo esc_html($term->name); ?>" data-id="<?php echo $term->term_id; ?>"><?php echo esc_html($term->name); ?></option>
									<?php endforeach; wp_reset_postdata();
									endif; ?>
								</select>
							</div>
							<div class="rowSearch">
								<select id="prefecture" name="prefecture">
									<option value="">都道府県で選択</option>
								</select>
							</div>
						</div>
						<div class="boxaction">
							<div class="clear"><input type="reset" name="reset" value="クリア" class="noto"></div>
							<div class="find"><input id="submitBtn" type="submit" value="検索する" class="noto"></div>
						</div>
					</form>
				</div>
				<!-- boxNarrow -->
				<?php
				if ($searchTax) : 
					search_region($searchTax);
				else :
					if ($joseikin_list->have_posts()) : ?>
						<ul class="listInfo">
							<?php while ($joseikin_list->have_posts()) : $joseikin_list->the_post();
								get_template_part('template-parts/joseikin/joseikin-item');
							endwhile; ?>
						</ul>
					<?php else :
						get_template_part('template-parts/item-none');
					endif;
				endif;
				?>
				<!-- listInfo -->
				<?php if (empty($searchTax)) :
					theme_pagination($joseikin_list);
				endif ?>
				<!-- pagingNav -->
				<?php get_template_part('template-parts/home/home-searchMap'); ?>
				<!-- searchMap -->
			</div>
			<?php get_template_part('template-parts/joseikin/sideBar') ?>
		</div>
	</div>
</div>


<?php get_footer(); ?>