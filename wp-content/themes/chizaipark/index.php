<?php
/**
 * The main template file
 */

get_header(); ?>


<div id="content">
	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/item' ); ?>
		<?php endwhile; ?>

	<?php endif; ?>
</div>
<!-- #content -->


<?php get_footer(); ?>