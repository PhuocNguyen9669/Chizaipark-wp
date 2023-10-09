<div class="areaIntell">
    <h2 class="intellTitle">知財の活用事例</h2>
    <ul class="listIntell">
        <?php
        $relationship_field_values = get_field('pickup_joseikin', 'option');
        if ($relationship_field_values) :
            foreach ($relationship_field_values as $post) : setup_postdata($post) ?>
                <li>
                    <p class="date"><?php the_time('Y年m月d日', $post->ID); ?></p>
                        <p class="cate"><?php theTaxsPost('intellectual_propert') ?></a></p>
                    <p class="text"><a href="<?php the_permalink(); ?>" class="hover"><?php the_title($post->ID); ?></a></p>
                </li>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php else :
            get_template_part('template-parts/item-none');
        endif; ?>
    </ul>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/examples_intellectual_property"><span>知財活用事例へ</span></a></p>
</div>