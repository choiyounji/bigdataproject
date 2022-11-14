<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on Outlet Location Type and Outlet Type </div>
      
<table>
    <th>Outlet Location Type</th>
    <th>Outlet Type</th>
    <th>Total Sales</th>

<?php

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   
   $sql = "SELECT oLocationType, oType, SUM(iOutletSales) AS totalSales
   FROM outletTypeLocationSales
   GROUP BY oLocationType, oType
   ORDER BY oLocationType, oType;";
   $res = mysqli_query($mysqli, $sql);
   
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $oLocationType=$newArray['oLocationType'];
        $oType=$newArray['oType'];
        $totalSales=$newArray['totalSales'];
        echo "<tr><td>".$oLocationType."</td> <td>".$oType."</td> <td>".$totalSales."</td></tr>";
    }
   }
    else{
        printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
    }
    mysqli_free_result($res);
    mysqli_close($mysqli);
}
?>
</table>


</body>

</html>