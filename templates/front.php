
<?php // Get RSS Feed(s)
include_once( ABSPATH . WPINC . '/feed.php' );
$links = $this->aristech_options;
// Get a SimplePie feed object from the specified feed source.


include('html_dom.php');

if (!function_exists('get_first_image'))   {

    function get_first_image($html){

        $post_html = str_get_html($html);

        $first_img = $post_html->find('img', 0);

        if($first_img !== null) {
            return $first_img->src;
        }

        return null;
        };
  }
$maxitems = $this->max;
foreach ($links as $value) {
    # code...

    $rss = fetch_feed( $value);


    if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly


        $max = $rss->get_item_quantity( $maxitems );


        $rss_items = $rss->get_items( 0, $max );

    endif;


    ?>

    <ul>
        <?php if ( $max == 0 ) : ?>
            <li><?php _e( 'No items', 'aristech_rss' ); ?></li>
        <?php else : ?>
            <?php // Loop through each feed item and display each item as a hyperlink. ?>
            <?php foreach ( $rss_items as $item ) : ?>

                <li style="list-style: none;margin-bottom: 40px">
                    <a style="" href="<?php echo esc_url( $item->get_permalink() ); ?>"
                        title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                        <?php echo '<'.$this->radio.'>'.esc_html( $item->get_title() ).'</'.$this->radio.'>'; ?>
                        <?php
                        $texthtml = $item->get_content();

                        echo '<img style="padding-top: 10px" src="'.get_first_image($texthtml).'">';?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

<?php } ?>