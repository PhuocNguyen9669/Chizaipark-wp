<li>
    <div class="cateInfo">
        <p class="region"><?php theTaxsPost('taxonomy_joseikin'); ?></p>
        <?php if (get_field('joseikin_recruitment_period')) : ?>
            <p class="date">公募期間：<?php the_field('joseikin_recruitment_period'); ?> 〜
            <?php endif; ?>
            <?php if (get_field('joseikin_recruitment_period_has_ended')) : ?>
                <?php the_field('joseikin_recruitment_period_has_ended'); ?> </p>
        <?php endif; ?>
    </div>
    <h3 class="infoTitleNews"><?php the_title(); ?></h3>
    <p class="infoIntro"><?php the_content(); ?></p>
    <div class="boxDetail">
        <p class="maxPrice"><span class="max">上限金額・助成額</span><span class="price">
            <?php if (get_field('joseikin_maximum_amount')) : ?>
                <?php the_field('joseikin_maximum_amount'); ?>
            <?php endif; ?></span>
        </p>
        <p class="btnDetail"><a href="<?php the_permalink(); ?>"><span>詳細はこちら</span></a></p>
    </div>
</li>