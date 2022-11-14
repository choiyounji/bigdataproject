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
    <form action="" method="POST">
        <p><div class="show"> SHOW item types: </div></br>   
        <label><input type= "checkbox" name = "showValues" vlaue="All" checked> ALL</label></br>
        <label><input type= "checkbox" name = "showValues" vlaue="Baking Goods">Baking Goods</label></br>
        <label><input type= "checkbox" name = "showValues" vlaue="Breads">Breads</label></br>
        <label><input type= "checkbox" name = "showValues" vlaue="Breakfast">Breakfast</label></br>
        <label><input type= "checkbox" name = "showValues" vlaue="Canned"></label>Canned</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Dairy"></label>Dairy</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Frozen Foods"></label>Frozen Foods</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Fruits and Vegetables"></label>Fruits and Vegetables</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Hard Drinks"></label>Hard Drinks</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Health and Hygiene"></label>Health and Hygiene</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Household"></label>Household</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Meat"></label>Meat</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Seafood"></label>Seafood</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Snack Foods"></label>Snack Foods</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Soft Drinks"></label>Soft Drinks</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Starcky Foods"></label>Starcky Foods</br>
        <label><input type= "checkbox" name = "showValues" vlaue="Others"></label>Others<p>
        <input type="submit" name="submit" value="Run Analysis">
</div>

</body>

</html>