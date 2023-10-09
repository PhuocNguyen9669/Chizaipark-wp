<?php
$args = array(
    'post_type' => 'seminar',
    'posts_per_page' => 3,
    'post_status' => 'publish',
);
$query = new WP_Query($args);
?>
<div class="areaSeminar">
    <h2 class="infoTitle">セミナー情報</h2>
    <?php if ($query->have_posts()) : ?>
        <ul class="listSemina">
            <?php while ($query->have_posts()) :  $query->the_post(); ?>
                <?php get_template_part('template-parts/home/areaSeminar-item'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    <?php else :
        get_template_part('template-parts/item-none');
    endif; ?>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/seminar"><span>セミナー情報へ</span></a></p>
</div>