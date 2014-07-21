<?php
/**
 * carrousel template
 */

?>


    <div id="sc-carousel-slider" class="owl-carousel owl-theme">
        <?php
        $args = array(
            'numberposts' => '10',
            'post_status' => 'publish'
        );
        ?>
        <?php $recent_posts = wp_get_recent_posts($args); ?>
        <?php foreach ($recent_posts as $post) { ?>
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post['ID'])); ?>
            <div class="item">
                <img src="<?php echo $url; ?>" />
                <div class="overlay">
                    <h3>
                        <?php echo $post['post_title']; ?>
                    </h3>
                </div>
            </div>
        <?php } ?>
    </div>

<script>
    jQuery(document).ready(function($){
        $("#sc-carousel-slider").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 4,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]

        });
    });
</script>