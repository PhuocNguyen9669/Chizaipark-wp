<?php
$args = [
    'post_type' => [
        'post', 'joseinki', 'seminar'
    ],
    'meta_key' => 'views',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 5,
];
$query = new WP_Query($args);
?>
<div class="areaRanking">
    <h2 class="rankingTitle">アクセスランキング</h2>
    <ul class="listRank">
        <?php if ($query->have_posts()) : $rank = 1; ?>
            <?php while ($query->have_posts()) : $query->the_post(); 
                setup_postdata($query);?>
                <li>
                    <p class="numRank"><span class="num num<?php echo $rank; ?>"><?php echo $rank; ?></span>位</p>
                    <p class="rankDetail"><a href="<?php the_permalink(); ?>" class="hover"><?php the_title(); ?></a></p>
                </li>
                <?php $rank++; ?>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else :
            get_template_part('template-parts/item-none');
        endif; ?>
    </ul>
</div>