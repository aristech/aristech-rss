<?php
/**
 * @package AristechRss
 */
/**
 * Plugin Name: Aristech Rss
 * Description : Custom Rss form
 * Author: Aristech
 * Version: 1.0.0
 *License:     GPL2
**/
if ( ! defined('ABSPATH') ) {
    die;
}



class AristechRss {

    public $plugin;


    function __construct() {

        $this->update();
        $this->plugin       = plugin_basename( __FILE__ );
        $this->template     = plugin_dir_path( __FILE__ ) . '/templates/';
        $this->aristech_options     = get_option("aristech_options", "");
        $this->title        = get_option( 'aristech_title', '' );
        $this->max        = get_option( 'aristech_max_posts', '5' );
        $this->radio        = get_option( 'aristech_radio', 'large' );



    }

    function register() {

        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdmin'));
        add_action( 'admin_menu',array($this, 'admin_menu_option'));
        add_filter( "plugin_action_links_$this->plugin", array($this, 'settings_link'));

        add_shortcode( 'aristech_rss', array($this ,'aristech_rss'));

    }

    public function settings_link($links){

        $settings_link = '<a href="admin.php?page=aristech_rss">Settings</a>';

        array_push($links, $settings_link);
        return $links;

    }

    function admin_menu_option()
    {
        wp_enqueue_media();
        add_menu_page('Aristech Rss', 'Aristech Rss', 'manage_options', 'aristech_rss', array($this,'admin_page'), 'dashicons-calendar-alt', 200);
    }

    function enqueueAdmin() {
        wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
        wp_enqueue_style('bootstrap');


        wp_register_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script('popper');

        wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script('bootstrap');

        wp_enqueue_script( 'repeater', plugin_dir_url( __FILE__ ) . 'js/repeater.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'adm_script', plugin_dir_url( __FILE__ ) . 'js/aristech_admin_script.js', array( 'jquery' ), false, true );
    }

    function update(){
        if(array_key_exists('submit_scripts_update', $_POST))
        {

            $list_url = array();

            foreach ($_POST['group-rss'] as $key => $value) {

                foreach ($value as $k) {

                    $list_url[] = $value['aristech_rss_url'];
                }
            }
            // echo json_encode($list_url);
            update_option('aristech_options', $list_url);
            update_option('aristech_radio', $_POST['aristech_radio']);
            update_option('aristech_max_posts', $_POST['aristech_max_posts']);

        }

    }

    function aristech_rss() {
        ob_start();
        require_once plugin_dir_path( __FILE__ ). 'templates/front.php';
            $data = ob_get_contents();
        ob_end_clean();
        return $data;
     }




    function admin_page()
    {
        require_once plugin_dir_path( __FILE__ ). 'templates/admin.php';
    }
}

if (class_exists('AristechRss')) {
    $aristechRss =new AristechRss();
    $aristechRss->register();
}

//activate
require_once plugin_dir_path( __FILE__ ). 'inc/aristech_rss_activate.php';
register_activation_hook( __FILE__, array('AristechRssActivate', 'activate') );

//deactivate
require_once plugin_dir_path( __FILE__ ). 'inc/aristech_rss_deactivate.php';
register_deactivation_hook( __FILE__, array('AristechRssDeactivate', 'deactivate') );




