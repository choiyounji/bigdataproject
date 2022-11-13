<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
        <div class="title">Sales information based on fat </div>
            <table>
                <th>fatContent</th>
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
                    $showValues = "";
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

                    $sql = "SELECT iFatContent, COUNT(iFatContent) AS cnt, SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
                    FROM fatSales
                    WHERE iFatContent in ".$showValues."
                    GROUP BY iFatContent;";
                    $res = mysqli_query($mysqli, $sql);
                    if($res){

                        if(mysqli_num_rows($res) == 0){
                            echo "There are no sales under the chosen conditions.";
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
        </div>
        <div class="radios">
            <form action="" method="POST">
                <p><div class="show"> SHOW: </div></br>
                
                <label><input type= "radio" name = "showValues" value="ALL" checked> ALL</label></br>
                <label><input type= "radio" name = "showValues" value="High Fat">High Fat<label></br>
                <label><input type= "radio" name = "showValues" value="Regular">Regular<label></br>
                <label><input type= "radio" name = "showValues" value="Low Fat">Low Fat<label><p>
                <input type="submit" name="submit" value="Run Analysis">
        </div>

    </body>

</html>