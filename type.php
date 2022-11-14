<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
        <div class="title">Sales information based on Item Type </div>   
        <table>
            <th>iType</th>
            <th>count</th>
            <th>totalSales</th>
            <th>averageSales</th>
            <?php
                header('Content-Type: text/html; charset=UTF-8');
                $mysqli=mysqli_connect("localhost","team21","team21","team21");
                if(mysqli_connect_errno()){
                    printf("Connect failed: %s\n", mysqli_error($mysqli));
                    exit();
                }
                else{
                    $selectedTypes = array();
                    foreach($_POST["showValues"] as $type){
                        if($type != "All"){
                            array_push($selectedTypes, $type);
                        }
                    }
                    $list = "";
                    if(empty($selectedTypes)){
                        $list = "Baking Goods', 'Breads', 'Breakfast', 'Canned', 'Dairy', 'Frozen Foods', 'Fruits and Vegetables', 'Hard Drinks', 
                                'Health and Hygiene', 'Household', 'Meat', 'Seafood', 'Snack Foods', 'Soft Drinks', 'Starcky Foods', 'Others";
                    }
                    else{
                        $list = implode("', '", $selectedTypes);
                    }
                    $sql = "SELECT iType, COUNT(iType) AS count, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
                            FROM typeSales
                            WHERE iType in ('".$list."')
                            GROUP BY iType;";
                    $res = mysqli_query($mysqli, $sql);
                    if($res){
                        while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            $iType=$newArray['iType'];
                            $count=$newArray['count'];
                            $totalSales = $newArray['totalSales'];
                            $avgSales = $newArray['averageSales'];
                            echo "<tr><td>".$iType."</td> <td>".$count."</td><td>".$totalSales."</td><td>".$avgSales."</td></tr>";
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
            <form action="type.php" method="POST">
                <p><div class="show"> SHOW item types: </div></br>   
                <label><input type= "checkbox" name = "showValues" value="All" > All</label></br>
                <label><input type= "checkbox" name = "showValues" value="Baking Goods">Baking Goods</label></br>
                <label><input type= "checkbox" name = "showValues" value="Breads">Breads</label></br>
                <label><input type= "checkbox" name = "showValues" value="Breakfast">Breakfast</label></br>
                <label><input type= "checkbox" name = "showValues" value="Canned"></label>Canned</br>
                <label><input type= "checkbox" name = "showValues" value="Dairy"></label>Dairy</br>
                <label><input type= "checkbox" name = "showValues" value="Frozen Foods"></label>Frozen Foods</br>
                <label><input type= "checkbox" name = "showValues" value="Fruits and Vegetables"></label>Fruits and Vegetables</br>
                <label><input type= "checkbox" name = "showValues" value="Hard Drinks"></label>Hard Drinks</br>
                <label><input type= "checkbox" name = "showValues" value="Health and Hygiene"></label>Health and Hygiene</br>
                <label><input type= "checkbox" name = "showValues" value="Household"></label>Household</br>
                <label><input type= "checkbox" name = "showValues" value="Meat"></label>Meat</br>
                <label><input type= "checkbox" name = "showValues" value="Seafood"></label>Seafood</br>
                <label><input type= "checkbox" name = "showValues" value="Snack Foods"></label>Snack Foods</br>
                <label><input type= "checkbox" name = "showValues" value="Soft Drinks"></label>Soft Drinks</br>
                <label><input type= "checkbox" name = "showValues" value="Starcky Foods"></label>Starcky Foods</br>
                <label><input type= "checkbox" name = "showValues" value="Others"></label>Others<p>
                <input type="submit" name="submit" value="Run Analysis">
        </div>
    </body>
</html>