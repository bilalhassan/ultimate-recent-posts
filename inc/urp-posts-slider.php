<?php
/**
 * Creates the posts slider
 */


?>
<h2>Recent Posts</h2>

<div id="banner-fade">
<ul class="bjqs">
    <?php

    $args = array(
        'numberposts' => '5'
    );


    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $post) { ?>
        <li>
            <?php
                $url = wp_get_attachment_url( get_post_thumbnail_id($post['ID']) );

            ?>
            <img src="<?php echo $url;?> " title="<?php echo $post['post_title']; ?>"/>
        </li>


<?php
//        $output = "";
//        $output = "<li>";
//        $output .= '<a class="scp_thumb" href="' . get_permalink($post["ID"])
//            . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
//            . get_the_post_thumbnail($post["ID"], "large") . '</a>';
//        $output .= '<a class="scp_title" href="' . get_permalink($post["ID"])
//            . '" title="Look ' . esc_attr($post["post_title"]) . '" >'
//            . $post["post_title"] . '</a> </li> ';
//
//        echo $output;
    }
    ?>
</ul>
</div>

<!--    <div id="banner-fade">-->
<!--    <!-- start Basic Jquery Slider -->
<!--    <ul class="bjqs">-->
<!--        <li><img src="img/banner01.jpg" title="Automatically generated caption"></li>-->
<!--        <li><img src="img/banner02.jpg" title="Automatically generated caption"></li>-->
<!--        <li><img src="img/banner03.jpg" title="Automatically generated caption"></li>-->
<!--    </ul>-->
    <!-- end Basic jQuery Slider -->















