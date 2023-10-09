<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
);
$query = new WP_Query($args);
?>
<div class="areaVenture">
    <h3 class="boxTitle">知財ニュース</h3>
    <?php if ($query->have_posts()) : ?>
        <ul class="boxList">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/home/areaVenture-item'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    <?php else :
        get_template_part('template-parts/item-none');
    endif; ?>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/kigyou"><span>知財ニュース</span></a></p>
</div>