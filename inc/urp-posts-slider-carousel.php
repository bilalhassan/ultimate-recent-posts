<?php
/**
 * carrousel template
 */

?>


    <div id="sc-carousel-slider" class="owl-carousel owl-theme">
        <?php
        $args = array(
            'numberposts' => '10',
            'post_status' => 'publish',
            'post_type' => 'post',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'category_name' => get_option('sc_urp_category'),
            'tag' => get_option('sc_urp_tag'),
        );
        ?>
        <?php $recent_posts = wp_get_recent_posts($args); ?>
        <?php foreach ($recent_posts as $post) { ?>
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post['ID'])); ?>
            <?php $permalink = get_permalink($post['ID']); ?>
            <div class="item">
                <a href="<?php echo $permalink; ?>">
                    <img src="<?php echo $url; ?>" />
                </a>
                <div class="overlay">
                    <a href="<?php echo $permalink; ?>">
                        <h3><?php echo $post['post_title']; ?></h3>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

<script>
    jQuery(document).ready(function($){
        $("#sc-carousel-slider").owlCarousel({

            autoPlay: <?php echo esc_js( get_option('sc_urp_slide_timer') ); ?>,
            items : <?php echo esc_js( get_option('sc_urp_carousel_number') ); ?>,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]

        });
    });
</script>