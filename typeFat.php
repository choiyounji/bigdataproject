<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on Item Type and Fat </div>
      
<table>
    <th>Item Type</th>
    <th>Fat Content</th>
    <th>Average Sales</th>

<?php

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   
   $sql = "SELECT iType, iFatContent, AVG(iOutletSales) AS averageSales
   FROM typeFatSales
   GROUP BY iType, iFatContent WITH ROLLUP";
   $res = mysqli_query($mysqli, $sql);
   
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $iType=$newArray['iType'];
        $iFatContent=$newArray['iFatContent'];
        $averageSales=$newArray['averageSales'];
        echo "<tr><td>".$iType."</td> <td>".$iFatContent."</td> <td>".$averageSales."</td></tr>";
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