<?php

/**
 *  SETUP ASSETS
 */


// ADD ASSETS HEAD
add_action('wp_head', 'add_theme_assets_for_head', 50);
function add_theme_assets_for_head()
{
?>
    <!-- THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/common.css">
    <?php if (is_home() || is_front_page()) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/index.css">
    <?php elseif (is_post_type_archive('joseikin')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/joseikin.css">
    <?php elseif (is_post_type_archive('seminar')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/seminar.css">
    <?php elseif (is_tax('taxonomy_joseikin')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/joseikin.css">
    <?php elseif (is_tax('taxonomy_seminar')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/seminar.css">
    <?php elseif (is_category()) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/kigyou.css">
    <?php elseif (is_singular('joseikin')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/joseikin-detail.css">
    <?php elseif (is_singular('seminar')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/seminar-detail.css">
    <?php elseif (is_single()) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/kigyou-detail.css">
    <?php elseif (is_search()) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/kigyou.css">
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/search.css">
    <?php elseif (is_page('contact')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/contact.css">
        <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/libs/mCustomScrollbar/jquery.mCustomScrollbar.css">
        <?php
    elseif (is_page()) :
        global $post;
        $post_slug = $post->post_name;
        $post_parent = ($post->post_parent > 0) ? get_post($post->post_parent) : null;
        if ($post_parent) {
            $post_slug = $post_parent->post_name . '-' . $post_slug;
        }
        $page_css_uri = THEME_PATH . '/assets/css/' . $post_slug . '.css';
        if (is_file($page_css_uri)) :
        ?>
            <link rel="stylesheet" type="text/css" href="<?php themeUrl(); ?>/assets/css/<?php echo $post_slug; ?>.css">
    <?php endif;
    endif; ?>

    <!-- THEME SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php
}



// ADD ASSETS FOOTER
add_action('wp_footer', 'add_theme_assets_for_footer', 50);
function add_theme_assets_for_footer()
{
?>
    <!-- THEME SCRIPTS -->
    <script type="text/javascript" src="<?php themeUrl(); ?>/assets/js/script.js"></script>
    <?php if (is_page('contact')) : ?>
        <script type="text/javascript" src="<?php themeUrl(); ?>/assets/js/contact.js"></script>
        <script type="text/javascript" src="<?= themeUrl(); ?>/assets/libs/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <?php endif; ?>
<?php
}
