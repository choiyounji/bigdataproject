<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on Oulet Location Type </div>
      
<table>
    <th>Outlet Location Type</th>
    <th>Total Sales</th>

<?php
$value = $_POST['showValues'];

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   
   $sql = "select oLocationType, SUM(iOutletSales) As totalSales
   from locationTypeSales
   GROUP BY oLocationType;";
   $res = mysqli_query($mysqli, $sql);
   
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $oLocationType=$newArray['oLocationType'];
        $totalSales=$newArray['totalSales'];
        echo "<tr><td>".$oLocationType."</td><td>".$totalSales."</td></tr>";
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

<div class="radios">
    <form action="locationType.php" method="POST">
        <p><div class="show"> Location Type: </div></br>
        
        <label><input type= "radio" name = "showValues" value="All" <? if($value ==null||$value ==="All"){echo "checked";}?>> All</label></br>
        <label><input type= "radio" name = "showValues" value="Tier1" <? if($value ==="Tier1"){echo "checked";}?>>Tier1<label></br>
        <label><input type= "radio" name = "showValues" value="Tier2" <? if($value ==="Tier2"){echo "checked";}?>>Tier2<label></br>
        <label><input type= "radio" name = "showValues" value="Tier3" <? if($value ==="Tier3"){echo "checked";}?>>Tier3<label></br>
    
        <input type="submit" name="submit" value="Run Analysis">
</div>


</body>

</html>