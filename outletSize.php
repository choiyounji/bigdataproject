<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
        <div class="title">Sales information based on Outlet Size </div>
        <table>
            <th>Outlet Size</th>
            <th>Count</th>
            <th>Total Sales</th>
            <th>Average Sales</th>
        
            <?php
                $value = $_POST["showValues"];
                header('Content-Type: text/html; charset=UTF-8');
                $mysqli=mysqli_connect("localhost","team21","team21","team21");
                if(mysqli_connect_errno()){
                    printf("Connect failed: %s\n", mysqli_error($mysqli));
                    exit();
                }
                else{
                    $showValues = "";
                    if(isset($_POST["showValues"])){
                        if($_POST["showValues"] == "High"){
                            $showValues = "('High')";
                        }
                        elseif($_POST["showValues"] == "Medium"){
                            $showValues = "('Medium')";
                        }
                        elseif($_POST["showValues"] == "Small"){
                            $showValues = "('Small')";
                        }
                        else{
                            $showValues = "('High', 'Medium', 'Small')";
                        }
                    }
                    else{
                        $showValues = "('High', 'Medium', 'Small')";
                    }
                    $sql = "SELECT oSize, COUNT(oSize) AS count, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
                            FROM outletSizeSales
                            WHERE oSize in ".$showValues."
                            GROUP BY oSize;";
                    $res = mysqli_query($mysqli, $sql);
                    if($res){
                        if(mysqli_num_rows($res) == 0){
                            echo "<tr><td></td><td> There are no sales under the chosen conditions.</td></tr>";
                        }
                        else{
                            while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $oSize=$newArray['oSize'];
                                $count=$newArray['count'];
                                $sum=$newArray['totalSales'];
                                $average=$newArray['averageSales'];
                                echo "<tr><td>".$oSize."</td> <td>".$count."</td> <td>".$sum."</td><td>".$average."</td></tr>";
                            }
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
            <form action="outletSize.php" method="POST">
                <p>
                    <div class="show"> SHOW: </div></br>
                    <label><input type= "radio" name = "showValues" value="All" <?php if($value ==null||$value ==="('High', 'Medium', 'Small')"){echo "checked";}?>> All</label></br>
                    <label><input type= "radio" name = "showValues" value="High" <?php if($value==="('High')"){echo "checked";}?>>High<label></br>
                    <label><input type= "radio" name = "showValues" value="Medium" <?php if($value==="('Medium')"){echo "checked";}?>>Medium<label></br>
                    <label><input type= "radio" name = "showValues" value="Small" <?php if($value==="('Small')"){echo "checked";}?>>Small<label>
                </p>
                <input type="submit" name="submit" value="Run Analysis">
        </div>
    </body>

</html>