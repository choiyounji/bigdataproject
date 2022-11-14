<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on Years Outlet was Established </div>
      
<table>
    <th>Years Established</th>
    <th>Average Sales</th>

<?php

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   
   $sql = "select oYearsEstablished, AVG(iOutletSales) as avgSales
   from yearsEstablishedSales
   GROUP BY oYearsEstablished;";
   $res = mysqli_query($mysqli, $sql);
   
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $oYearsEstablished=$newArray['oYearsEstablished'];
        $avgSales=$newArray['avgSales'];
        echo "<tr><td>".$oYearsEstablished."</td> <td>".$avgSales."</td> </tr>";
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