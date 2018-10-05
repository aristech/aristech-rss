<?php
/**
 * @package AristechBooking
 */

$large = '';
$medium = '';
$small = '';
switch ($this->radio) {
    case 'h1':
        $large = 'checked';
        break;
    case 'h2':
        $medium = 'checked';
        break;
    case 'h3':
        $small = 'checked';
        break;

    default:
        $large = 'checked';
        break;
}
?>
<div class="wrap">
    <h2> General Settings RSS </h2>
    <p>Shortcode to use <strong>[aristech_rss]</strong></p>
    <p>This plugin gets the title and image embeded in the post body of Wordpress sites. Some RSS providers doesn't have enabled the featured image in their rss feed</br>
    You can contact them and ask them (nicely) to include the code in their functions.php to get the image in the RSS.
    </p>
    <code>function featuredtoRSS($content) {</br>
        &nbsp; &nbsp;global $post;</br>
        &nbsp;&nbsp;if ( has_post_thumbnail( $post->ID ) ){</br>
            &nbsp;&nbsp;&nbsp;$content = '&#60;div&#62;' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '&#60;/div&#62;' . $content;</br>
            &nbsp;&nbsp;}</br>
            &nbsp;&nbsp;return $content;</br>
}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');</code>
    <form method="post" action="">
    <div class="half" style="width:50%;float:left;">
    <h2 style="text-align:center; "> RSS FEEDS </h2>
  <!-- Repeater Content -->
        <div class="repeater" style="margin-bottom: 60px;text-align:center;">
            <table class="wrapper" width="100%">
            <div data-repeater-list="group-rss">

      <?php

// var_dump($this->aristech_options);
    if(!empty($this->aristech_options)) {
        foreach ($this->aristech_options as $value) {
            echo '<div style="margin-bottom: 5px; text-align:center;" data-repeater-item>
            <input type="text" style="width:50%;" name="aristech_rss_url" value="'.$value.'"/>
            <input data-repeater-delete type="button" class="btn btn-danger" value="✗"/></div>';
        }

    }  else {
        echo '<div style="margin-bottom: 5px; text-align:center;" data-repeater-item>
        <input type="text" style="width:50%;" name="aristech_rss_url" value=""/>
        <input data-repeater-delete type="button" class="btn btn-danger" value="✗"/></div>';
    }

      ?>


    </div>
    <input data-repeater-create type="button" class="btn btn-primary" value="Add"/>
            </table>
        </div>


        </div>
    </div>
    <div class="half" style="width:50%; float:right">

    <table class="widefat">
        <tbody>
            <tr >

                    <h2 style="text-align:center;"> Select how many posts you want and title size</h2>

            </tr >
            <tr >
                <td >

                 <label>Max Posts</label>
                 <input  name="aristech_max_posts" type="number" value="<?php echo $this->max ?>" placeholder="more posts, longer to load" />
                 </td>
                <td >
                    <label for="large">H1</label>
                    <input type="radio" <?php echo $large ?> id="large" name="aristech_radio" value="h1">
                </td>
                <td >
                    <label for="medium">H2</label>
                    <input type="radio" <?php echo $medium ?> id="medium" name="aristech_radio" value="h2">
                </td>
                <td >
                    <label for="small">H3</label>
                    <input type="radio" <?php echo $small ?> id="small" name="aristech_radio" value="h3">
                </td>
            </tr>

        </tbody>
    </table>
    </br>
    </br>
    </br>
    </br>
    </div>
    <input type="submit" name="submit_scripts_update" class="button button-primary" value="Save"/>
    </form>
</div>
