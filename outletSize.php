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
            <th>Total Sales</th>
        
            <?php
               
            ?>
        </table>
        <div class="radios">
            <form action="fat.php" method="POST">
                <p><div class="show"> SHOW: </div></br>
                <label><input type= "radio" name = "showValues" value="All" <? if($showValues ==null||$showValues ==="('Small', 'Medium', 'High')"){echo "checked";}?>> All</label></br>
                <label><input type= "radio" name = "showValues" value="High" <? if($showValues==="('High')"){echo "checked";}?>>High Fat<label></br>
                <label><input type= "radio" name = "showValues" value="Medium" <? if($showValues==="('Medium')"){echo "checked";}?>>Regular<label></br>
                <label><input type= "radio" name = "showValues" value="Small" <? if($showValues==="('Small')"){echo "checked";}?>>Low Fat<label><p>
                <input type="submit" name="submit" value="Run Analysis">
        </div>
    </body>

</html>