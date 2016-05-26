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
var stats_url = "http://localhost/web-project/pollution/stats.php";

// When the window finishes loading, execute the main and the load_stats func
$(window).ready(main);
$(window).ready(load_stats);
//asygxronh enhmerwsh twn statistikwn gia ton admin
function load_stats(){
  $("#stats").load(stats_url);
  setInterval(function()
        {
            $("#stats").load(stats_url);
        }, 100);

}

function main() {


   $('form:not([method="post"])').submit(submitHandler);

}

// O sumbmition handler
function submitHandler(event) {

   // Oi formes kanoun reload, den to theloume auto ara preventDefault & stopPropagation
   event.preventDefault();
   event.stopPropagation();

   // Format the data to send
   var data = $(this).serialize();
   var action = $(this).find('[name="action"]').val();
   var form = $(this);

   // Send a get request and save the request object
   var request = $.get(targetMap[action] + '?' + data);

   //  o responseHandler
   request.success(responseHandler);

   function responseHandler(response) {

      console.log(response);
      alert(response);
     //form.find('p:has([type="submit"])').prepend("<div class='result-box'>"+JSON.stringify(response)+"</div>");
     try{
       response = JSON.parse(response);
       if(response.is_admin){
         window.location.href='http://localhost/web-project/pollution/insert_utf.html';//redirect sto html gia eisagwgh dedomenwn sth bash an eisai admin
       }
       else{
         $("#main").fadeTo(1000,0.1);
         $("#user_logged").prepend("<div>"+JSON.stringify(response.api_key)+"</div>").show();;
       }
     }catch(e){}

   }

}
