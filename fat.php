<?php

header('Content-Type: text/html; charset=UTF-8');
$mysqli=mysqli_connect("localhost","team21","team21","team21");
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_error($mysqli));
   exit();
}
else{
   echo "성공!</br>";
   $sql = "SELECT iFatContent, COUNT(iFatContent) AS cnt, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
   FROM fatSales
   GROUP BY iFatContent;";
   $res = mysqli_query($mysqli, $sql);
   if($res){
    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $fatContent=$newArray['iFatContent'];
        $count=$newArray['cnt'];
        $sum=$newArray['totalSales'];
        echo "Fat Content : ".$fatContent." Count : ".$count." Total Sales : ".$sum."</br>";
    }
   }
    else{
        printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
    }
    mysqli_free_result($res);
    mysqli_close($mysqli);
}

?>