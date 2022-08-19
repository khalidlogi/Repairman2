<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file defines a function that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:         Oop Ajax
 * Plugin URI:          http://
 * Description:         A simple example of using OOP principles to submit a form from the front end.
 * Version:             1.0.0
 * Author:              Digvijay Naruka
 * Author URI:          http://
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         oop-ajax
 * Domain Path:         /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class Oop_Ajax {

  // Put all your add_action, add_shortcode, add_filter functions in __construct()
  // For the callback name, use this: array($this,'<function name>')
  // <function name> is the name of the function within this class, so need not be globally unique
  // Some sample commonly used functions are included below
    public function __construct() {
   
        // Add Javascript and CSS for front-end display
        add_action('wp_enqueue_scripts', array($this,'enqueue'));

        // Add the shortcode for front-end form display
        add_action( 'init', array( $this, 'add_form_shortcode' ) );
        // Add ajax function that will receive the call back for logged in users
        add_action( 'wp_ajax_my_action', array( $this, 'my_action_callback') );
        // Add ajax function that will receive the call back for guest or not logged in users
        add_action( 'wp_ajax_nopriv_my_action', array( $this, 'my_action_callback') );
   
    }

    // This is an example of enqueuing a JavaScript file and a CSS file for use on the front end display
    public function enqueue() {
        // Actual enqueues, note the files are in the js and css folders
        // For scripts, make sure you are including the relevant dependencies (jquery in this case)
        wp_enqueue_script('my-ajax-script', plugins_url('js/oop-ajax.js', __FILE__), array('jquery'), '1.0', true);

        // Sometimes you want to have access to data on the front end in your Javascript file
        // Getting that requires this call. Always go ahead and include ajaxurl. Any other variables,
        // add to the array.
        // Then in the Javascript file, you can refer to it like this: my_php_variables.ajaxurl
        wp_localize_script( 'my-ajax-script', 'my_php_variables', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce')
        ));

    }

    /**
     * Registers the shortcode for the form.
     */
    public function add_form_shortcode() {

        add_shortcode( "oop-ajax-add-form", array( $this, "add_form_front_end" ) );

    }

    /**
     * Processes shortcode oop-ajax-add-form
     *
     * @param   array    $atts        The attributes from the shortcode
     *
     * @return    mixed    $output        Output of the buffer
     */
    function add_form_front_end($atts, $content) {

        echo "<form id='my_form'>";

            echo "<label for='name'>Name: </label>";
            echo "<input id='name' type='text' name='name' ";

            echo "<br>" ;

            echo "<label id='email' for='email'>Email: </label>" ;
            echo "<input type='text' name='email'>";

            echo "<br>" ;

            echo "<input type='hidden' name='action' value='my_action' >" ;
            echo "<input id='submit_btn' type='submit' name='submit' value='submit'> ";

        echo "</form><br><br>";
        echo "<div id='response'>ajax responce will be here</div> ";
    }
    
     /**
     * Callback function for the my_action used in the form.
     *
     * Processses the data recieved from the form, and you can do whatever you want with it.
     *
     * @return    echo   response string about the completion of the ajax call.
     */
    function my_action_callback() {
        // echo wp_die('<pre>' . print_r($_REQUEST) . "<pre>");

        check_ajax_referer( '_wpnonce', 'security');

        if( ! empty( $_POST )){

            if ( isset( $_POST['name'] ) ) {

                $name = sanitize_text_field( $_POST['name'] ) ;
            }

            if( isset( $_POST['email'] ) ) {

                $email = sanitize_text_field( $_POST['email'] ) ;
            }

            ///////////////////////////////////////////
            // do stuff with values
            // example : validate and save in database
            //          process and output
            /////////////////////////////////////////// 

            $response = "Wow <strong style= 'color:red'>". $name . "!</style></strong> you rock, you just made ajax work with oop.";
            //this will send data back to the js function:
            echo $response;

        } else {

            echo "Uh oh! It seems I didn't eat today";
        }

        wp_die(); // required to terminate the call so, otherwise wordpress initiates the termination and outputs weird '0' at the end.

    }

}
//initialize our plugin
global $plugin;

// Create an instance of our class to kick off the whole thing
$plugin = new Oop_Ajax();