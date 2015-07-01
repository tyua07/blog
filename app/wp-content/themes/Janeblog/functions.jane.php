<?php
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
        'primary' => __('导航菜单', 'xinyiwa') ,
        'second' => __('页尾导航 ', 'xinyiwas')
    ));
};
function filter_nav_menu_css_class($classes) {
    $do_class_name = array(
        'current-menu-item'
    ); 
    $outPut = array_intersect($do_class_name, $classes);
    array_filter($classes);
    return $outPut;
};
add_filter('nav_menu_css_class', 'filter_nav_menu_css_class');
function redirect_non_admin_users() {
    if (!current_user_can('manage_options') && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'redirect_non_admin_users');
function exclude_category_home($query) {
    if ($query->is_home) {
        $query->set('cat', 'ID'); 
        $query->set('ignore_sticky_posts', '1'); 
        $query->set('orderby', 'date'); 
        $query->set('order', 'DESC'); 
    }
    return $query;
}
add_filter('pre_get_posts', 'exclude_category_home');
function janeblog_breadcrumbs() {
    $delimiter = '<i class="fa fa-angle-double-right"></i>'; 
    $before = '<span class="current">'; 
    $after = '</span>'; 
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div class="postion">' . __('<i class="fa fa-home"></i>', 'jane');
        global $post;
        $homeLink = home_url();
        echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __('首页', 'jane') . '</a> ' . $delimiter . ' ';
        if (is_category()) { 
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                $cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
                echo $cat_code = str_replace('<a', '<a itemprop="breadcrumb"', $cat_code);
            }
            echo $before . '' . single_cat_title('', false) . '' . $after;
        } elseif (is_day()) { 
            echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y') , get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) { 
            echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) { 
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) { 
            if (get_post_type() != 'post') { 
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . '正文' . $after;
            } else { 
                $cat = get_the_category();
                $cat = $cat[0];
                $cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $cat_code = str_replace('<a', '<a itemprop="breadcrumb"', $cat_code);
                echo $before . '正文' . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) { 
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . '正文' . $after;
        } elseif (is_page() && !$post->post_parent) { 
            echo $before . '正文' . $after;
        } elseif (is_page() && $post->post_parent) { 
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . '正文' . $after;
        } elseif (is_search()) { 
            echo $before;
            printf(__('搜索: %s', 'jane') , get_search_query());
            echo $after;
        } elseif (is_tag()) { 
            echo $before;
            printf(__('标签： %s', 'jane') , single_tag_title('', false));
            echo $after;
        } elseif (is_author()) { 
            global $author;
            $userdata = get_userdata($author);
            echo $before;
            printf(__('作者: %s', 'jane') , $userdata->display_name);
            echo $after;
        } elseif (is_404()) { 
            echo $before;
            _e('Not Found', 'jane');
            echo $after;
        }
        if (get_query_var('paged')) { 
            //if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
            //echo sprintf( __( '( Page %s )', 'jane' ), get_query_var('paged') );
        }
        echo '</div>';
    }
}
function lo_all_view() {
    global $wpdb;
    $count = 0;
    $views = $wpdb->get_results("SELECT * FROM {$wpdb->postmeta} WHERE meta_key='views'");
    foreach ($views as $key => $value) {
        $meta_value = $value->meta_value;
        if ($meta_value != ' ') {
            $count+= (int)$meta_value;
        }
    }
    return $count;
}
function custom_the_views($post_id, $echo = true, $views = ' 次') {
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == ' ') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }
    if ($echo) {
        echo number_format_i18n($count) . $views;
    } else {
        return number_format_i18n($count) . $views;
    }
}
function set_post_views() {
    global $post;
    $post_id = $post->ID;
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if (is_single() || is_page()) {
        if ($count == ' ') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }
    }
}
function Bing_text_indent($text) {
    $return = str_replace('<p', '<p style="text-indent:2em;"', $text);
    return $return;
}
add_filter('the_content', 'Bing_text_indent');
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
    if (empty($first_img)) { 
        $first_img = get_stylesheet_directory_uri() . '/images/thumb.png';
    }
    return $first_img;
}
function par_pagenavi($range = 9) {
    global $paged, $wp_query;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        if ($paged != 1) {
            echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'><i class='fa fa-chevron-circle-left'></i> first </a>";
        }
        previous_posts_link(" <i class='fa fa-chevron-circle-left'></i> ");
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a>";
            }
        }
        next_posts_link(" <i class='fa fa-chevron-circle-right'></i> ");
        if ($paged != $max_page) {
            echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> last <i class='fa fa-chevron-circle-right'></i> </a>";
        }
    }
}
add_filter('request', 'yundanran_author_link_request');
function yundanran_author_link_request($query_vars) {
    if (array_key_exists('author_name', $query_vars)) {
        global $wpdb;
        $author_id = $query_vars['author_name'];
        if ($author_id) {
            $query_vars['author'] = $author_id;
            unset($query_vars['author_name']);
        }
    }
    return $query_vars;
}
remove_filter('comment_text', 'make_clickable', 9);
function url_filtered($fields) {
    if (isset($fields['url'])) unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'url_filtered');
function disable_comment_author_links($author_link) {
    return strip_tags($author_link);
}
add_filter('get_comment_author_link', 'disable_comment_author_links');
function __search_by_title_only($search, &$wp_query) {
    global $wpdb;
    if (empty($search)) return $search; 
    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search = $searchand = '';
    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql(like_escape($term));
        $search.= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in()) $search.= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter('posts_search', '__search_by_title_only', 500, 2);
function Bing_search_filter_id($query) {
    if (!$query->is_admin && $query->is_search) {
        $query->set('post__not_in', array(
            'ID'
        )); 
    }
    return $query;
}
add_filter('pre_get_posts', 'Bing_search_filter_id');
function Bing_search_filter_category($query) {
    if (!$query->is_admin && $query->is_search) {
        $query->set('cat', 'ID'); 
    }
    return $query;
}
add_filter('pre_get_posts', 'Bing_search_filter_category');
function curPageURL() {
    $pageURL = 'http://';
    $this_page = $_SERVER["REQUEST_URI"];
    if (strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
    $pageURL.= $_SERVER["SERVER_NAME"] . $this_page;
    return $pageURL;
}
function jane_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo '<li class="comment" id="li-comment-' . get_comment_ID() . '">';
    echo '<div class="gravatar">';
    if (function_exists('get_avatar') && get_option('show_avatars')) {
        echo get_avatar($comment, 54); 
    }
    echo '</div>';
    echo '<div class="comment_content" id="comment-' . get_comment_ID() . '">';
    echo '<div class="comment-body">';
    printf(__('<cite class="author_name">%s</cite>') , get_comment_author_link()); 
    edit_comment_link('修改');
    echo '<div class="comment_text">';
    if ($comment->comment_approved == '0'): 
        echo '<em>你的评论正在审核，稍后会显示出来！</em><br/>';
        endif; 
        comment_text(); 
      echo '</div>';
    echo '</div>';
    echo '<div class="comment-meta commentmetadata">' . '发表于：' .  get_comment_time('Y-m-d H:i') . '</div>';
    echo '<div class="reply">';
	comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
	echo '</div>';
  echo '</div>';
};
function jane_fields($fields) {
$fields =  array(
	'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name<span class="required">*</span>' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email<span class="required">*</span>' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/></p>',
	);
	return $fields;
}
add_filter('comment_form_default_fields','jane_fields');
//结束 ?>
