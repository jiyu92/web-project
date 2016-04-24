<?php
include('session.php');
//include('insertUrltoDB.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>Pollution Calculator | Admin Panel</title>
<link rel="shortcut icon" href="pol.jpg"> 
<link href="style.css" rel="stylesheet" type="text/css">

<script>
function checkUser(user_id){alert(user_id);}
function getUrl(user_id){
	var par = document.getElementById("url").value;
	urlActions(par, user_id);
	//alert(user_id);
	document.getElementById("url").value = "";
	document.getElementById("url").placeholder = "Url";
	
}


function urlActions(url, user_id)
{
	
	//document.getElementById("myDiv").innerHTML=url;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==1){
			  document.getElementById("msgIcon").src = "Avatar/hourglass.png";
			  document.getElementById("myDiv").innerHTML = "Url Proccessing...Please Wait...";
		  }
		  if (xmlhttp.readyState==4 && xmlhttp.status==404){
			  document.getElementById("msgIcon").src = "Avatar/info.png";
			  document.getElementById("myDiv").innerHTML = "Page url doesn't exists";
		  }
		 //document.getElementById("myDiv").innerHTML=xmlhttp.status;
		 if (xmlhttp.readyState==4 && xmlhttp.status==200)
		 {
			
			var xmlhttp2;
			xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange=function()
			{
				if (xmlhttp2.readyState==4 && xmlhttp2.status==404) 
				{
					document.getElementById("msgIcon").src = "Avatar/info.png";
					document.getElementById("myDiv").innerHTML = "Page doesn't added to DB...Check for duplicate entry...";
					
				}
				if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
				{
					////document.getElementById("myDiv").innerHTML = "Page "+url+" added successfully!!";
					//alert(xmlhttp2.responseText);
					if (xmlhttp2.responseText.search("Fatal error")!=-1){
						document.getElementById("msgIcon").src = "Avatar/info.png";
						document.getElementById("myDiv").innerHTML = "Url doesn't match with Facebook Page...";
					}
					else{
						var insertUrlRes = xmlhttp2.responseText;
						//alert(insertUrlRes);
						//document.getElementById("myDiv").innerHTML = insertUrlRes;
						var res = insertUrlRes.split("|", 2);
						document.getElementById("msgIcon").src = "Avatar/ok.png";
						document.getElementById("myDiv").innerHTML = "Page "+res[1]+" added successfully!!";
						page_id = res[0];
						url = res[1];
						//alert("page id " +res[0]);
						var xmlhttp3;
						xmlhttp3 = new XMLHttpRequest();
						xmlhttp3.onreadystatechange=function(){
							if (xmlhttp3.readyState==4 && xmlhttp3.status==404) 
							{	
								document.getElementById("msgIcon").src = "Avatar/info.png";
								document.getElementById("myDiv").innerHTML = "Events doesn't added to DB!!";
							}
							if (xmlhttp3.readyState==4 && xmlhttp3.status==200){
								document.getElementById("msgIcon").src = "Avatar/ok.png";
								document.getElementById("myDiv").innerHTML = "Events of "+res[1]+" added successfully!!";
								document.getElementById("pages").style.visibility = "hidden";
								var xmlhttp4;
								xmlhttp4= new XMLHttpRequest();
								xmlhttp4.onreadystatechange=function(){
									if (xmlhttp4.readyState==4 && xmlhttp4.status==404) 
									{	
										document.getElementById("msgIcon").src = "Avatar/info.png";
										document.getElementById("myDiv").innerHTML = "Show Pages Problem!!";
									}
									if (xmlhttp4.readyState==4 && xmlhttp4.status==200){
										document.getElementById("pages").innerHTML = xmlhttp4.responseText;
										document.getElementById("pages").style.visibility = "visible";
									}
								}
								xmlhttp4.open("GET","showPages.php",true);
								xmlhttp4.send();
							}
						}
						xmlhttp3.open("GET","insertEventstoDB.php?page_id="+page_id,true);
						xmlhttp3.send();
						//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					}
				}
			}
			
			xmlhttp2.open("GET","insertUrltoDB.php?url="+url+"&user_id="+user_id,true);
			//xmlhttp2.open("GET","profi",true);
			xmlhttp2.send();
		 }
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

function updateDB(){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==1)
		{
			document.getElementById("msgIcon").src = "Avatar/hourglass.png";
			document.getElementById("myDiv").innerHTML = "Updating DB...Please Wait...";
		}
		if (xmlhttp.readyState==4 && xmlhttp.status==404){
			document.getElementById("msgIcon").src = "Avatar/info.png";
			document.getElementById("myDiv").innerHTML = "Social Events DB error...";
		}
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("msgIcon").src = "Avatar/ok.png";
			document.getElementById("myDiv").innerHTML = "Social Events DB updated successfully!!";
		}
	}
	xmlhttp.open("GET","updateDB.php",true);
	xmlhttp.send();
}

function removeUrl(par){
	
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==404){
			document.getElementById("msgIcon").src = "Avatar/info.png";
			document.getElementById("myDiv").innerHTML = "Page delete error...";
		}
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("msgIcon").src = "Avatar/ok.png";
			document.getElementById("myDiv").innerHTML = "Page removed successfully!!";
			document.getElementById("pages").style.visibility = "hidden";
			var xmlhttp2;
			xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange=function(){
			if (xmlhttp2.readyState==4 && xmlhttp2.status==404){
				document.getElementById("msgIcon").src = "Avatar/info.png";
				document.getElementById("myDiv").innerHTML = "Show Pages error (from remove)...";
			}
				if (xmlhttp2.readyState==4 && xmlhttp2.status==200){
					document.getElementById("pages").innerHTML = xmlhttp2.responseText;
					document.getElementById("pages").style.visibility = "visible";
				}
			}
			xmlhttp2.open("GET","showPages.php",true);
			xmlhttp2.send();
		}
	}
	xmlhttp.open("GET","removeUrl.php?page_id="+par,true);
	xmlhttp.send();
}

</script>
<meta name="viewport" content="width=device-width"/>	
</head>
<body>

<div id="profile">
<b id="welcome">Καλώς Ήρθατε: <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>

<div class="container">
<div id="pages">
<h2>Σελίδες στο Σύστημα</h2><BR>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "socialeventsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	header ("HTTP/1.1 404 Not Found");
	ob_end_clean();
	echo http_response_code();
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}
mysqli_set_charset($conn, "utf8");
$sql ="SELECT * FROM page JOIN edit ON FacebookId=page_id";
$result_sql = $conn->query($sql);
$counter = 0;
if ($result_sql->num_rows > 0) {
	
	//$sql2 ="SELECT * FROM edit";
	//$result_sql2 = $conn->query($sql2);	
	
    // output data of each row
    while($row = $result_sql->fetch_assoc()) {
		//while($row2 = $result_sql2->fetch_assoc()){
			$temp = $row["user_id"];
			//echo $temp;
			$sql3 ="SELECT username FROM user WHERE id=$temp";
			$result_sql3 = $conn->query($sql3);	
			while($row3 = $result_sql3->fetch_assoc()){
				//print_r($row3);
				$edit_user = $row3["username"];
			}
		//}
		
		echo "<div id=\"".$counter."\">";
		//echo "<img id=\"noAvatar\" src=\"Avatar\/noAvatar.png\"  style=\"width:25%;height:5%;\">";
		echo "<img class=\"avatar\" src=\"http://graph.facebook.com/".$row["FacebookId"]."/picture?type=large\">";
        echo "<h4 class=\"rowH4\"><span style=\"color:blue\">Σελίδα:</span> " . $row["url"]."<BR> <span style=\"color:blue\">Κατηγορία: </span>" . $row["category"]. 
			"<BR><span style=\"color:blue\">Edit by: </span>". $edit_user."</h4>";
		echo "<input type=\"image\" class=\"minus\" id=\"".$row["FacebookId"]."\"src=\"Avatar\/minus.png\" onclick=\"removeUrl(this.id)\">";
		echo "</div><BR>";
    }
	$counter++;
} else {
	echo "<div> ";
	echo "<img id=\"noAvatar\" src=\"Avatar\/noPages.png\"  style=\"width:25%;height:5%;\">";
    echo "<h4 class=\"rowH4\">Δεν υπάρχουν Pages στη Βάση</h4>";
	echo "</div>";
    //echo "0 results";
}

$sql ="SELECT id FROM user WHERE username='$login_session'";
$result_sql = $conn->query($sql);
if ($result_sql->num_rows > 0){
	while($row = $result_sql->fetch_assoc()){
		$user_id = $row["id"];
		//echo $user_id;
	}
}

$conn->close();

/****************************************************
					FUNCTIONS
		*******************************************************/

		
	/*function getPage($pageUrl){
		$facebookSession = FacebookSession::setDefaultApplication('112397872436646', '9bcd633676f895f62331bd87706a7c34');

		$url = $pageUrl;
		$url = explode("/", $url);
		$myUrl = explode("?", $url[3]);
		$myUrl = $myUrl[0];

		$session = FacebookSession::newAppSession();
		$accessToken = $session->getAccessToken();
		$session = new FacebookSession($accessToken);
		$myRequest = "/".$myUrl."?fields=category_list";
		//echo $myRequest;
		$request = new FacebookRequest($session, 'GET', $myRequest);
		$response = $request->execute();
		$graphObject = $response->getGraphObject()->asArray();
		//print_r($graphObject);
		foreach($graphObject['category_list'] as $mydata)
		{
			$category = $mydata->name;
			echo $category;
			//echo "mydata ".$mydata->name;
		}	
	}*/
?>
</div>

<div id="systemMsg">
<h2>Ειδοποιήσεις Συστήματος</h2>
<img id="msgIcon" src="Avatar/ok.png"/>
<h4 class="myDiv" id="myDiv">Όλα πηγαίνουν καλά !!</h4>
</div>

<div id="urlAdd">
<h2>Φόρμα Καταχώρησης Σταθμών</h2>
<form action="" method="GET">
<label>Station :</label>
<input id="url" name="url" placeholder="Url" type="text">
<button type="button" onclick="getUrl(<?php echo $user_id;?>)">Add to DB</button>
<!--<span><?php echo $error; ?></span>-->
</form>
</div>
<img id="mainIcon" src="main.jpg">
<div id="refresh">
<button type="button" id="refreshBut" onclick="updateDB()">Update DB</button>
</div>
</div>
</body>
</html>