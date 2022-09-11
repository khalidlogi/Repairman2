(function ($) {
  "use strict";

  $("#my_form").submit(function (e) {
    //e.preventDefault();
    // set the data
    var data = {
      action: "my_action",
      security: my_php_variables.nonce,
      city: $("#city").val(),
      name: $("#name").val(),

      tel: $("#tel").val(),
      email: $("#email").val(),
    };

    var name = $("#name").val();
    var email = $("#email").val();
    var city = $("#city").val();
    var tel = $("#tel").val();

    //This condition will only be true if each value is not an empty string
    if (name && email && city && tel) {
      $.ajax({
        type: "post",
        url: my_php_variables.ajaxurl,
        data: data,
        beforeSend: function () {
          $("#res").text("Loading...");
        },

        success: function (response) {
          //output the response on success
          $("#res").text("...");
          $("#response").html(response);
          $(".form-group").css({ opacity: "0.5" });
          //$("div.container").hide(function () {
          //  $("div.success").fadeIn();
          //});
        },
        error: function (err) {
          console.log(err);
        },
      });
    } //end empty check

    return false;
  });
})(jQuery);
