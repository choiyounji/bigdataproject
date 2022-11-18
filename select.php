<!-- 최윤지 -->
<!DOCTYPE html>
<?php
    session_start();
    $_SESSION['checked'] = 'All';
 
    ?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="menu">
        <div class="menublock">
            <div class="title2">
            Main Analysis
            </div>
            <div class="subtitle">
            You can figure out the sales based on the selected attribute. Please select the attributes you want.
            </div>
            <div class = "buttons">
                <button type="button" onClick="location.href='fat.php'"> fat </button>
                <button type="button" onClick="location.href='visibility.php'"> visibility </button>
                <button type="button" onClick="location.href='type.php'"> type </button>
            </div>
            <div class = "buttons">
                <button type="button" onClick="location.href='mrp.php'"> mrp </button>
                <button type="button" onClick="location.href='outletSize.php'"> outlet size </button>
                <button type="button" onClick="location.href='locationType.php'"> location type </button>
            </div>
                <div class = "buttons">
                    <button type="button" onClick="location.href='yearsEstablished.php'"> years established </button>
                    <button type="button" onClick="location.href='typeFat.php'"> item type & fat </button>
                    <button type="button" onClick="location.href='outletTypeLocation.php'"> location type & </br>outlet type </button>
                </div>
            
            <div class="menublock">
                <div class="title2">
                Data Manipulation
                </div>
                <div class="subtitle">
                Data can be inserted, deleted, or updated. 
                </div>
                <div class = "buttons">
                    <button type="button" onClick="location.href='insert.html'"> INSERT </button>
                    <button type="button" onClick="location.href='delete.html'"> DELETE </button>
                    <button type="button" onClick="location.href='update.html'"> UPDATE </button>
                </div>
            </div>
        </div>
    </body>
</html>