<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on </br>Outlet Location Type and Outlet Type </div>
      
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

    if(isset($_POST["showValues"])){
        if($_POST["showValues"] == "Tier1"){
            $showValues = "('Tier 1')";
        }
        elseif($_POST["showValues"] == "Tier2"){
            $showValues = "('Tier 2')";
        }
        elseif($_POST["showValues"] == "Tier3"){
            $showValues = "('Tier 3')";
        }
        else{
        $showValues = "('Tier 1', 'Tier 2', 'Tier 3')";
        }
    }
    else{
        $showValues = "('Tier 1', 'Tier 2', 'Tier 3')";
    }
   
   $sql = "SELECT oLocationType, oType, SUM(iOutletSales) AS totalSales
   FROM outletTypeLocationSales
   WHERE oLocationType in ".$showValues."
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
<div class="radios">
    <form action="outletTypeLocation.php" method="POST">
        <p>
            <div class="show"> Location Type: </div></br>
            <label><input type= "radio" name = "showValues" value="All" <?php if($showValues ==null||$showValues ==="('Tier 1', 'Tier 2', 'Tier 3')"){echo "checked";}?>> All</label></br>
            <label><input type= "radio" name = "showValues" value="Tier1" <?php if($showValues ==="('Tier 1')"){echo "checked";}?>>Tier1<label></br>
            <label><input type= "radio" name = "showValues" value="Tier2" <?php if($showValues ==="('Tier 2')"){echo "checked";}?>>Tier2<label></br>
            <label><input type= "radio" name = "showValues" value="Tier3" <?php if($showValues ==="('Tier 3')"){echo "checked";}?>>Tier3<label></br>
</p>
        <input type="submit" name="submit" value="Run Analysis">
</div>


</body>

</html>