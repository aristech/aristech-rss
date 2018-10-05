<?php
/**
 *
 * @package AristechBooking
 */


if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$array = array( 'aristech_options','aristech_title','aristech_max_posts','aristech_radio','aristech_tel','aristech_radio');

foreach ($array as $item) {
    $item = esc_sql( $item );
    $wpdb->query( "DELETE FROM wp_options WHERE option_name = '$item'" );
}


