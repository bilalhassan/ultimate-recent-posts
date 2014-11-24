<?php
  include_once 'option.php';


?>
<form action="" method="post" id="wptb">
    <div class="left width70">
        <ol>
            <li>Change the plugin settings below to your liking</li>
            <li>Add the shortcode <b>[urp_posts]</b> to the page/post/widget where you want the plugin to show</li>
        </ol>
        <p>
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="3">Appearance & Design</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                </tr>
                <tr id="">
                    <td>Number of Posts (slides)</td>
                    <td>
                        <select name="sc_urp_num_posts">
                            <option value="3" <?php echo ( 3 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>3</option>
                            <option value="4" <?php echo ( 4 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>4</option>
                            <option value="5" <?php echo ( 5 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>5</option>
                            <option value="6" <?php echo ( 6 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>6</option>
                            <option value="10" <?php echo ( 10 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>10</option>
                            <option value="15" <?php echo ( 15 == get_option('sc_urp_num_posts')) ? 'selected=selected' : ''; ?>>15</option>
                        </select>
                    </td>
                    <td>
                        <em>How many slides do you want in total ? Note: for carousel template, its most effective when the total slides is a multiple of the slides per set</em>
                    </td>
                </tr>
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
                    <td>
                        <em>How long for the next slide or slideset to load</em>
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
                    <td>
                        <em>How many posts per each carousel set</em>
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
                <td>
                    <em>Do you want a slider, or a carousel ?</em>
                </td>                
            </tr>
            <tr>
                <td>Height</td>
                <td>
                    <input type="text" name="sc_urp_height" class="" value="<?php echo esc_html( get_option('sc_urp_height', 400) ); ?>"/>px
                </td>
                <td>
                    <em>Set the height of the slider or carousel in pixels. Keep changing this till it looks the way you want it to</em>
                </td>                
            </tr>
            <tr>
                <td>Title Color</td>
                <td>
                    <input type="text" class="wp_popup_color" id="bg_colorbox" name="sc_urp_text_color" value="<?php echo get_option('sc_urp_text_color'); ?>"/>
                </td>
                <td>
                    <em>Click to select the text color, or enter a hex color value</em>
                </td>
            </tr> 
        </table>
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="3">Filtering Options</th>
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
                <td>
                    <em>If you want to display posts from a specific category, select here. Otherwise leave it as All. Tip: This can be very handy if you want to show specific posts, not just the most recent</em>
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
                <td>
                    <em>If you want to display posts with specific tag, select here. Otherwise leave it as All. Tip: This can be very handy if you want to show specific posts, not just the most recent</em>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="3">
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