<?php get_header(); ?>
<div id="main" class="df">
</div>
<!-- #main -->
<div id="content">
    <div class="bigInner">
        <div class="wrapContent">
            <div class="contentLetf">
                <?php get_template_part('template-parts/home/home-areaGrant'); ?>
                <!-- areaGrant -->
                <?php get_template_part('template-parts/home/home-searchMap'); ?>
                <!-- searchMap -->
                <?php get_template_part('template-parts/home/home-areaVenture'); ?>
                <!-- areaVenture -->
                <?php get_template_part('template-parts/home/home-areaSeminar'); ?>
                <!-- areaSeminar -->
            </div>
            <!-- contentLetf -->
            <?php get_sidebar(); ?>
            <!-- sidebar -->
        </div>
    </div>
</div>
<!-- #content -->
<?php get_footer(); ?>