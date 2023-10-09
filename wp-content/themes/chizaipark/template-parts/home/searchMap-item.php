<?php if (get_field('search_map_nationwide', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/nationwide"><?php the_field('search_map_nationwide', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_kanto_hokkaido_tohoku', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/kanto_hokkaido_tohoku"><?php the_field('search_map_kanto_hokkaido_tohoku', 'option'); ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_center', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/center"><?php the_field('search_map_center', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_china', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/china"><?php the_field('search_map_china', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_kanto', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/kanto"><?php the_field('search_map_kanto', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_kinki', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/kinki"><?php the_field('search_map_kinki', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_kyushu-okinawa', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/kyushu-okinawa"><?php the_field('search_map_kyushu-okinawa', 'option') ?></a></li>
<?php endif; ?>
<?php if (get_field('search_map_shikoku', 'option')) : ?>
    <li><a href="<?php homeUrl(); ?>/taxonomy_joseikin/shikoku"><?php the_field('search_map_shikoku', 'option') ?></a></li>
<?php endif; ?>