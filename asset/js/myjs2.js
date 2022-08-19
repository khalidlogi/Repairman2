jQuery(document).ready(function($) {

    
    jQuery(document).on('click', '.delete', function () {
        alert('Delete');
        var id = this.id;
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {"action": "your_delete_action", "element_id": id},
            success: function (data) {
                //run stuff on success here.  You can use `data` var in the 
               //return so you could post a message.  
            }
        });
    });    

    $("#submit_btn2").on('click', function(e) {
            //e.preventDefault();
            // set the data
            var data = {
                 action: 'my_action2',
                 security: my_php_variables.nonce,
                 city: $("#city").val(),
                
            }
        var city     = $('#city').val();
      
    
        //This condition will only be true if each value is not an empty string
        if(city){
    
            console.log(data);

            $.ajax({
                type: 'post',
                url: my_php_variables.ajaxurl,
                data: data,
                beforeSend: function(){
                    $("#res").text("En cour de recherche");
                },
                
                success: function(response) {
                    //output the response on success
                    $("#res").html(response);
    
                },
                error: function(err) {
                    console.log(err);
                    $( "#res").append(
                        "<div id='alert' class='alert alert-danger alert-dismissible fixed-top' role='alert' >" +
                          "<p class='text-center'>Error</p>" +
                          "<button type = 'button' class='close' data-dismiss = 'alert'>&times;</button>" +
                          "</div>"
                      );
                }
            });
    
        } //end empty check
        
            return false;
        });
  


});

