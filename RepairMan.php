<?php 

/*
Plugin Name: RepairMan

Plugin URI: https://kh-test.com/

Description: Plugin to accompany tutsplus guide to creating plugins, registers a post type.

Version: 1.0

Author: Rachel McCollin

Author URI: https://kh.com/

License: GPLv2 or later

Text Domain: tutsplus

*/

if(!defined('ABSPATH')){
exit;
}

if(!class_exists('MYCLASS')){

    
    class MYCLASS{

    private $mypath;
    private $myurl;
    private $version;


        function __construct(){
            $this->defineconstant();
            add_action( 'wp_enqueue_scripts', array($this,'myscript') );

            register_activation_hook(__FILE__, array($this,'activate') );
            require_once($this->mypath.'includes/form.php');
            require_once($this->mypath.'includes/MYFORM2.php');
            require_once($this->mypath.'includes/Alldb.php');


        }

        function myscript(){
            wp_enqueue_style('bootstrap',plugin_dir_url(__FILE__).'asset/css/bootstrap.min.css');
        }

        function defineconstant(){
            $mypath = plugin_dir_path(__FILE__);
            $myurl = plugin_dir_url(__FILE__);
            $version = "1.0";
        }

        public function activate(){
            global $wpdb;
            $table = $wpdp->prefix . 'repairman';
            $charset = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                name tinytext NULL,
                city varchar(255) DEFAULT '' NOT NULL,
                email varchar(255) DEFAULT '' NOT NULL,
                phone varchar(255) DEFAULT '' NOT NULL,
                UNIQUE KEY id (id)
              ) $charset;";
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option( 'plugin_name_db_version', '1.0' );
 

        }
    }

}

if(class_exists('MYCLASS')){
    register_uninstall_hook( __FILE__, 'MYCLASS::uninstall' );
    $myclass = new MYCLASS();
    $myclassform = new MYFORM();
    $myclassform2 = new MYFORM2();
    $mydb = new Alldb();
}




