<?php
$args = array(
    'post_type' => 'joseikin',
    'posts_per_page' => 5,
    'post_status' => 'publish',
);
$query = new WP_Query($args);
?>
<div class="areaGrant">
    <h2 class="grantTitle">新着助成金制度</h2>
    <?php if ($query->have_posts()) : ?>
        <ul class="listPost">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/home/areaGrant-item') ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    <?php else :
        get_template_part('template-parts/item-none');
    endif; ?>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/joseikin"><span>助成金情報へ</span></a></p>
</div>