<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>


<div id="content" class="content-area">

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		</article>

	<?php endwhile; ?>

</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>