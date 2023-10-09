<li>
    <p class="date"><?php the_time('Y年m月d日'); ?><span class="th">（木）</span></p>
    <p class="cate"><?php theTaxsPost('taxonomy_seminar') ?></p>
    <p class="text"><a href="<?php the_permalink(); ?>" class="hover"><?php the_title(); ?></a></p>
    <div class="rowInfo">
        <?php if (get_field('time')) : ?>
            <p class="time"><?php the_field('time'); ?></p>
        <?php endif; ?>
        <?php if (get_field('address')) : ?>
            <p class="address"><?php the_field('address'); ?></p>
        <?php endif; ?>
        <?php if (get_field('money')) : ?>
            <p class="price"><?php the_field('money'); ?></p>
        <?php endif; ?>
        <?php if (get_field('dominate')) : ?>
            <p class="presided"><span>主宰：</span><?php the_field('dominate'); ?></p>
        <?php endif; ?>
    </div>
</li>