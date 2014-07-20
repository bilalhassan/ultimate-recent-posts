<?php
 // include_once 'option.php';


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
                            value="carrousel" <?php if ("carrousel" == get_option('sc_urp_template')) echo 'selected="selected"'; ?>>
                            Carrousel
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="sc_urp_submit" value="save" class="button-primary"/>
<!--                    <span id="loading" style="display: none;"><img src="images/loading.gif" alt=""> saving...</span><br/><br/>-->
                </td>
            </tr>
        </table>
    </div>
</form>
