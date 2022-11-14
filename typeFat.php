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
$value = $_POST['showValues'];
$array = array($value);


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
<div class="radios">
    <form action="typeFat.php" method="POST">
        <p><div class="show"> SHOW item types: </div></br>   
        <label><input type= "checkbox" name = "showValues" value="All" <? if(empty($array)){echo "checked";}?>> All</label></br>
        <label><input type= "checkbox" name = "showValues" value="Baking Goods"<? if(array_search('Baking Goods', $array)){echo "checked";}?>>Baking Goods</label></br>
        <label><input type= "checkbox" name = "showValues" value="Breads" <? if(array_search('Breads', $array)){echo "checked";}?>>Breads</label></br>
        <label><input type= "checkbox" name = "showValues" value="Breakfast" <? if(array_search('Breakfast', $array)){echo "checked";}?>>Breakfast</label></br>
        <label><input type= "checkbox" name = "showValues" value="Canned" <? if(array_search('Canned', $array)){echo "checked";}?>></label>Canned</br>
        <label><input type= "checkbox" name = "showValues" value="Dairy" <? if(array_search('Dairy', $array)){echo "checked";}?>></label>Dairy</br>
        <label><input type= "checkbox" name = "showValues" value="Frozen Foods" <? if(array_search('Frozen Foods', $array)){echo "checked";}?>></label>Frozen Foods</br>
        <label><input type= "checkbox" name = "showValues" value="Fruits and Vegetables" <? if(array_search('Fruits and Vegetables', $array)){echo "checked";}?>></label>Fruits and Vegetables</br>
        <label><input type= "checkbox" name = "showValues" value="Hard Drinks" <? if(array_search('Hard Drinks', $array)){echo "checked";}?>></label>Hard Drinks</br>
        <label><input type= "checkbox" name = "showValues" value="Health and Hygiene" <? if(array_search('Health and Hygiene', $array)){echo "checked";}?>></label>Health and Hygiene</br>
        <label><input type= "checkbox" name = "showValues" value="Household" <? if(array_search('Household', $array)){echo "checked";}?>></label>Household</br>
        <label><input type= "checkbox" name = "showValues" value="Meat" <? if(array_search('Meat', $array)){echo "checked";}?>></label>Meat</br>
        <label><input type= "checkbox" name = "showValues" value="Seafood" <? if(array_search('Seafood', $array)){echo "checked";}?>></label>Seafood</br>
        <label><input type= "checkbox" name = "showValues" value="Snack Foods" <? if(array_search('Snack Foods', $array)){echo "checked";}?>></label>Snack Foods</br>
        <label><input type= "checkbox" name = "showValues" value="Soft Drinks" <? if(array_search('Soft Drinks', $array)){echo "checked";}?>></label>Soft Drinks</br>
        <label><input type= "checkbox" name = "showValues" value="Starcky Foods" <? if(array_search('Starcky Foods', $array)){echo "checked";}?>></label>Starcky Foods</br>
        <label><input type= "checkbox" name = "showValues" value="Others" <? if(array_search('Others', $array)){echo "checked";}?>></label>Others<p>
        <input type="submit" name="submit" value="Run Analysis">
</div>



</body>

</html>