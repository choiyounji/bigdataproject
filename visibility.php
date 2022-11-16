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
        <div class="title">Sales information based on Visibility </div>  
            <table>
                <th>SALES_RANGE</th>
                <th>Average Visibility</th>
                <?php
                    header('Content-Type: text/html; charset=UTF-8');
                    $mysqli=mysqli_connect("localhost","team21","team21","team21");
                    if(mysqli_connect_errno()){
                        printf("Connect failed: %s\n", mysqli_error($mysqli));
                        exit();
                    }
                    else{
                        $rangeNum = isset($_POST["range"])? $_POST["range"] : 2000;
                        $sql = "SELECT FLOOR(iOutletSales/".$rangeNum.")*".$rangeNum." AS SALES_RANGE, avg(iVisibility) AS averageVisibility
                                FROM visibilitySales
                                GROUP BY FLOOR(iOutletSales/".$rangeNum.");";
                        $res = mysqli_query($mysqli, $sql);
                        if($res){
                            while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $salesRange=$newArray['SALES_RANGE'];
                                $avgVisibility=$newArray['averageVisibility'];
                                echo "<tr><td>".$salesRange." - ".($salesRange + $rangeNum)."</td> <td>".$avgVisibility."</td></tr>";
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
            <form action="visibility.php" method="POST">
                <p><div class="show"> Set sales range: </div></br>
                <div class="checkboxs">
                <input type= range name = "range" min="1000" max="13000" value=<?php if(!isset($_POST["range"])){echo "2000";}else{echo $_POST["range"];}?> step="1000" id="myRange"> </br>
                Value: <span id="value"></span></p>
                <input type="submit" name="submit" value="Run Analysis">
            </form>
        </div>
        <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("value");
            output.innerHTML = slider.value;
            
            slider.oninput = function() {
                output.innerHTML = this.value;
            }
        </script>
    </body>
</html>
