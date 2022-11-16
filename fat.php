<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
    <header>
        <a href="select.html">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" ViewBox="0 0 512 512">
                <path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            HOME
        </a>
    </header>
        <div class="title">Sales information based on Fat </div>
        <table>
            <th>Fat Content</th>
            <th>Count</th>
            <th>Total Sales</th>
            <th>Average Sales</th>
            <?php
                header('Content-Type: text/html; charset=UTF-8');
                $mysqli=mysqli_connect("localhost","team21","team21","team21");
                if(mysqli_connect_errno()){
                    printf("Connect failed: %s\n", mysqli_error($mysqli));
                    exit();
                }
                else{
                    $showValues = "";
                    if(isset($_POST["showValues"])){
                        if($_POST["showValues"] == "High Fat"){
                            $showValues = "('High Fat')";
                        }
                        elseif($_POST["showValues"] == "Low Fat"){
                            $showValues = "('Low Fat')";
                        }
                        elseif($_POST["showValues"] == "Regular"){
                            $showValues = "('Regular')";
                        }
                        else{
                            $showValues = "('Low Fat', 'Regular', 'High Fat')";
                        }
                    }
                    else{
                        $showValues = "('Low Fat', 'Regular', 'High Fat')";
                    }
                    $sql = "SELECT iFatContent, COUNT(iFatContent) AS cnt, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
                    FROM fatSales
                    WHERE iFatContent in ".$showValues."
                    GROUP BY iFatContent;";
                    $res = mysqli_query($mysqli, $sql);
                    if($res){

                        if(mysqli_num_rows($res) == 0){
                            echo "<tr><td></td><td> There are no sales under the chosen conditions.</td></tr>";
                        }
                        else{
                            while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $fatContent=$newArray['iFatContent'];
                                $count=$newArray['cnt'];
                                $sum=$newArray['totalSales'];
                                $average=$newArray['averageSales'];
                                echo "<tr><td>".$fatContent."</td> <td>".$count."</td> <td>".$sum."</td><td>".$average."</td></tr>";
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
            <form action="fat.php" method="POST">
                <p><div class="show"> SHOW: </div></br>
                <label><input type= "radio" name = "showValues" value="All" <?php if($showValues ==null||$showValues ==="('Low Fat', 'Regular', 'High Fat')"){echo "checked";}?>/> All</label></br>
                <label><input type= "radio" name = "showValues" value="High Fat" <?php if($showValues==="('High Fat')"){echo "checked";}?>/>High Fat</label></br>
                <label><input type= "radio" name = "showValues" value="Regular" <?php if($showValues==="('Regular')"){echo "checked";}?>/>Regular</label></br>
                <label><input type= "radio" name = "showValues" value="Low Fat" <?php if($showValues==="('Low Fat')"){echo "checked";}?>/>Low Fat</label><p>
                <input type="submit" name="submit" value="Run Analysis">
        </div>
    </body>
</html>