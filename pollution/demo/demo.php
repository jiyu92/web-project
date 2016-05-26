<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://localhost/web-project/pollution/api.php?action=show_station");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = 'X-Api-Key: 098f6bcd4621d373cade4e832627b4f6';//to api key enos user pou exei kanei register sto systhma

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

?>

<html>

<head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Example of heatmap</title>
    <style>
      html, body {
        height: 70%;
        margin: 10;
        padding: 10;
      }
      #map {
        height: 100%;
      }
    </style>




	<img id="msgIcon" src="main.jpg" style="width:40%;height:30%;"/>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var stats_data = <?=$server_output?>;//oi stathmoi apo ton "server"(kwdikas php parapanw) tou dev sthn metablhth stats_data
      function initMap() {//initialise to map sthn ellada
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 37.58, lng: 23.43},
          zoom: 6
        });


        var heatmapData = [];
    stats_data.forEach(function(o){//gia kathe station sth bash...
      heatmapData.push(new google.maps.LatLng(+o.location.split(',')[0],+o.location.split(',')[1]));//...pernoume to string ths topothesias xwrizontas to kata ta protypa tou google maps
         var marker = new google.maps.Marker({//marker gia kathe stahmo
           position: {lat:+o.location.split(',')[0],lng:+o.location.split(',')[1]},
           map: map,
           title: ''
          });
         marker.addListener('click', function() {//marker onclick synarthsh
           m=this;
           $('[name="station_id"]').val(o.id);

           if(!$('[name="date"]').val())//
            $('[name="action"]').val('show_stats');
          else
            $('[name="action"]').val('show_pollution');

           $.post('http://localhost/web-project/pollution/demo/demoapi.php', {
             xget: 'http://localhost/web-project/pollution/api.php?' + $('form').serialize()//serialize ta dedomena
           })
           .success(function(response){//response handler synarthsh on success
             var infowindow = new google.maps.InfoWindow({//gemiszoume to infowindow me raw dedomena analoga me tis apaithseis tou xrhsth
                content: o.name+JSON.stringify(response)
              });
            infowindow.open(map, m);
           });
        });

    });

    var heatmap = new google.maps.visualization.HeatmapLayer({
      data: heatmapData
    });
    heatmap.setMap(map);
    }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB37xCEC-dH_S6TyjoDkYvFMVAq59rxNO0&callback=initMap&libraries=visualization">
    </script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>In - MySQL</title>
<link rel="shortcut icon" href="pol.jpg">
<link href="style.css" rel="stylesheet" type="text/css">
<script src="jquery.js"></script>
</head>

<body>


<title>station</title>

<form method="GET" action="http://localhost/web-project/pollution/api.php">

	<h2>Επιλογή προς εμφάνιση δεδομένων σταθμού</h2>
     <link href="style.css" rel="stylesheet" type="text/css">
	<p>Type of dirt: <input type="text" name="type_of_dirt" size="10">
	<p>hour: <input type="text" name="hour" size="10">
	<p>Date: <input type="text" name="date" size="20">
	<p>Month: <input type="text" name="month" size="20">
	<p>Year: <input type="text" name="year" size="20">
	<p><input type="submit" value="Εμφάνιση πληροφοριών!" name="B1"></p>
	<input type="hidden" name="action" value="">
	<input type="hidden" name="station_id" value="">
</form>

</body>

</html>
<?php curl_close ($ch);?>
