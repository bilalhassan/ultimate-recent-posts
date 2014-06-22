<?php
/**
 * Creates the posts slider
 */


?>
<h2>Recent Posts</h2>
<ul>
    <?php

    $args = array(
        'numberposts' => '5'
    );
    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $post) {
        $output = "";
        $output = "<li>";
        $output .= '<a class="scp_thumb" href="' . get_permalink($post["ID"])
            . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
            . get_the_post_thumbnail($post["ID"], "large") . '</a>';
        $output .= '<a class="scp_title" href="' . get_permalink($post["ID"])
            . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
            . $post["post_title"] . '</a> </li> ';

        echo $output;
    }
    ?>
</ul>














