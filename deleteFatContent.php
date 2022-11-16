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
        <a href="delete.html">
        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M112 160l-64 64 64 64"/>
            <path d="M64 224h294c58.76 0 106 49.33 106 108v20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
        </svg>
            BACK
        </a>
    </header>
    <div class="title">Result of DELETE Fat Content </div>
    <div class="tableContainer">
    <h2 class="tableHeader">Before</h2>
    <table>
        <th>iIdentifier</th>
        <th>iWeight</th>
        <th>iFatContent</th>
        <th>iType</th>
        <?php
            header('Content-Type: text/html; charset=UTF-8');
            $mysqli = mysqli_connect("localhost", "team21", "team21", "team21");
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_error($mysqli));
                exit();
            } else {
              

                $sql = "SELECT * FROM itemInfo WHERE iFatContent='" . $_POST['iFatContent'] . "';";
                $ret = mysqli_query($mysqli, $sql);
                $exist = mysqli_num_rows($ret);
                if ($exist <= 0) {
                    echo "<tr><td></td><td> The Fat Content you entered does not exist. </td></tr>";
                    exit(0);
                } else {
                    while ($newArray = mysqli_fetch_array($ret, MYSQLI_ASSOC)) {
                        $iIdentifier = $newArray['iIdentifier'];
                        $iWeight = $newArray['iWeight'];
                        $iFatContent = $newArray['iFatContent'];
                        $iType = $newArray['iType'];
                        echo "<tr><td>" . $iIdentifier . "</td><td>" . $iWeight . "</td> <td>" . $iFatContent . "</td> <td>" . $iType . "</td></tr>";
                    }
                }
            }
            mysqli_free_result($ret);
            ?>
                    
        
        
                   
                   <table>
                   <h2 class='tableHeader'>After</h2>
        <th>iIdentifier</th>
        <th>iWeight</th>
        <th>iFatContent</th>
        <th>iType</th>
       <?php mysqli_begin_transaction($mysqli);
        try{
            mysqli_query($mysqli, "DELETE FROM itemInfo  WHERE iFatContent='" . $_POST['iFatContent'] . "'");
            mysqli_query($mysqli, "DELETE FROM fatSales  WHERE iFatContent='" . $_POST['iFatContent'] . "'");
            mysqli_commit($mysqli);
            $sql = "SELECT * from ItemInfo WHERE iFatContent='" . $_POST['iFatContent'] . "';";
            $res = mysqli_query($mysqli, $sql);
            if ($res) {
                $exist = mysqli_num_rows($res);
                if ($exist <= 0) {
                    echo "<tr><td></td><td>deleted</td><td> </td></tr>";
                }
            } else {
                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
            }
            mysqli_free_result($res);}
            catch(mysqli_sql_exception $exception){
                mysqli_rollback($mysqli);
                echo "<tr><td></td><td> Roll Back </td></tr>";

            }
                       
                    mysqli_close($mysqli);

                
            ?>
    </table>
 </div>

</body>

</html>