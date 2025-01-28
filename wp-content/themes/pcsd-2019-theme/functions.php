<?php
$asset_version = '1.0.7';
/*==========================================================================================
Add stylesheet to enqueue
============================================================================================*/
function theme_specific_stylesheet()
{
    global $asset_version;
    /*   REGISTER ALL JS FOR SITE */
    wp_register_script('404easterEgg', get_template_directory_uri() . '/assets/js/404.js', '', $asset_version, true);

    /*   CALL ALL CSS AND SCRIPTS FOR SITE */
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', '', $asset_version, false);
    wp_enqueue_script('slick-script', get_template_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), $asset_version, true);
    wp_enqueue_script('my-custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery', 'slick-script',), $asset_version, true);
    if (is_404()) {
        wp_enqueue_script('404easterEgg', null, null, true);
    }
}
add_action('wp_enqueue_scripts', 'theme_specific_stylesheet', 10);
/*==========================================================================================
Remove Version Number from WP
============================================================================================*/
remove_action('wp_head', 'wp_generator');
function wpt_remove_version()
{
    return '';
}
add_filter('the_generator', 'wpt_remove_version');

function wpbeginner_remove_version()
{
    return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/*==========================================================================================
// REMOVE WP EMOJI
============================================================================================*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
/*==========================================================================================
// Enable Featured Images
============================================================================================*/
add_theme_support('post-thumbnails');

/*==========================================================================================
removes the welcome panel from the dashboard page since
most users cant do the things it references anyway
============================================================================================*/
function pcsd_auto_hide_welcome()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
    $user_id = get_current_user_id();
    if (1 == get_user_meta($user_id, 'show_welcome_panel', true))
        update_user_meta($user_id, 'show_welcome_panel', 0);
}
add_action('load-index.php', 'pcsd_auto_hide_welcome');

/*==========================================================================================
Remove non needed meta boxes from the dashboard page.
============================================================================================*/
function pcsd_dashboard_setup()
{

    remove_meta_box('dashboard_primary', 'dashboard', 'side'); //Wordpress Blog info
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //At a Glance
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Quick Draft
    remove_meta_box('tinypng_dashboard_widget', 'dashboard', 'side'); //remove compressions widget
    remove_meta_box('dashboard_activity', 'dashboard', 'side'); // Activity
}
add_action('wp_dashboard_setup', 'pcsd_dashboard_setup');

/*==========================================================================================
Dashboard Widgets

Can be used to announce new things to the users of the site once they Log in
============================================================================================*/

function add_custom_dashboard_widgets()
{
    $site = get_bloginfo('name');
    wp_add_dashboard_widget(
        'wpexplorer_dashboard_widget', // Widget slug.
        'Welcome to the ' . $site . ' website', // Title.
        'custom_dashboard_widget_content' // Display function.
    );
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

/**
 * Create the function to output the contents of your Dashboard Widget.
 */

function custom_dashboard_widget_content()
{
    // Display whatever it is you want to show.
    $tutorialspage = get_bloginfo('url') . '/wp-admin/admin.php?page=pcsd_tutorial-admin-page.php';
    echo "Check out our new <a href=\"" . $tutorialspage . "\">Tutorials page</a> for helpful hints on how to accomplish your desired task.";
}

/*==========================================================================================
puts a note on each dashboard page to let content managers how to contact us.
============================================================================================*/
function pcsd_change_admin_footer()
{
    echo '<span id="footer-note">For any questions don\'t hesitate to contact the District Web Team Rob Francom(robertf@provo.edu).</span>';
}
add_filter('admin_footer_text', 'pcsd_change_admin_footer');
/*==========================================================================================
// Default Template for Teachers role
============================================================================================*/
function teacher_default_page_template()
{
    global $post;
    $user = wp_get_current_user();
    if (in_array('teacher', (array) $user->roles)) { //checks if the users role is "teacher"
        if (
            'page' == $post->post_type
            && 0 != count(get_page_templates($post))
            && get_option('page_for_posts') != $post->ID // Not the page for listing posts
            && '' == $post->page_template // Only when page_template is not set
        ) {
            $post->page_template = "template-teacherpage.php";
        }
    }
}
add_action('add_meta_boxes', 'teacher_default_page_template', 1);
/*==========================================================================================
add Tutorials page
============================================================================================*/
add_action('admin_menu', 'pcsd_tut_admin_menu');
function pcsd_tut_admin_menu()
{
    add_menu_page('Tutorials Dashboard', 'Tutorials', 'read', 'pcsd_tutorial-admin-page.php', 'pcsd_tutorial_admin_page', 'dashicons-media-default', 4);
}
function pcsd_tutorial_admin_page()
{
    $tuts_page = curl_init();
    // set URL and other appropriate options
    curl_setopt($tuts_page, CURLOPT_URL, 'https://globalassets.provo.edu/globalpages/tutorials-page.php');
    curl_setopt($tuts_page, CURLOPT_HEADER, 0);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($tuts_page, CURLOPT_SSL_VERIFYPEER, false);
    // grab URL and pass it to the browser
    curl_exec($tuts_page);
    // close cURL resource, and free up system resources
    curl_close($tuts_page);
}
/*==========================================================================================
Tracks User Registration
============================================================================================*/
//display the time the user logged in on the users screen in the dashboard
function new_modify_user_table($column)
{
    $column['user_registered'] = 'User Registered';
    return $column;
}
add_filter('manage_users_columns', 'new_modify_user_table');

function new_modify_user_table_row($val, $column_name, $user_id)
{
    switch ($column_name) {
        case 'user_registered':
            return get_the_author_meta('user_registered', $user_id);
            break;
        default:
    }
    return $val;
}
add_filter('manage_users_custom_column', 'new_modify_user_table_row', 10, 3);

/*==========================================================================================
File Upload Tips
============================================================================================*/

//use post-upload-ui hook for after upload box, use pre-upload-ui hook for before upload box
add_action('post-upload-ui', 'pcsd_media_upload_tips');

function pcsd_media_upload_tips()
{
?>
    <h2>Your file will be processed by the server. This may take a few minutes depending on the size of the file.</h2>
    <h3>Allowed File types: jpeg, mp3, mp4, png</h3>
<?php
};

/*==========================================================================================
Restrict File types allowed to upload
============================================================================================*/
/* sources used
https://wordpress.stackexchange.com/questions/44777/upload-mimes-filter-has-no-effect
https://bootstrapcreative.com/restrict-certain-file-mime-types-in-wordpress/
https://wordpress.stackexchange.com/questions/359862/restrict-image-uploads-to-a-certain-file-type

Full list of mime types
https://codex.wordpress.org/Uploading_Files
https://www.sitepoint.com/mime-types-complete-list/
*/
add_filter('upload_mimes', 'theme_allowed_mime_types');
function theme_allowed_mime_types($mime_types)
{
    // Default allowed MIME types for all users
    $mime_types = array(
        //image types
        'jpg|jpeg' => 'image/jpeg',
        'png' => 'image/png',
        //Video/Audio
        'mp3' => 'audio/mpeg3',
        'mp4|m4v' => 'video/mpeg'
    );

    // Additional MIME types for admin users
    if (current_user_can('editor') || current_user_can('administrator')) {
        $mime_types['pdf'] = 'application/pdf';
    }

    return $mime_types;
}
/*==========================================================================================
Editor Changes
============================================================================================*/
//turn on paste_as_text by default
function change_paste_as_text($mceInit, $editor_id)
{
    //NB this has no effect on the browser's right-click context menu's paste!
    $mceInit['paste_as_text'] = true;
    return $mceInit;
}
add_filter('tiny_mce_before_init', 'change_paste_as_text', 1, 2);
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats');
/*
 * Modify TinyMCE editor to remove H1, H4,H5,H5, PRE.
 */
function tiny_mce_remove_unused_formats($init)
{
    // Add block format elements you want to show in dropdown
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;';
    return $init;
}
/*==========================================================================================
Breadcrumbs
============================================================================================*/
function custom_breadcrumbs()
{

    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'News';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {

        // Build the breadcrums
        echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        if (!is_page() && !is_single()) {
            echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
            echo '<li class="separator separator-home"> ' . $separator . ' </li>';
        }


        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

            echo '<li class="item-current item-archive">' . post_type_archive_title($prefix, false) . '</li>';
        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive">' . $custom_tax_name . '</li>';
        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';
            } else {

                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';
            }
        } else if (is_category()) {

            // Category page
            echo '<li class="item-current item-cat">' . single_cat_title('', false) . '</li>';
        } else if (is_page()) {

            // Standard page
            if ($post->post_parent) {

                // If child page, get parents
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if (!isset($parents)) $parents = null;
                foreach ($anc as $ancestor) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"> ' . get_the_title() . '</li>';
            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"> ' . get_the_title() . '</li>';
            }
        } else if (is_tag()) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms($taxonomy, $args);
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '">' . $get_term_name . '</li>';
        } elseif (is_day()) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</li>';
        } else if (is_month()) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '">' . get_the_time('M') . ' Archives</li>';
        } else if (is_year()) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</li>';
        } else if (is_author()) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '">' . 'Author: ' . $userdata->display_name . '</li>';
        } else if (get_query_var('paged')) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</li>';
        } else if (is_search()) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '">Search results for: ' . get_search_query() . '</li>';
        } elseif (is_404()) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ol>';
    }
}
/*==========================================================================================
Single: Related Post Counter
============================================================================================*/
/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'single_post_count_install');
/* Runs on plugin deactivation*/
register_deactivation_hook(__FILE__, 'single_post_count_remove');

/* Creates new database field */
function single_post_count_install()
{
    add_option("single_post_count_data", 'Default', '', 'yes');
}

/* Deletes the database field */
function single_post_count_remove()
{
    delete_option('single_post_count_data');
}
/* Creates Page and puts it in the Posts sub menu for anyone that has the capability "unfiltered_html */
add_action('admin_menu', 'single_post_count_menu');

function single_post_count_menu()
{
    add_posts_page('Single Post Count Options', 'Single Post Count', 'publish_posts', 'singe-post-count-page', 'single_post_count_options');
}
/* option on the page to allow you to input a number */
function single_post_count_options()
{
    if (!current_user_can('unfiltered_html')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    } ?>
    <div class="wrap">
        <h2>Single Post Count</h2>
        <p>Insert a number between 3 and 21. Numbers divisible by 3 are best.
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>
            <label>How many Posts to display</label>
            <input type="number" min="3" max="30" step="3" name="single_post_count_data" id="single_post_count_data" value="<?php echo get_option('single_post_count_data'); ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="single_post_count_data" />
            <?php submit_button(); ?>

        </form>
    </div>
<?php }
/*==========================================================================================
// ShortCodes
============================================================================================*/

//For Two Column Layout [TwoColumn-Start]
function twoColumn_func($atts)
{
    return ' <div class="grid2"><div> ';
}
add_shortcode('TwoColumn-Start', 'twoColumn_func');

//For Two Column Layout [TwoColumn-First-Column-End]
function twoColumn2_func($atts)
{
    return ' </div><div> ';
}
add_shortcode('TwoColumn-First-Column-End', 'twoColumn2_func');

//For Two Column Layout [TwoColumn-Second-Column-End]
function twoColumn3_func($atts)
{
    return ' </div></div> ';
}
add_shortcode('TwoColumn-Second-Column-End', 'twoColumn3_func');

//[directory url=""]
function directory_func($atts)
{
    $category = shortcode_atts(array(
        'url' => 'something',
    ), $atts);
    $directory_url = "{$category['url']}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $directory_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $output = '<div class="staff-member-listing">' . $output . '</div>';
    return $output;
}
add_shortcode('directory', 'directory_func');

//[schedule_start_list]
function schedule_start_func()
{
    return '<div class="scheduleList">';
}
add_shortcode('schedule_start_list', 'schedule_start_func');
//[schedule_end_list]
function schedule_end_func()
{
    return '</div>';
}
add_shortcode('schedule_end_list', 'schedule_end_func');
// [get_teacher_access_menu]
function get_teacher_access_menu()
{
    echo '<ul class="imagelist">';
    // create a new cURL resource
    $get_teacher_access_menu = curl_init();
    // set URL and other appropriate options
    curl_setopt($get_teacher_access_menu, CURLOPT_URL, 'https://globalassets.provo.edu/globalpages/teacher_access_menu.php');
    curl_setopt($get_teacher_access_menu, CURLOPT_HEADER, 0);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($get_teacher_access_menu, CURLOPT_SSL_VERIFYPEER, false);
    // grab URL and pass it to the browser
    curl_exec($get_teacher_access_menu);
    // close cURL resource, and free up system resources
    curl_close($get_teacher_access_menu);
    echo '</ul>';
}
add_shortcode('get_teacher_access_menu', 'get_teacher_access_menu');
//====================================== Child Nutrition Menu Pulls ======================================
//[cn-menu]
function cn_global_menu()
{
    $cnmenuhandle = curl_init();
    $cnmenuurl = "https://globalassets.provo.edu/globalpages/childNutritionMenu.txt";
    // Set the url
    curl_setopt($cnmenuhandle, CURLOPT_URL, $cnmenuurl);
    // Set the result output to be a string.
    curl_setopt($cnmenuhandle, CURLOPT_RETURNTRANSFER, true);
    $cnmenuoutput = curl_exec($cnmenuhandle);
    // close the curl connection
    curl_close($cnmenuhandle);
    return $cnmenuoutput;
    // return '</div>';
}
add_shortcode('cn-menu', 'cn_global_menu');

//[cn-sidebar]
function cn_global_sidebarmenu()
{
    $cnmenuhandle = curl_init();
    $cnmenuurl = "https://globalassets.provo.edu/globalpages/childNutritionMenu-sidebar.php";
    // Set the url
    curl_setopt($cnmenuhandle, CURLOPT_URL, $cnmenuurl);
    // Set the result output to be a string.
    curl_setopt($cnmenuhandle, CURLOPT_RETURNTRANSFER, true);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($cnmenuhandle, CURLOPT_SSL_VERIFYPEER, false);
    $cnmenuoutput = curl_exec($cnmenuhandle);
    // close the curl connection
    curl_close($cnmenuhandle);
    return $cnmenuoutput;
    // return '</div>';
}
add_shortcode('cn-sidebar', 'cn_global_sidebarmenu');
/*
============================================
Collapsible Area Shortcode: [collapsible_area title="First h2 title" heading="h2"]Your content here[/collapsible_area]
============================================
*/
function collapsible_area_shortcode($atts, $content = null)
{
    static $collapsible_area_counter = 0;
    $collapsible_area_counter++;

    $atts = shortcode_atts(
        array(
            'title' => 'Click to Expand',
            'heading' => 'h2', // Default heading level
        ),
        $atts,
        'collapsible_area'
    );

    $heading_tag = in_array($atts['heading'], array('h2', 'h3')) ? $atts['heading'] : 'h2';
    $unique_id = 'collapsible-area-' . $collapsible_area_counter;

    ob_start();
?>
    <div class="collapsible-area" id="<?php echo $unique_id; ?>">
        <<?php echo $heading_tag; ?> class="collapsible-button"><?php echo esc_html($atts['title']); ?></<?php echo $heading_tag; ?>>
        <div class="collapsible-content" style="display: none;">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>

<?php
    return ob_get_clean();
}
add_shortcode('collapsible_area', 'collapsible_area_shortcode');
/*
============================================
Collapsible Area Shortcode: [nested_collapsible_area title="First h2 title" heading="h2"]Your content here[/collapsible_area]
============================================
*/
function nested_collapsible_area_shortcode($atts, $content = null)
{
    static $nested_collapsible_area_counter = 0;
    $nested_collapsible_area_counter++;

    $atts = shortcode_atts(
        array(
            'title' => 'Click to Expand',
            'heading' => 'h3', // Default heading level for nested collapsible areas
        ),
        $atts,
        'nested_collapsible_area'
    );

    $heading_tag = in_array($atts['heading'], array('h2', 'h3')) ? $atts['heading'] : 'h3';
    $unique_id = 'nested-collapsible-area-' . $nested_collapsible_area_counter;

    ob_start();
?>
    <div class="nested-collapsible-area" id="<?php echo $unique_id; ?>">
        <<?php echo $heading_tag; ?> class="collapsible-button"><?php echo esc_html($atts['title']); ?></<?php echo $heading_tag; ?>>
        <div class="collapsible-content" style="display: none;">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('nested_collapsible_area', 'nested_collapsible_area_shortcode');
//disable open in a new tab/window checkbox in TinyMCE
function disable_open_new_window()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('input#link-target-checkbox').prop('checked', false);
            $('#wp-link .link-target').css('visibility', 'hidden');
        });
    </script>
<?php
}
add_action('after_wp_tiny_mce', 'disable_open_new_window');

//================================Display Modified Date on Dashboard for Posts===================================

// Register Modified Date Column for both posts & pages
function modified_column_register($columns)
{
    $columns['Modified'] = __('Modified Date', 'show_modified_date_in_admin_lists');
    return $columns;
}
add_filter('manage_posts_columns', 'modified_column_register');
add_filter('manage_pages_columns', 'modified_column_register');

function modified_column_display($column_name, $post_id)
{
    switch ($column_name) {
        case 'Modified':
            global $post;
            echo '<p class="mod-date">';
            echo '<em>' . get_the_modified_date() . ' ' . get_the_modified_time() . '</em><br />';
            echo '<small>' . esc_html__('by ', 'show_modified_date_in_admin_lists') . '<strong>' . get_the_modified_author() . '<strong></small>';
            echo '</p>';
            break; // end all case breaks
    }
}
add_action('manage_posts_custom_column', 'modified_column_display', 10, 2);
add_action('manage_pages_custom_column', 'modified_column_display', 10, 2);

function modified_column_register_sortable($columns)
{
    $columns['Modified'] = 'modified';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'modified_column_register_sortable');
add_filter('manage_edit-page_sortable_columns', 'modified_column_register_sortable');

/*-------------------------------------------------------*/
/* [district_school_year_calendar]
/*-------------------------------------------------------*/

function district_school_year_calendar_pull()
{
    // create a new cURL resource
    $schoolyear_cal = curl_init();
    // set URL and other appropriate options
    curl_setopt($schoolyear_cal, CURLOPT_URL, 'https://globalassets.provo.edu/globalpages/district-school-year-calendar.html');
    //ignores the header from the request
    curl_setopt($schoolyear_cal, CURLOPT_HEADER, 0);
    //sets a timeout incase it cant find the file so it doens't hang forever
    curl_setopt($schoolyear_cal, CURLOPT_TIMEOUT, 12);
    //so that it doesn't print the results right away and we can control where the results are printed
    curl_setopt($schoolyear_cal, CURLOPT_RETURNTRANSFER, TRUE);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($schoolyear_cal, CURLOPT_SSL_VERIFYPEER, false);
    // grab URL and pass it to the browser
    $result = curl_exec($schoolyear_cal);
    // close cURL resource, and free up system resources
    curl_close($schoolyear_cal);
    //prints results
    return $result;
}
add_shortcode('district_school_year_calendar', 'district_school_year_calendar_pull');
/*-------------------------------------------------------*/
/* [wpb_childpages]
/*-------------------------------------------------------*/
function wpb_list_child_pages()
{
    global $post;
    $parent_id   = $post->post_parent;
    $post_parent_slug = get_post_field('post_name', $parent_id);
    if (is_page() && $post->post_parent)
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
    if ($post->post_parent && $post_parent_slug !=  'teachers-directory') {
        $childpages = '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>' . $childpages;
    }
    if ($childpages) {
        $string = '<ul>' . $childpages . '</ul>';
    }
    return $string;
}
add_shortcode('wpb_childpages', 'wpb_list_child_pages');
/*-------------------------------------------------------*/
/* [wpb_parentpages]
/*-------------------------------------------------------*/
function wpb_list_parent_pages()
{
    global $post;
    $parent_id   = $post->post_parent;
    $post_parent_slug = get_post_field('post_name', $parent_id);
    if (is_page() && $post->post_parent)
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&exclude=' . $post->ID . '&echo=0');
    if ($post->post_parent && $post_parent_slug !=  'teachers-directory') {
        $childpages = '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>' . $childpages;
    }
    if ($childpages) {
        $string = '<ul>' . $childpages . '</ul>';
    }
    return $string;
}
add_shortcode('wpb_parentpages', 'wpb_list_parent_pages');

/*-------------------------------------------------------*/
/* Add Length Column to the Wordpress Dashboard
/*-------------------------------------------------------*/
//For Posts

//Add the Length column, next to the Title column:

add_filter('manage_post_posts_columns', function ($columns) {
    $_columns = [];

    foreach ((array) $columns as $key => $label) {
        $_columns[$key] = $label;
        if ('title' === $key)
            $_columns['wpse_post_content_length'] = __('Length');
    }
    return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_post_posts_custom_column', function ($column_name, $post_id) {
    if ($column_name == 'wpse_post_content_length')
        echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-post_sortable_columns', function ($columns) {
    $columns['wpse_post_content_length'] = 'wpse_post_content_length';
    return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
    $_orderby = $q->get('orderby');
    $_order   = $q->get('order');

    if (
        is_admin()
        && $q->is_main_query()
        && 'wpse_post_content_length' === $_orderby
        && in_array(strtolower($_order), ['asc', 'desc'])
    ) {
        global $wpdb;
        $orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
    }
    return $orderby;
}, 10, 2);

//For Pages

//Add the Length column, next to the Title column:

add_filter('manage_page_posts_columns', function ($columns) {
    $_columns = [];

    foreach ((array) $columns as $key => $label) {
        $_columns[$key] = $label;
        if ('title' === $key)
            $_columns['wpse_post_content_length'] = __('Length');
    }
    return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_page_posts_custom_column', function ($column_name, $post_id) {
    if ($column_name == 'wpse_post_content_length')
        echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-page_sortable_columns', function ($columns) {
    $columns['wpse_post_content_length'] = 'wpse_post_content_length';
    return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
    $_orderby = $q->get('orderby');
    $_order   = $q->get('order');

    if (
        is_admin()
        && $q->is_main_query()
        && 'wpse_post_content_length' === $_orderby
        && in_array(strtolower($_order), ['asc', 'desc'])
    ) {
        global $wpdb;
        $orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
    }
    return $orderby;
}, 10, 2);
//Notes

//If you want to target other post types, than we just have to modify the

//manage_post_posts_columns         -> manage_{POST_TYPE}_posts_columns
//manage_post_posts_custom_column   -> manage_{POST_TYPE}_posts_custom_column
//manage_edit-post_sortable_columns -> manage_edit-{POST_TYPE}_sortable_columns

//where POST_TYPE is the wanted post type.


/*-------------------------------------------------------*/
/* Converts Post Titles to Camel Case to keep from having obnoxious all caps titles
/*-------------------------------------------------------*/

function multiexplode($delimiters, $string)
{

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}


function to_title_case($string)
{
    /* Words that should be entirely lower-case */
    $articles_conjunctions_prepositions = array(
        'an',
        'the',
        'but',
        'or',
        'nor',
        'if',
        'is',
        'then',
        'else',
        'when',
        'at',
        'by',
        'from',
        'for',
        'in',
        'off',
        'on',
        'out',
        'over',
        'to',
        'into',
        'with',
        'of',
        'and',
    );
    /* Words that should be entirely upper-case (need to be lower-case in this list!) */
    $acronyms_and_such = array(
        'pcsd',
        'cte',
        'id',
        'i.d.',
        'vi',
        'stem',
        'ap',
        's.t.e.m.',
        's.t.e.a.m.',
        'pta',
        'p.t.a.',
        's.t.a.r.',
        'usda',
        'pe',
        'p.e.',
        'byu',
        'b.y.u.',
        'uvu',
        'u.v.u.',
        'psd',
        'act',
        'ths',
        'phs',
        'ihs',
        'cms',
        'dms',
        't.h.s.',
        'p.h.s.',
        'i.h.s.',
        'c.m.s.',
        'd.m.s.',
        'scc',
        '(scc)',
        'ksl',
        'naep',
        'fbla',
        'deca',
        'sep',
        'd.c.',
        'nyc',
        'cdc',
        'covid',
        'covid19',
        'covid-19'
    );
    $article_title_exceptions = array(
        'One-A' => 'one-a',
        'One-B' => 'one-b',
        'DeAnna' => 'deanna',
        'SafeUT' => 'safeut',
        'COVID-19' => 'covid-19',
        'SplashLearn' => 'splashlearn'
    );
    if (get_field('title_capitalization_override') == 0) {
        /* split title string into array of words */
        $words = multiexplode(array("-", " "), mb_strtolower($string));
        $words = preg_replace('/!+$/', '', $words);
        $words = preg_replace('/¡+$/', '', $words);
        $words = str_replace('(', '', $words);
        $words = str_replace(')', '', $words);

        /* iterate over words */
        foreach ($words as $position => $word) {
            /* re-capitalize acronyms */
            if (in_array($word, $article_title_exceptions)) {
                //echo array_search($word, $article_title_exceptions);
                //echo 'test';
                //print_r(array_keys($words));
                $words[$position] = array_search($word, $article_title_exceptions);
            } elseif (in_array($word, $acronyms_and_such)) {
                $words[$position] = strtoupper($word);
                /* capitalize first letter of all other words, if... */
            } elseif (
                /* ...first word of the title string... */
                0 === $position ||
                /* ...or not in above lower-case list*/
                !in_array($word, $articles_conjunctions_prepositions)
            ) {
                $words[$position] = ucwords($word);
            }
        }
        /* re-combine word array */
        $string = implode(' ', $words);
    }


    /* return title string in title case */
    return $string;
}
add_filter('the_title', 'to_title_case');

/*==========================================================================================
Remove fields from Admin profile page
============================================================================================*/
function cor_remove_personal_options($subject)
{
    //$subject = preg_replace('#<h2>'.__("Personal Options").'</h2>#s', '', $subject, 1); // Remove the "Personal Options" title
    $subject = preg_replace('#<tr class="user-rich-editing-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Visual Editor" field
    //$subject = preg_replace('#<tr class="user-comment-shortcuts-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Keyboard Shortcuts" field
    $subject = preg_replace('#<tr class="show-admin-bar(.*?)</tr>#s', '', $subject, 1); // Remove the "Toolbar" field
    $subject = preg_replace('#<h2>' . __("Name") . '</h2>#s', '', $subject, 1); // Remove the "Name" title
    //$subject = preg_replace('#<tr class="user-display-name-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Display name publicly as" field
    $subject = preg_replace('#<h2>' . __("Contact Info") . '</h2>#s', '', $subject, 1); // Remove the "Contact Info" title
    $subject = preg_replace('#<tr class="user-url-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Website" field
    $subject = preg_replace('#<h2>' . __("About Yourself") . '</h2>#s', '', $subject, 1); // Remove the "About Yourself" title
    $subject = preg_replace('#<tr class="user-description-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Biographical Info" field
    $subject = preg_replace('#<tr class="user-profile-picture(.*?)</tr>#s', '', $subject, 1); // Remove the "Profile Picture" field
    return $subject;
}
function cor_profile_subject_start()
{
    if (!current_user_can('manage_options')) {
        ob_start('cor_remove_personal_options');
    }
}
function cor_profile_subject_end()
{
    if (!current_user_can('manage_options')) {
        ob_end_flush();
    }
}
add_action('admin_head', 'cor_profile_subject_start');
add_action('admin_footer', 'cor_profile_subject_end');
/*==========================================================================================
change default link to attribute
============================================================================================*/
//This section sets the default to none so images aren't linked to anything unless explicitly told to
add_action('admin_init', 'yourslug_imagelink_setup', 10);
function yourslug_imagelink_setup()
{

    $image_set = get_option('image_default_link_type');

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
//This changes the gallery shortcode attributes to be what we expect so the styling is correct
add_filter(
    'shortcode_atts_gallery',
    function ($out) {
        $out['link'] = 'file';
        $out['columns'] = 5;
        $out['size'] = "medium";
        return $out;
    }
);
//This will make sure the default columns on galleries are always set to 5
function theme_gallery_defaults($settings)
{
    $settings['galleryDefaults']['columns'] = 5;
    return $settings;
}
add_filter('media_view_settings', 'theme_gallery_defaults');
//This will redirect any single posts that are in the announcement post type since we dont use those pages.
add_action('template_redirect', 'announcement_redirect_post');

function announcement_redirect_post()
{
    if (is_singular('announcement')) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
function remove_jetpack_menu_nonadmin()
{
    if (class_exists('Jetpack') && !current_user_can('manage_options')) {
        remove_menu_page('jetpack');
    }
}
add_action('admin_init', 'remove_jetpack_menu_nonadmin');
/*
=============================================================================================
define allowed block types
=============================================================================================
*/
add_filter('allowed_block_types', 'pcsd_allowed_block_types');

function pcsd_allowed_block_types($allowed_blocks)
{

    return array(
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/gallery',
        'core/list',
        'core/audio',
        'core/video',
        'core/table',
        'core/text-columns', // — Columns
        'core/buttons',
        //'core/quote', - need styling
        //'core/cover', //(previously core/cover-image)
        //'core/file', - we want to take a closer look at this one later
        //'core/verse', - revisit
        //'core/code', - needs styling
        //'core/freeform', // — Classic
        //'core/html', // — Custom HTML
        //'core/preformatted',
        //'core/pullquote', - revisit
        //(Deprecated) 'core/subhead', — Subheading
        //'core/media-text', // — Media and Text Revisit this one later
        //'core/more',
        //'core/nextpage', //— Page break
        //'core/separator',
        //'core/spacer',
        //'core/shortcode',
        //'core/archives',
        //'core/categories',
        //'core/latest-comments',
        //'core/latest-posts',
        //'core/calendar',
        //'core/rss',
        //'core/search',
        //'core/tag-cloud',
        //'core/embed',
        //'core-embed/twitter',
        //'core-embed/youtube',
        //'core-embed/facebook',
        //'core-embed/instagram',
        //'core-embed/wordpress',
        //'core-embed/soundcloud',
        //'core-embed/spotify',
        //'core-embed/flickr',
        //'core-embed/vimeo',
        //'core-embed/animoto',
        //'core-embed/cloudup',
        //'core-embed/collegehumor',
        //'core-embed/dailymotion',
        //'core-embed/funnyordie',
        //'core-embed/hulu',
        //'core-embed/imgur',
        //'core-embed/issuu',
        //'core-embed/kickstarter',
        //'core-embed/meetup-com',
        //'core-embed/mixcloud',
        //'core-embed/photobucket',
        //'core-embed/polldaddy',
        //'core-embed/reddit',
        //'core-embed/reverbnation',
        //'core-embed/screencast',
        //'core-embed/scribd',
        //'core-embed/slideshare',
        //'core-embed/smugmug',
        //'core-embed/speaker',
        //'core-embed/ted',
        //'core-embed/tumblr',
        //'core-embed/videopress',
        //'core-embed/wordpress-tv'
    );
}
/*
=============================================================================================
register or unregister block patterns
=============================================================================================
*/
function my_plugin_unregister_my_patterns()
{
    remove_theme_support('core-block-patterns');
    unregister_block_pattern_category('columns');
    unregister_block_pattern_category('gallery');
    unregister_block_pattern_category('text');
}
add_action('init', 'my_plugin_unregister_my_patterns');
//add_filter( 'show_admin_bar', '__return_true' );
