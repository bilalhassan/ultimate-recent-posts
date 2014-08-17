<?php
  include_once 'option.php';


?>
<form action="" method="post" id="wptb">
    <div class="left width70">
        <table class="widefat">
            <thead>
            <tr>
                <th colspan="2">General Settings</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Choose Template</td>
                <td>
                    <select class="ps" rel="box1" name="sc_urp_template">
                        <option
                            value="slider" <?php if ("default" == get_option('sc_urp_template')) echo 'selected="selected"'; ?>>
                            Slider
                        </option>
                        <option
                            value="carousel" <?php if ("carousel" == get_option('sc_urp_template')) echo 'selected="selected"'; ?>>
                            Carousel
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Choose Category</td>
                <td>
                    <select name="sc_urp_category">
                        <option value="">All</option>
                        <?php $categories = sc_urp_get_categories(); ?>
                        <?php foreach ( $categories as $category ) : ?>
                            <option value="<?php echo $category->name; ?>" <?php echo ($category->name == get_option('sc_urp_category')) ? 'selected=selected' : '';  ?>>
                                <?php echo $category->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                </td>
            </tr>
            
            <tr>
                <td>Choose Tags</td>
                <td>

                    <select name="sc_urp_tag">
                        <option value="">All</option>
                       <?php $tags = get_tags(); ?>
                        <?php foreach( $tags as $tag ) : ?>
                        <option value="<?php echo $tag->name; ?>" <?php echo ( $tag->name == get_option('sc_urp_tag') ) ? 'selected=selected' : ''; ?>>
                                <?php echo $tag->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="submit" name="sc_urp_submit" value="save" class="button-primary"/>
                </td>
            </tr>
        </table>
    </div>
</form>

<?php

function sc_urp_get_categories(){
    $args = array(
        'taxonomy' => 'category'
    );
    
    $categories = get_categories($args);

     return $categories;
    
}

function sc_urp_get_posts(){
    
}