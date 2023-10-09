<div class="areaExamples">
    <h2 class="examplesTitle">企業の活用事例</h2>
    <ul class="examplesList">
        <?php
        $relationship_field_values = get_field('pickup_seminar', 'option');
        if ($relationship_field_values) :
            foreach ($relationship_field_values as $post) : setup_postdata($post)?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="hover">
                        <p class="co"><?php the_field('name_company'); ?></p>
                        <p class="exLink"><?php the_title(); ?></p>
                    </a>
                </li>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php else : 
            get_template_part('template-parts/item-none');
        endif; ?>
    </ul>
    <p class="btnMore"><a href="<?php homeUrl(); ?>/seminar"><span>企業の活用事例</span></a></p>
</div>