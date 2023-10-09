<div class="sideBar">
    <div class="boxRegion">
        <h2 class="regionTitle">地域別</h2>
        <?php
        $taxonomy = 'taxonomy_joseikin';
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'parent' => 0,
        ));
        foreach ($terms as $term) :
            $child_terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
                'parent' => $term->term_id,
            ));
            if ($term->parent === 0 && count($child_terms) > 0) : ?>
                <div class="regionBox">
                    <h3 class="listregionTitle first"><?php echo $term->name; ?></h3>
                    <ul class="listregion">
                        <?php
                        foreach ($child_terms as $child_term) :
                            $term_link = get_term_link($child_term); ?>
                            <li>
                                <a href="<?php echo esc_url($term_link);  ?>"><span><?php echo $child_term->name; ?></span></a>
                            </li>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </ul>
                </div>
            <?php endif;
        endforeach; ?>
        <div class="regionBox">
            <h3 class="listregionTitle">全国</h3>
        </div>
    </div>
</div>