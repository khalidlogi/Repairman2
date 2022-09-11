<?php

class MYFORM
{

    public function __construct()
    {

        add_action('init', array($this, 'add_form_shortcode'));
        add_shortcode('myform', array($this, 'myformf'));
        //Include Javascript library
        //wp_enqueue_script('uploaddata', "{$this->plugin_url}demo.js" , array( 'jquery' ));
        // wp_enqueue_script('jquery');
        //add_action('admin_menu', array($this,'hello_world_two_pages'));

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

// Add ajax function that will receive the call back for logged in users
        add_action('wp_ajax_my_action', array($this, 'my_action_callback'));
        // Add ajax function that will receive the call back for guest or not logged in users
        add_action('wp_ajax_nopriv_my_action', array($this, 'my_action_callback'));

    }

    /**
     * Registers the shortcode for the form.
     */
    public function add_form_shortcode()
    {

        add_shortcode("myform", array($this, "myformf"));

    }

    public function enqueue()
    {
        wp_enqueue_script('my-ajax-script', plugins_url('../asset/js/myjs.js', __FILE__), array('jquery'), '1.0', true);
        wp_enqueue_style('my-style', plugins_url('../asset/css/style.css', __FILE__));

        wp_enqueue_script('my-ajax-script', plugins_url('../asset/js/jquery.validate.min.js', __FILE__), array('jquery'), '1.0', true);

        wp_localize_script('my-ajax-script', 'my_php_variables', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce'),
        ));

    }

    public function myformf($atts, $content)
    {

        return include 'htmlform.php';

    }

    /**
     * Callback function for the my_action used in the form.
     *
     * Processses the data recieved from the form, and you can do whatever you want with it.
     *
     * @return    echo   response string about the completion of the ajax call.
     */
    public function my_action_callback()
    {
        global $wpdb;

        // echo wp_die('<pre>' . print_r($_REQUEST) . "<pre>");
        print_r($_POST);

        // exit;
        check_ajax_referer('_wpnonce', 'security');

        if (!empty($_POST)) {
            //print_r($_POST);
            echo '<br>';
            if (isset($_POST['name'])) {

                $name = sanitize_text_field($_POST['name']);

            }
            if (isset($_POST['tel'])) {

                $tel = sanitize_text_field($_POST['tel']);

            }
            if (isset($_POST['city'])) {

                $city = sanitize_text_field($_POST['city']);

            }

            if (isset($_POST['email'])) {

                $email = sanitize_text_field($_POST['email']);

            }

            include plugin_dir_path(__FILE__) . 'db.php';
            insert($name, $city, $email, $tel);
            //$db();

            //$db->insert();

        }

        //Restore this
        /*
        if($wpdb->insert('repairman', array(
        'name' => $name,
        'email' => $email,
        'city' => $city,
        'phone' => $tel))===FALSE){
        echo "Error";
        }
        else{
        $headers = 'From: xyz <xyz@xyz.com>';
        $subject = "Thank you";
        $body = "<p>Thank you</p><p>.........</p>";
        wp_mail( $email, $subject, $body, $headers);

        }
        echo  "last query: ".$wpdb->last_query ;
        echo"<br>";
        echo $wpdb->last_error;

        //$wpdb->insert( repairman', array( 'name'=>$name, 'email'=>$email , 'city' => $city, 'tel' => $tel), array( '%s', '%s','%s', '%s' );
        $wpdb->print_error();

        //}

         */

        $response = "Wow <strong style= 'color:red'>" . $name . "!</style></strong> " . $tel . " you rock," . $city . "you just made ajax work with oop.";
        //this will send data back to the js function:
        echo $response;

        /* } else {

        echo "Uh oh! It seems I didn't eat today";
        }*/

        wp_die(); // required to terminate the call so, otherwise wordpress initiates the termination and outputs weird '0' at the end.

    }

    /* public function insertAction(){
global $wpdb;
if(isset($_POST['name'])){
$wpdb->insert('repairman', array('name' => $_POST['name']));
}

}*/

}