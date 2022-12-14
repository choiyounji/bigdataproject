<!-- 정연희 -->
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
        <div class="title">MRP based on Item Type </div>
        <table>
            <th>Item Type</th>
            <th>Average MRP</th>
            <?php
            header('Content-Type: text/html; charset=UTF-8');
            $mysqli=mysqli_connect("localhost","team21","team21","team21");
            $selectedTypes = array();
            if(mysqli_connect_errno()){
                printf("Connect failed: %s\n", mysqli_error($mysqli));
                exit();
            }
            else{
                $list = "";
                if(isset($_POST["showValues"])){
                    foreach($_POST["showValues"] as $type){
                        array_push($selectedTypes, $type);
                    }
                    if($selectedTypes == array("All")){
                        $list = "Baking Goods', 'Breads', 'Breakfast', 'Canned', 'Dairy', 'Frozen Foods', 'Fruits and Vegetables', 'Hard Drinks', 
                                'Health and Hygiene', 'Household', 'Meat', 'Seafood', 'Snack Foods', 'Soft Drinks', 'Starchy Foods', 'Others";
                    }
                    else{
                        $list = implode("', '", $selectedTypes);
                    }
                }
                else{
                    $list = "Baking Goods', 'Breads', 'Breakfast', 'Canned', 'Dairy', 'Frozen Foods', 'Fruits and Vegetables', 'Hard Drinks', 
                                'Health and Hygiene', 'Household', 'Meat', 'Seafood', 'Snack Foods', 'Soft Drinks', 'Starchy Foods', 'Others";
                }
                $sql = "SELECT iType, AVG(iMrp) AS averageMrp
                        FROM typeMrpSales
                        USE INDEX (idxMrpIncrease)
                        WHERE iType in ('".$list."')
                        GROUP BY iType;";
                $res = mysqli_query($mysqli, $sql);
                if($res){
                    while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                        $iType=$newArray['iType'];
                        $avgMrp=$newArray['averageMrp'];
                        echo "<tr><td>".$iType."</td> <td>".$avgMrp."</td></tr>";
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
            <form action="mrp.php" method="POST">
                <p>
                    <div class="show"> SHOW item types: </div></br>   
                    <label><input type= "checkbox" name = "showValues[]" value="All" <?php if(empty($selectedTypes)){echo "checked";}?>> All</input></label></br>
                    <label><input type= "checkbox" name = "showValues[]" value="Baking Goods"<?php if(array_search('Baking Goods', $selectedTypes)===0||array_search('Baking Goods', $selectedTypes)){echo "checked";}?>>Baking Goods</input></label></br>
                    <label><input type= "checkbox" name = "showValues[]" value="Breads" <?php if(array_search('Breads', $selectedTypes)===0||array_search('Breads', $selectedTypes)){echo "checked";}?>>Breads</input></label></br>
                    <label><input type= "checkbox" name = "showValues[]" value="Breakfast" <?php if(array_search('Breakfast', $selectedTypes)===0||array_search('Breakfast', $selectedTypes)){echo "checked";}?>>Breakfast</input></label></br>
                    <label><input type= "checkbox" name = "showValues[]" value="Canned" <?php if(array_search('Canned', $selectedTypes)===0||array_search('Canned', $selectedTypes)){echo "checked";}?>></input></label>Canned</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Dairy" <?php if(array_search('Dairy', $selectedTypes)===0||array_search('Dairy', $selectedTypes)){echo "checked";}?>></input></label>Dairy</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Frozen Foods" <?php if(array_search('Frozen Foods', $selectedTypes)===0||array_search('Frozen Foods', $selectedTypes)){echo "checked";}?>></input></label>Frozen Foods</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Fruits and Vegetables" <?php if(array_search('Fruits and Vegetables', $selectedTypes)===0||array_search('Fruits and Vegetables', $selectedTypes)){echo "checked";}?>></input></label>Fruits and Vegetables</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Hard Drinks" <?php if(array_search('Hard Drinks', $selectedTypes)===0||array_search('Hard Drinks', $selectedTypes)){echo "checked";}?>></input></label>Hard Drinks</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Health and Hygiene" <?php if(array_search('Health and Hygiene', $selectedTypes)===0||array_search('Health and Hygiene', $selectedTypes)){echo "checked";}?>></input></label>Health and Hygiene</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Household" <?php if(array_search('Household', $selectedTypes)===0||array_search('Household', $selectedTypes)){echo "checked";}?>></input></label>Household</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Meat" <?php if(array_search('Meat', $selectedTypes)===0||array_search('Meat', $selectedTypes)){echo "checked";}?>></input></label>Meat</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Seafood" <?php if(array_search('Seafood', $selectedTypes)===0||array_search('Seafood', $selectedTypes)){echo "checked";}?>></input></label>Seafood</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Snack Foods" <?php if(array_search('Snack Foods', $selectedTypes)===0||array_search('Snack Foods', $selectedTypes)){echo "checked";}?>></input></label>Snack Foods</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Soft Drinks" <?php if(array_search('Soft Drinks', $selectedTypes)===0||array_search('Soft Drinks', $selectedTypes)){echo "checked";}?>></input></label>Soft Drinks</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Starchy Foods" <?php if(array_search('Starchy Foods', $selectedTypes)===0||array_search('Starchy Foods', $selectedTypes)){echo "checked";}?>></input></label>Starchy Foods</br>
                    <label><input type= "checkbox" name = "showValues[]" value="Others" <?php if(array_search('Others', $selectedTypes)){echo "checked";}?>></input></label>Others
                </p>
                <input type="submit" name="submit" value="Run Analysis" />
            </form>
        </div>

    </body>

</html>