<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>


    <body>
        <div class="title">Sales information based on visibility </div>
      
<table>
    <th>SALES_RANGE</th>
    <th>averageVisibility</th>
</table>

<div class="radios">
    <form action="" method="POST">
        <p><div class="show"> Set sales range: </div></br>
        <div class="checkboxs">
        <input type= range name = "range" min="1000" max="13000" value="2000" step="1000" id="myRange"checked> </br>
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