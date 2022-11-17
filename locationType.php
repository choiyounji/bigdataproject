<!-- 최윤지 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
    <header>
        <a href="select.php">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" ViewBox="0 0 512 512">
                <path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            HOME
        </a>
    </header>
        <div class="title">Sales information based on Oulet Location Type </div>
      
<table>
    <th>Outlet Location Type</th>
    <th>Total Sales</th>

<?php

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
session_start();
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
   
   $sql = "SELECT oLocationType, SUM(iOutletSales) As totalSales
   from locationTypeSales 
   WHERE oLocationType in ".$showValues."
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
        
        <label><input type= "radio" name = "showValues" value="All" <?php if($_SESSION['checked']=="All"){echo "checked";}?>> All</label></br>
        <label><input type= "radio" name = "showValues" value="Tier1" <?php if($showValues ==="('Tier 1')"){echo "checked";}?>>Tier1<label></br>
        <label><input type= "radio" name = "showValues" value="Tier2" <?php if($showValues ==="('Tier 2')"){echo "checked";}?>>Tier2<label></br>
        <label><input type= "radio" name = "showValues" value="Tier3" <?php if($showValues ==="('Tier 3')"){echo "checked";}?>>Tier3<label></br>
    
        <input type="submit" name="submit" value="Run Analysis">
</div>


</body>

</html>

</html>