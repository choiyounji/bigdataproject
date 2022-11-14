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