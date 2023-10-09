<div class="areaVentures">
    <h2 class="ventureTitle">ベンチャー・キャピタル</h2>
    <ul class="ventureList">
        <?php
        $relationship_field_values = get_field('pickup_kigyou', 'option');
        if ($relationship_field_values) :
            foreach ($relationship_field_values as $post) : setup_postdata($post); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="hover"><?php the_title(); ?></a>
                </li>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php else :
            get_template_part('template-parts/item-none');
        endif; ?>
    </ul>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/venture_capital"><span>ベンチャー・キャピタルへ</span></a></p>
</div>