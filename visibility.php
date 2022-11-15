<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <?php $value =$_POST['range'];?>
        <div class="title">Sales information based on visibility </div>
      
<table>
    <th>SALES_RANGE</th>
    <th>averageVisibility</th>
</table>

<div class="radios">
    <form action="visibility.php" method="POST">
        <p><div class="show"> Set sales range: </div></br>
        <div class="checkboxs">
        <input type= range name = "range" min="1000" max="13000" value=<? if($value==null){echo "2000";}else{echo $value;}?> step="1000" id="myRange"> </br>
        
        Value: <span id="value"></span></p>
        <input type="submit" name="submit" value="Run Analysis">
</div>
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