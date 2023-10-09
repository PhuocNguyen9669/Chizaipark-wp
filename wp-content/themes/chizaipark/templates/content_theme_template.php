<?php
/* 
*	Template Name: Content Theme Template
*/
?>

<?php get_header(); ?>


	<div id="content">
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

        <div class="headContent">
        	<div class="inner">
        		<div class="areaTitle">
                    <!-- <h2 class="titleMain maven"><?php //the_title(); ?></h2> -->
                </div>
        	</div>
        </div>

        <div class="pageContentWrap">
			<?php
				global $post;
				// CHECK PASSWORD
				if( post_password_required() ) {
					the_content();
				} else {
					$pageName = $post->post_name;
					$post_parent = ($post->post_parent > 0) ? get_post($post->post_parent) : null;
	                if( $post_parent ){
	                    $pageName = $post_parent->post_name . '-' . $pageName;
	                }
					get_template_part( 'pages/'.$pageName );
				}
			?>
		</div>
		
		<?php endwhile; ?>
    </div>
    <!-- #content -->

	
<?php get_footer(); ?>
