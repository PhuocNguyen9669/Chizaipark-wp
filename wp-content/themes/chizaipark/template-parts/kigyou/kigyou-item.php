
<li>
    <?php if(get_field('seminar_name_company')) : ?>
        <p class="nameCompany"><?php the_field('seminar_name_company'); ?></p>
    <?php endif; ?>
    <p class="linkPost"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
</li>