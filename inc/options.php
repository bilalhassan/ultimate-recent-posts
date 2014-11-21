<?php
  include_once 'option.php';


?>
<form action="" method="post" id="wptb">
    <div class="left width70">
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="2">Appearance & Design</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                </tr>
                <tr id="">
                    <td>Slide Timer</td>
                    <td>
                        <select name="sc_urp_num_posts">
                            <option value="3" <?php echo ( 2000 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>2 seconds</option>
                            <option value="4" <?php echo ( 3000 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>3 seconds</option>
                            <option value="5" <?php echo ( 4000 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>4 seconds</option>
                            <option value="6" <?php echo ( 5000 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>5 seconds</option>
                            <option value="10" <?php echo ( 10 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>Off</option>
                            <option value="15" <?php echo ( 15 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>Off</option>
                        </select>
                    </td>
                <tr id="sc_urp_slide_timer">
                    <td>Slide Timer</td>
                    <td>
                        <select name="sc_urp_slide_timer">
                            
                            <option value="2000" <?php echo ( 2000 == get_option('sc_urp_slide_timer')) ? 'selected=selected' : ''; ?>>2 seconds</option>
                            <option value="3000" <?php echo ( 3000 == get_option('sc_urp_slide_timer')) ? 'selected=selected' : ''; ?>>3 seconds</option>
                            <option value="4000" <?php echo ( 4000 == get_option('sc_urp_slide_timer')) ? 'selected=selected' : ''; ?>>4 seconds</option>
                            <option value="5000" <?php echo ( 5000 == get_option('sc_urp_slide_timer')) ? 'selected=selected' : ''; ?>>5 seconds</option>
                            <option value="false" <?php echo ( 'false' == get_option('sc_urp_slide_timer')) ? 'selected=selected' : ''; ?>>Off</option>
                            
                        </select>
                    </td>
                </tr>
                <tr id="sc_urp_carousel_number">
                    <td>Carousel Slides per set</td>
                    <td>
                        <select name="sc_urp_carousel_number">
                            <option value="3" <?php echo ( 3 == get_option('sc_urp_carousel_number')) ? 'selected=selected' : ''; ?>>3</option>
                            <option value="4" <?php echo ( 4 == get_option('sc_urp_carousel_number')) ? 'selected=selected' : ''; ?>>4</option>
                            <option value="5" <?php echo ( 5 == get_option('sc_urp_carousel_number')) ? 'selected=selected' : ''; ?>>5</option>
                            <option value="6" <?php echo ( 6 == get_option('sc_urp_carousel_number')) ? 'selected=selected' : ''; ?>>6</option>
                        </select>
                    </td>
                </tr>
            </tbody>
            
            
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
                <td>Height</td>
                <td>
                    <input type="text" name="sc_urp_height" class="width15" value="<?php echo get_option('sc_urp_height', 400); ?>"/>px
                </td>
            </tr>
            
        </table>
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="2">Filtering Options</th>
                </tr>
            </thead>            
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
        </table>
        <table>
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