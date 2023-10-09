<?php
/**
 * The template for displaying Author archive pages
 */

get_header(); ?>

	<div id="content">

		<?php if ( have_posts() ) : the_post(); ?>

			<h1 class="archive-title"><?php printf( __( 'All posts by %s', THEME_NAME ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . get_the_author() . '</a>' ); ?></h1>

			<?php rewind_posts(); ?>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
							$author_bio_avatar_size = apply_filters( 'mytheme_author_bio_avatar_size', 74 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2 class="author-title"><?php printf( __( 'About %s', THEME_NAME ), get_the_author() ); ?></h2>
						<p class="author-bio">
							<?php the_author_meta( 'description' ); ?>
							<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', THEME_NAME ), get_the_author() ); ?>
							</a>
						</p>
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/item' ); ?>
			<?php endwhile; ?>

			<?php theme_pagination(); ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/item-none' ); ?>
		<?php endif; ?>

	</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>