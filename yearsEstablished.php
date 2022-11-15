<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
    <header>
      <a href="select.html">← HOME</a>
    </header>
        <div class="title">Sales information based on Years Outlet was Established </div>
        <table>
            <th>Years Established</th>
            <th>Average Sales</th>
            <?php
            session_start();
            $_SESSION['checked'] = 'All';
            header('Content-Type: text/html; charset=UTF-8');
            $mysqli=mysqli_connect("localhost","team21","team21","team21");
            if(mysqli_connect_errno()){
                printf("Connect failed: %s\n", mysqli_error($mysqli));
                exit();
            }
            else{
                if(isset($_POST["showValues"])){
                    if($_POST["showValues"] == 13){
                        $showValues = "(13)";
                    }
                    elseif($_POST["showValues"] == 15){
                        $showValues = "(15)";
                    }
                    elseif($_POST["showValues"] == 18){
                        $showValues = "(18)";
                    }
                    elseif($_POST["showValues"] == 20){
                        $showValues = "(20)";
                    }
                    elseif($_POST["showValues"] == 23){
                        $showValues = "(23)";
                    }
                    elseif($_POST["showValues"] == 24){
                        $showValues = "(24)";
                    }
                    elseif($_POST["showValues"] == 25){
                        $showValues = "(25)";
                    }
                    elseif($_POST["showValues"] == 35){
                        $showValues = "(35)";
                    }
                    elseif($_POST["showValues"] == 37){
                        $showValues = "(37)";
                    }
                    else{
                    $showValues = "(13,15,18,20,23,24,25,35,37)";
                    }
                }
                else{
                    $showValues = "(13,15,18,20,23,24,25,35,37)";
                }
    
                $sql = "select oYearsEstablished, AVG(iOutletSales) as avgSales
                from yearsEstablishedSales
                WHERE oYearsEstablished in ".$showValues."
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
        <div class="radios">
        <form action="yearsEstablished.php" method="POST">
        <p><div class="show"> Years: </div></br>
        <label><input type= "radio" name = "showValues" value="All"<?php if($showValues ==null||$showValues ==="(13,15,18,20,23,24,25,35,37)"){echo "checked";}?>> All</label></br>
        <label><input type= "radio" name = "showValues" value="13"<?php if($showValues ==="(13)"){echo "checked";}?>>13<label></br>
        <label><input type= "radio" name = "showValues" value="15"<?php if($showValues ==="(15)"){echo "checked";}?>>15<label></br>
        <label><input type= "radio" name = "showValues" value="18"<?php if($showValues ==="(18)"){echo "checked";}?>>18<label></br>
        <label><input type= "radio" name = "showValues" value="20"<?php if($showValues ==="(20)"){echo "checked";}?>>20<label></br>
        <label><input type= "radio" name = "showValues" value="23"<?php if($showValues ==="(23)"){echo "checked";}?>>23<label></br>
        <label><input type= "radio" name = "showValues" value="24"<?php if($showValues ==="(24)"){echo "checked";}?>>24<label></br>
        <label><input type= "radio" name = "showValues" value="25"<?php if($showValues ==="(25)"){echo "checked";}?>>25<label></br>
        <label><input type= "radio" name = "showValues" value="35"<?php if($showValues ==="(35)"){echo "checked";}?>>35<label></br>
        <label><input type= "radio" name = "showValues" value="37"<?php if($showValues ==="(37)"){echo "checked";}?>>37<label></br>
        <input type="submit" name="submit" value="Run Analysis">
        </p>
        </div>
    </body>
</html>