<?php

/**
 * The template for displaying all single posts
 */

get_header(); ?>
<div id="content">
	<div id="main" class="df">
		<h2 class="mainTitle">知財ニュース</h2>
	</div>
	<?php get_template_part('template-parts/site-breadcrumb'); ?>
	<!-- #breadcrumbs -->
	<?php if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<div class="areaDetail">
				<div class="bigInner">
					<div class="blockDetail">
						<h2 class="detailTitle"><?php the_title(); ?></h2>
						<div class="boxContent">
							<div class="boxName">
							<?php if(get_field('seminar_name_company')) : ?>
								<h3 class="nameCompany"><?php the_field('seminar_name_company'); ?></h3>
							<?php endif; ?>
								<?php get_template_part('template-parts/seminar/social-item'); ?>
							</div>
							<?php the_content(); ?>
						</div>
						<div class="colRight">
							<p class="date"><span class="time"><?php the_modified_time('Y.m.d'); ?></span> UPDATE</p>
							<?php get_template_part('template-parts/seminar/social-item'); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;	wp_reset_postdata();
	endif; ?>
</div>
<?php get_footer(); ?>