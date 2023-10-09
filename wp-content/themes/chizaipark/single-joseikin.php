<?php

/**
 * The template for displaying all single posts
 */

get_header(); ?>
<div id="content">
    <div id="main" class="df">
        <h2 class="mainTitle">知財パークとは</h2>
    </div>
    <?php get_template_part('template-parts/site-breadcrumb'); ?>
    <!-- breadcrumbs -->
    <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="areaAfterLogin noto">
                <div class="bigInner">
                    <div class="afterLoginWarp">
                        <h2 class="infoTitle"><?php the_title(); ?></h2>
                        <p class="description"><?php the_content(); ?></p>
                        <table class="tableAfterLogin">
                            <tbody>
                                <?php
                                $joseikin_data = [
                                    'joseikin_region' => '地域',
                                    'joseikin_implementing_agency' => '実施機関',
                                    'joseikin_recruitment_period' => '公募期間',
                                    'joseikin_maximum_amount' => '上限金額・助成額',
                                    'joseikin_subsidy_rate' => '補助率',
                                    'joseikin_purpose_of_use' => '利用目的',
                                ];
                                foreach ($joseikin_data as $joseikin_key => $joseikin_label) :
                                    $joseikin_value = get_field($joseikin_key);
                                    if ($joseikin_value) : ?>
                                        <tr>
                                            <th><?php echo $joseikin_label; ?></th>
                                            <td><?php echo $joseikin_value; ?></td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                                <?php if (get_field('joseikin_target_expenses')) : ?>
                                    <tr>
                                        <th>対象経費</th>
                                        <td><span class="dot">●</span><?php the_field('joseikin_target_expenses'); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (get_field('joseikin_official_recruitment_page')) : ?>
                                    <tr>
                                        <th>公式公募ページ</th>
                                        <td><a href="<?php the_field('joseikin_official_recruitment_page'); ?>" target="_blank"><?php the_field('joseikin_official_recruitment_page'); ?></a></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <p class="dateUpdate"><?php the_modified_time('Y.m.d'); ?> UPDATE</p>
                        <p class="buttonAfterLogin"><a href="<?php homeUrl(); ?>">応募ページへ移動</a></p>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata();
    endif; ?>
</div>

<?php get_footer(); ?>