<?php

/**
 * MAIN FUNCTIONS
 */


// THE TAXS IN A POST
function theTaxsPost($tax_slug = 'category')
{
    global $post;
    if (!$post) return false;
    $tax_slug = ($tax_slug) ? $tax_slug : 'category';
    // GET RESULT
    $taxs_html = '';
    $taxonomies = wp_get_post_terms($post->ID, $tax_slug);
    foreach ($taxonomies as $taxonomy) {
        if ($taxonomy->term_id != 1) {
            $taxs_html .= '<a href="' . get_term_link($taxonomy) . '">' . $taxonomy->name . '</a>';
        }
    }
    echo $taxs_html;
}


// THE LIST TAX
function theTaxs($tax_slug = 'category')
{
    $tax_slug = ($tax_slug) ? $tax_slug : 'category';
    // GET RESULT
    $taxs_html = '';
    $taxonomies = get_terms($tax_slug);
    foreach ($taxonomies as $taxonomy) {
        if ($taxonomy->term_id != 1) {
            $taxs_html .= '<a href="' . get_term_link($taxonomy) . '">' . $taxonomy->name . '</a>';
        }
    }
    echo $taxs_html;
}


// THEME PAGINATION FUNCTION
function theme_pagination($post_query = null)
{
    global $paged, $wp_query;

    $translate['next'] = '&gt;';
    $translate['prev'] = '&lt;';

    if (empty($paged)) $paged = 1;
    $prev = $paged - 1;
    $next = $paged + 1;

    $end_size = 1;
    $mid_size = 2;
    $show_all = false;
    $dots = false;

    $pagi_query = $wp_query;
    if (isset($post_query) && $post_query) {
        $pagi_query = $post_query;
    }

    if (!$total = $pagi_query->max_num_pages) $total = 1;

    if ($total > 1) {
        echo '<div class="pagingNav">';
        echo '<ul class="navList">';

        if ($paged > 1) {
            echo '<li class="first"><a class="hover" href="' . get_pagenum_link(1) . '">&lt;&lt;</a></li>';
            echo '<li class="first"><a class="hover" href="' . previous_posts(false) . '">' . $translate['prev'] . '</a></li>';
        }

        for ($i = 1; $i <= $total; $i++) {
            if ($i == $paged) {
                echo '<li class="active"><a>' . $i . '</a></li>';
                $dots = true;
            } else {
                if ($show_all || ($i <= $end_size || ($paged && $i >= $paged - $mid_size && $i <= $paged + $mid_size) || $i > $total - $end_size)) {
                    echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
                    $dots = true;
                } elseif ($dots && !$show_all) {
                    echo '<li class="dots"><a>...</a></li>';
                    $dots = false;
                }
            }
        }

        if ($paged < $total) {
            echo '<li class="next"><a class="hover" href="' . next_posts(0, false) . '">' . $translate['next'] . '</a></li>';
            echo '<li class="last"><a class="hover" href="' . get_pagenum_link($total) . '">&gt;&gt;</a></li>';
        }

        echo '</ul>';
        echo '</div>';
    }
}


// GET QUERY PAGED NUMBER
function get_query_paged()
{
    return (get_query_var('paged')) ? get_query_var('paged') : 1;
}


// THE SINGLE PAGINATION
function the_single_pagination()
{
    $prev_post = get_previous_post();
    $next_post = get_next_post();
?>
    <ul class="pagination">
        <?php if ($prev_post) : ?>
            <li><a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev">ウィンターセール開催 !</a></li>
        <?php endif; ?>
        <?php if ($next_post) : ?>
            <li><a href="<?php echo get_permalink($next_post->ID); ?>" class="next">マリアナ　イベント開催 !</a></li>
        <?php endif; ?>
    </ul>
    <?php
}


//ACF OPTION PAGE
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}


//GET VALLUES CONTACT FORM 7 SESSION
add_action('wpcf7_mail_sent', 'save_cf7_data');
function save_cf7_data()
{
    if (session_id() == '') {
        session_start();
    }
    $current_submission = WPCF7_Submission::get_instance();
    $_SESSION['cf7_submission'] = $current_submission->get_posted_data();
}


//DELETE ELEMENT P THE CONTENT
function remove_paragraph_tags_from_content($content)
{
    $content = str_replace('<p>', '', $content);
    $content = str_replace('</p>', '', $content);
    return $content;
}
add_filter('the_content', 'remove_paragraph_tags_from_content', 20);


//PROCESS EVENT ONCHANGE SHOW CATEGORY CHILD USING AJAX
function load_prefectures()
{
    $region_id = isset($_POST['region_id']) ?  $_POST['region_id'] : '';
    $args = array(
        'taxonomy' => 'taxonomy_joseikin',
        'parent' => $region_id,
    );
    $prefectures = get_terms($args);
    if (!empty($prefectures) && !is_wp_error($prefectures)) {
        $prefectures_array = array();
        foreach ($prefectures as $prefecture) {
            $prefectures_array[] = array(
                'id' => $prefecture->term_id,
                'value' => $prefecture->slug,
                'name' => $prefecture->name,
            );
        }
        echo json_encode($prefectures_array);
    } else {
        echo json_encode(array());
    }
    wp_die();
}
add_action('wp_ajax_load_prefectures', 'load_prefectures');
add_action('wp_ajax_nopriv_load_prefectures', 'load_prefectures');


// ADD AJAX SEARCH CATEGORY FUNCTIONS
function add_ajax_search_category()
{
    if (is_post_type_archive('joseikin')) : ?>
        <script>
            jQuery(document).ready(function($) {
                $('#region').change(function() {
                    var regionID = $(this).find('option:selected').data('id');
                    $.ajax({
                        url: "<?php echo admin_url('admin-ajax.php') ?>",
                        method: 'POST',
                        data: {
                            action: 'load_prefectures',
                            region_id: regionID,
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            var prefectureSelect = $('#prefecture');
                            prefectureSelect.empty();
                            prefectureSelect.html('<option value="">都道府県で選択</option>');
                            if (regionID.value !== '') {
                                $.each(data, function(index, prefecture) {
                                    prefectureSelect.append('<option value="' + prefecture.value + '"data-id="' + prefecture.id + '">' + prefecture.name + '</option>');
                                });
                            }
                        }
                    });
                });
            });
        </script>
    <?php endif;
}
add_action('wp_footer', 'add_ajax_search_category');


// ADD AND SAVE COUNT VIEW POSTS
add_action('save_post', 'create_count_views', 10, 2);
function create_count_views($postId, $post)
{
    $count = get_post_meta($postId, 'views', true) ? get_post_meta($postId, 'views', true) : 0;
    update_post_meta($postId, 'views', $count);
}


//UPDATE COUNT VIEW POSTS
add_action('template_redirect', 'update_post_views');
function update_post_views()
{
    if (is_single() || is_singular('joseikin') || is_singular('seminar')) {
        $postId = get_the_ID();
        $count = get_post_meta($postId, 'views', true) ? get_post_meta($postId, 'views', true) : 0;
        $count++;
        update_post_meta($postId, 'views', $count);
    }
}


//SEARCH FORM POST TYPE JOSEIKIN
function search_region($searchTax)
{
    $searchTax = isset($_GET['prefecture']) ? $_GET['prefecture'] : '';
    $args = array(
        'post_type'      => 'joseikin',
        'posts_per_page' => 5,
        'paged'          => get_query_paged(),
        'post_status'    => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'taxonomy_joseikin',
                'field'    => 'slug',
                'terms'    => $searchTax,
            ),
        ),
    );
    $search_query = new WP_Query($args); ?>
    <?php if ($search_query->have_posts()) : ?>
        <ul class="listInfo">
            <?php while ($search_query->have_posts()) : $search_query->the_post();
                get_template_part('template-parts/joseikin/joseikin-item');
            endwhile;
            wp_reset_postdata(); ?>
        </ul>
        <?php theme_pagination($search_query);
    else :
        get_template_part('template-parts/item-none');
    endif;
}
