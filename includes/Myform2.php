<?php


class MYFORM2{

   
    function __construct(){
        
        add_action( 'init', array( $this, 'add_form_shortcode2' ) );
        //add_shortcode( 'myform', array($this, 'myformf') );
        //Include Javascript library
        //wp_enqueue_script('uploaddata', "{$this->plugin_url}demo.js" , array( 'jquery' ));
       // wp_enqueue_script('jquery');
       //add_action('admin_menu', array($this,'hello_world_two_pages'));
      
       add_action('wp_enqueue_scripts', array($this,'enqueue'));

// Add ajax function that will receive the call back for logged in users
       add_action( 'wp_ajax_my_action2', array( $this, 'my_action_callback2') );
        // Add ajax function that will receive the call back for guest or not logged in users
        add_action( 'wp_ajax_nopriv_my_action2', array( $this, 'my_action_callback2') );


       
       


    }

    
    /**
     * Registers the shortcode for the form.
     */
    public function add_form_shortcode2() {

        add_shortcode( "myform2", array( $this, "myformf2" ) );

    }

    /**
     * Undocumented function
     *
     * @return void
     */    
    function enqueue(){
             wp_enqueue_script('my-ajax-script2', plugins_url('../asset/js/myjs2.js', __FILE__), array('jquery'), '1.0', true);
             wp_enqueue_style ('my-style', plugins_url('../asset/css/style.css', __FILE__));

             wp_enqueue_script('my-ajax-script2', plugins_url('../asset/js/jquery.validate.min.js', __FILE__), array('jquery'), '1.0', true);


             wp_localize_script( 'my-ajax-script2', 'my_php_variables', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('_wpnonce')
            ));

        }  
    
        function myformf2($atts, $content){
       
            return include('htmlform2.php');
       
    
       
    

    
    }

   /**
     * Callback function for the my_action used in the form.
     *
     * Processses the data recieved from the form, and you can do whatever you want with it.
     *
     * @return    echo   response string about the completion of the ajax call.
     */
    function my_action_callback2() {
       // echo wp_die('<pre>' . print_r($_REQUEST) . "<pre>");
         //print_r($_POST) ;

       // exit;
        check_ajax_referer( '_wpnonce', 'security');
        print_r($_REQUEST);
        echo "dddd";
        if ($errors) {
            echo json_encode(array('status' => 'error', 'message' => 'Your email message has objectionable content'));
            wp_die();
          }
        global $wpdb;
        if( ! empty( $_POST )){
            $city = $_POST['city'];
            
        //<div id="content">Database Results Here Via Loop</div>
        $result = $wpdb->get_results ( "SELECT * FROM repairman WHERE city = '$city'" );
       
        echo "<div class='table-responsive'><table style='border: 1px solid black' class='table'><tr>
        <th>Firstname</th>
        <th>Email</th>";
        if (current_user_can( 'manage_options' ) ){
            echo "<th>Action</th>";
        }
       echo "</tr>";
        
        if(empty($result)){
            echo "Desole! Pas encore de enregestrent pour cette ville <br>";
        }    foreach ( $result as $print )   {
            echo "<tr>";
            echo "<td> $print->name </td>";
            
            
            echo "<td> $print->email </td>";
            if (current_user_can( 'manage_options' ) ){
                echo "<td><a class='delete' href='#'> Delete </a></td>";
            }
            echo "</tr>";
        }}   echo "</table></div>";
        
        
                echo $response;             
          

            


    }

    /* public function insertAction(){
        global $wpdb;
        if(isset($_POST['name'])){
            $wpdb->insert('repairman', array('name' => $_POST['name']));
        }
      

    }*/
    
   

}



