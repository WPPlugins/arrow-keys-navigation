<?php
/* ***************************** */
/*     HANDLE AJAX requests      */
/* ***************************** */

/*** AJAX for visitors and users ***/
add_action( 'wp_ajax_akeynav_reqs', 'akeynav_reqs_callback' );
add_action( 'wp_ajax_nopriv_akeynav_reqs', 'akeynav_reqs_callback' );

/*** HANDLER function ***/
function akeynav_reqs_callback() {

    if (is_custom_post_type()):

    $url = wp_get_referer();
    $post_id = url_to_postid($url);

    //switch ACTIONS
    switch ($_POST['todo']) {
        case 'go_post':
            $kpress = $_POST['kpress'];
            $wildcard = explode(',', $_POST['wildcard']);
            //37 'Left arrow key pressed. GO PREVIOUS post';
            //39 'Right arrow key pressed. GO NEXT post';
            if ($kpress==37)
                $echo = trim($wildcard[0]);
            else
                $echo = trim($wildcard[1]);
        break;
    }
    //return values
    echo $echo;

    endif;
    wp_die();
}

if(!function_exists('ajaxes_js')){
    function ajaxes_js() {
    ?>
    <script>
        var ajaxurl = <?php echo json_encode(admin_url("admin-ajax.php")); ?>;
        var ajaxnonce = <?php echo json_encode(wp_create_nonce("__ajax_nonce" )); ?>;
    </script>
    <?php
    }
}
// Add hook for front-end <head></head>
add_action('wp_head', 'ajaxes_js');
