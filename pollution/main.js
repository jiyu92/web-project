/*var API_TARGET_STATS = "http://localhost/pollution/pollution/api.php";
var API_TARGET_INSERT = "http://localhost/pollution/pollution/insert_utf.php"
var API_TARGET_DELETE = "http://localhost/pollution/pollution/delete_utf.php"
var API_TARGET_UPDATE = "http://localhost/pollution/pollution/update.php"*/

var targetMap = {
  show_stats: "http://localhost/web-project/pollution/api.php",
  show_pollution: "http://localhost/web-project/pollution/api.php",
  show_station: "http://localhost/web-project/pollution/api.php",
  delete_station: "http://localhost/web-project/pollution/delete_utf.php",
  insert_station: "http://localhost/web-project/pollution/insert_utf.php",
  update: "http://localhost/web-project/pollution/update.php",
  registration: "http://localhost/web-project/pollution/registration.php",
  login: "http://localhost/web-project/pollution/login_user.php",
  create_db: "http://localhost/web-project/pollution/create_db.php",
  drop_db: "http://localhost/web-project/pollution/drop_db.php"
};

// When the window finishes loading, execute the main function.
// It's not a problem that main is defined later in this file (@see JS hoisting)
$(window).ready(main);

// Out client program
function main() {

   // When the form with id show_station is submited, the submitHandler function
   // is called.
   $('form:not([method="post"])').submit(submitHandler);

}

// Will handle the submition of the form
function submitHandler(event) {

   // Prevent window from reloading
   event.preventDefault();
   event.stopPropagation();

   // Format the data to send
   var data = $(this).serialize();
   var action = $(this).find('[name="action"]').val();
   var form = $(this);

   // Send a get request and save the request object
   var request = $.get(targetMap[action] + '?' + data);

   // When we successfully receive a response, execute the function
   // responseHandler
   request.success(responseHandler);

   function responseHandler(response) {

      console.log(response);
      alert(response);
     //form.find('p:has([type="submit"])').prepend("<div class='result-box'>"+JSON.stringify(response)+"</div>");
     try{
       response = JSON.parse(response);
       if(response.is_admin){
         window.location.href='http://localhost/web-project/pollution/insert_utf.html';
       }
       else{
         $("#main").fadeTo(1000,0.1);
         $("#user_logged").prepend("<div>"+JSON.stringify(response.api_key)+"</div>").show();;
       }
     }catch(e){}

   }

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
