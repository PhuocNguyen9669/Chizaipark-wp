<?php
/**
 * The template for displaying Post Taxonomies
 */

get_header(); ?>


<div id="content">

	<?php if ( have_posts() ) : ?>

		<h1 class="archive-title"><?php echo single_term_title(); ?></h1>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/item' ); ?>
		<?php endwhile; ?>

		<?php theme_pagination(); ?>

	<?php else : ?>
		<?php get_template_part( 'template-parts/item-none' ); ?>
	<?php endif; ?>

</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>