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
    <div class="title">Result of DELETE Item Sales </div>
    <div class="tableContainer">
            <h2 class="tableHeader">Before</h2>

    <table>
            <th>iIdentifier</th>
            <th>oIdentifier</th>
            <th>iOutletSales</th>
            <th>iVisibility</th>
            <th>iMRP</th>
        <?php
            header('Content-Type: text/html; charset=UTF-8');
            $mysqli = mysqli_connect("localhost", "team21", "team21", "team21");
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_error($mysqli));
                exit();
            } else {
                $sql = "SELECT * FROM itemSales WHERE oIdentifier='".$_POST["oIdentifier"]."' AND iIdentifier='" . $_POST['iIdentifier'] . "';";
                $ret = mysqli_query($mysqli, $sql);
                $exist = mysqli_num_rows($ret);
                if($exist<=0){
                    echo "<tr><td></td><td> The information you entered does not exist. </td></tr>";
                            exit(0);
                } else {
                    while ($newArray = mysqli_fetch_array($ret, MYSQLI_ASSOC)) {
                        $iIdentifier = $newArray['iIdentifier'];
                        $oIdentifier = $newArray['oIdentifier'];
                        $iOutletSales = $newArray['iOutletSales'];
                        $iVisibility = $newArray['iVisibility'];
                        $iMRP = $newArray['iMrp'];
                        echo "<tr><td>".$iIdentifier."</td><td>".$oIdentifier."</td><td>".$iOutletSales."</td> <td>".$iVisibility."</td> <td>".$iMRP."</td></tr>
                        </table></br>";
                    }
                    echo "
                    <table>
                    <th>iIdentifier</th>
                    <th>oIdentifier</th>
                    <th>iOutletSales</th>
                    <th>iVisibility</th>
                    <th>iMRP</th>";
                    $sql = "DELETE FROM itemSales WHERE oIdentifier='".$_POST["oIdentifier"]."' AND iIdentifier='" . $_POST['iIdentifier'] . "';";
                    $res = mysqli_query($mysqli, $sql);
                    if ($res == TRUE) {
                        $sql = "SELECT * from itemSales WHERE oIdentifier='".$_POST["oIdentifier"]."' AND iIdentifier='" . $_POST['iIdentifier'] . "';";
                        $res = mysqli_query($mysqli, $sql);
                        if ($res) {
                            $exist = mysqli_num_rows($res);
                            if ($exist <= 0) {
                                echo "<tr><td></td><td></td><td> deleted </td></tr>";
                            }
                        } else {
                            printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                        }

                    } else {
                        printf("Could not delete record : %s\n", mysqli_error($mysqli));
                    }
                    mysqli_free_result($ret);
                    mysqli_free_result($res);
                    mysqli_close($mysqli);

                }
            }
            ?>
    </table>
    </div>

</body>

</html>
