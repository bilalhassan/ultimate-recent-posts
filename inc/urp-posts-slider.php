<?php
/**
 * Creates the posts slider
 */


?>
<div class="fluid_container">
    <h2>Recent Posts</h2>

    <div class="camera_wrap" id="camera_wrap_2">
        <?php
        $args = array(
            'numberposts' => '5',
            'post_status' => 'publish'
        );
        ?>
        <?php $recent_posts = wp_get_recent_posts($args); ?>
        <?php foreach ($recent_posts as $post) { ?>
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post['ID'])); ?>
            <div data-thumb="<?php echo $url; ?>" data-src="<?php echo $url; ?>">
                <div class="camera_caption fadeFromBottom">
                    <?php echo $post['post_title']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>











