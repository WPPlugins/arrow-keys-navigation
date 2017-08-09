<?php

/*** GET REGISTERED CUSTOM POST TYPES ***/
/*
**  This function returns an array containing the
    registered custom post types
*/
if (!function_exists('get_custom_post_types')) {
    function get_custom_post_types(){
        $args = array(
            'public'   => true,
            '_builtin' => false
        );
        $post_types = get_post_types( $args, 'names', 'and' );
        return $post_types;
    }
}


/*** IS CUSTOM POST TYPES ***/
/*
**  This function detects if current post is a custom post type.
*/
if (!function_exists('is_custom_post_type')) {
    function is_custom_post_type($include_posts = true){
        global $post;
        $custom_post_types = get_custom_post_types();
        if ($include_posts) $custom_post_types[] = 'post';
        $url     = wp_get_referer();
        $post_id = url_to_postid( $url );
        $current_post_type = get_post_type($post_id);
        //just in case
        if (!is_page() && $current_post_type=='page')
            $current_post_type = get_post_type($post->ID);
        if (in_array($current_post_type, $custom_post_types))
            return $current_post_type;
        else
            return false;
    }
}
