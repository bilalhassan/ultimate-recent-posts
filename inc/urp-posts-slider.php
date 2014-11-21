<?php
/**
 * Creates the posts slider
 */
?>
<div class="fluid_container">
    <div class="camera_wrap" id="camera_wrap_2">
        <?php
        $args = array(
            'numberposts' => get_option('sc_urp_num_posts', 4),
            'post_status' => 'publish',
            'post_type' => 'post',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'category_name' => get_option('sc_urp_category', 0),
            'tag' => get_option('sc_urp_tag', 0),
        );
        ?>
        <?php $recent_posts = wp_get_recent_posts($args); ?>
        <?php foreach ($recent_posts as $post) { ?>
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post['ID'])); ?>
            <?php $permalink = get_permalink($post['ID']); ?>
            <div data-thumb="<?php echo $url; ?>" data-src="<?php echo $url; ?>" data-link="<?php echo $permalink; ?>">
                <div class="camera_caption fadeFromBottom">
                    <a href="<?php echo $permalink;?>">
                        <?php echo $post['post_title']; ?>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    jQuery(document).ready(function($){
        $('#camera_wrap_2').camera({
            height: '<?php echo get_option('sc_urp_height', 400); ?>px',
            pagination: false,
            thumbnails: false,
            fx: 'simpleFade',
            time: <?php echo get_option('sc_urp_slide_timer'); ?>
        });
    });
</script>








