<?php
include 'connection.php';
include 'authentication.php';
$sql2="";

error_reporting(0);//na mhn mas prizei ta oumpala me ta warnings
 //$input = json_decode(file_get_contents('php://input'),true);

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($conn) {
  if ($value===null) return null;
  return mysqli_real_escape_string($conn,(string)$value);
},array_values($input));

// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
  $set.=($i>0?',':'').'`'.$columns[$i].'`=';
  $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}

//getting data from forms
$typeofdirt=$_GET['type_of_dirt'];
$stationid=$_GET['station_id'];
$hour='h'.$_GET['hour'];
$date=$_GET['date'];
$month='-'.$_GET['month'].'-';//formarisma ths eisodou wste naa tairiazei sta protypa tou dataset
$year=$_GET['year'].'-';

//create sql for each request on the API
if ($_GET['action']=='show_pollution'){
  if (!$stationid){
    $sql = "select location,$hour from station inner join dirt on station.id=dirt.station_id where dirt.name='$typeofdirt'
    and dirt.dmy='$date'";
  }
  else{
    $sql = "select location,$hour from station inner join dirt on station.id=dirt.station_id where id='$stationid'
    and dirt.name='$typeofdirt' and dirt.dmy='$date'";
  }
}
elseif ($_GET['action']=='show_station'){
  $sql = "select * from station";
}
elseif($_GET['action']=='show_stats'){
  if (!$stationid){
      $sql = "select avg(dirt.h1";
      for ($i=2; $i <=24 ; $i++) {
          $sql.="+dirt.h$i";
      }
      $sql .= ")/24 as avarage,location from station inner join dirt on station.id=dirt.station_id where dirt.name='$typeofdirt'
      and (dirt.dmy='$date' or dirt.dmy like '$year%' or dirt.dmy like '%$month%')";

      $sql2 = "select std(dirt.h1";
      for ($j=2; $j <=24 ; $j++) {
          $sql2.="+dirt.h$j";
      }
      $sql2 .= ") as standard_dev,location from station inner join dirt on station.id=dirt.station_id where dirt.name='$typeofdirt'
      and (dirt.dmy='$date' or dirt.dmy like '$year%' or dirt.dmy like '%$month%')";
  }
  else{
    $sql = "select avg(dirt.h1";
    for ($i=2; $i <=24 ; $i++) {
        $sql.="+dirt.h$i";
    }
    $sql .= ")/24 as avarage,location from station inner join dirt on station.id=dirt.station_id where id='$stationid' and dirt.name='$typeofdirt' and
    (dirt.dmy='$date' or dirt.dmy like '$year%' or dirt.dmy like '%$month%')";

    $sql2 = "select std(dirt.h1";
    for ($j=2; $j <=24 ; $j++) {
        $sql2.="+dirt.h$j";
    }
    $sql2 .= ") as standard_dev,location from station inner join dirt on station.id=dirt.station_id where id='$stationid' and dirt.name='$typeofdirt' and
    (dirt.dmy='$date' or dirt.dmy like '$year%' or dirt.dmy like '%$month%')";
  }
}

else{
  echo "ton hpiame";
};
//echo $sql2;
// excecute SQL statement
$result = mysqli_query($conn,$sql);
$result2 =  mysqli_query($conn,$sql2);
//echo $sql2;

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
}
echo "[";
// print results, insert id or affected row count
for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    if($result2)
    echo ($i>0?',':'').",".json_encode(mysqli_fetch_object($result2));
  }
  echo "]";
//better solution
//$rows = array();
//while($r = mysqli_fetch_assoc($result)) {
  //  $rows[] = $r;

//}
//print json_encode($rows);
// close mysql connection
mysqli_close($conn);
?>
