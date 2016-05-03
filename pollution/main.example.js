// The path to our api handler file
// @todo You should use multiple request handler files
var API_TARGET = "http://localhost/pollution/pollution/api.php";

// When the window finishes loading, execute the init function.
// It's not a problem that init is defined later in this file (@see JS hoisting)
$(window).ready(main);

// Out client program
function main() {

   // When the form with id show_station is submited, the submitHandler function
   // is called.
   $('#show_station').submit(submitHandler);

}

// Will handle the submition of the show_station form
function submitHandler(event) {

   // Prevent window from reloading
   event.preventDefault();
   event.stopPropagation();

   // Format the data to send
   var data = $('#show_station').serialize();

   // Send a get request and save the request object
   var request = $.get(API_TARGET + '?' + data);

   // When we successfully receive a response, execute the function
   // responseHandler
   request.success(responseHandler);

}

function responseHandler(response) {

   console.log(response);

}
