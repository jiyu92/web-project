// The path to our api handler file
// @todo You should use multiple request handler files
$(window).ready(main);

// Out client program
function main() {

   // When the form with id show_station is submited, the submitHandler function
   // is called.

}

function submitHandler(event) {

   // Prevent window from reloading
   event.preventDefault();
   event.stopPropagation();

   // Format the data to send
   var data = $(this).serialize();

   // Send a get request and save the request object

   // When we successfully receive a response, execute the function
   // responseHandler
   request.success(responseHandler);

}

function responseHandler(response) {

   console.log(response);
   alert(response);

}

/*
setInterval(refresher, 2e3);

function refresher(){

   var request = $.get(API_TARGET + '?action=refresh_count');

   request.success(function(response){
      var counterElement = $('#count');
      counterElement.html(response);
   });

}
*/
