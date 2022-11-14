<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
        <div class="title">Sales information based on fat </div>
      
<table>
    <th>iFatContent</th>
    <th>count(iFatContent)</th>
    <th>totalSales</th>
    <th>averageSales</th>

<?php
$value = $_POST['showValues'];


header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   
   $sql = "SELECT iFatContent, COUNT(iFatContent) AS cnt, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
   FROM fatSales
   GROUP BY iFatContent;";
   $res = mysqli_query($mysqli, $sql);
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $fatContent=$newArray['iFatContent'];
        $count=$newArray['cnt'];
        $sum=$newArray['totalSales'];
        $average=$newArray['averageSales'];
        echo "<tr><td>".$fatContent."</td> <td>".$count."</td> <td>".$sum."</td><td>".$average."</td></tr>";
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
    <form action="fat.php" method="POST">
        <p><div class="show"> SHOW: </div></br>
        
        <label><input type= "radio" name = "showValues" value="All" <? if($value ==null||$value ==="All"){echo "checked";}?>> All</label></br>
        <label><input type= "radio" name = "showValues" value="High Fat" <? if($value==="High Fat"){echo "checked";}?>>High Fat<label></br>
        <label><input type= "radio" name = "showValues" value="Regular" <? if($value==="Regular"){echo "checked";}?>>Regular<label></br>
        <label><input type= "radio" name = "showValues" value="Low Fat" <? if($value==="Low Fat"){echo "checked";}?>>Low Fat<label><p>
        <input type="submit" name="submit" value="Run Analysis">
</div>
</body>

</html>