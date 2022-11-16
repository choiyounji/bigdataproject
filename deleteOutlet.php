<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <header>
        <a href="select.html">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" ViewBox="0 0 512 512">
                <path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
            HOME
        </a>
    </header>
    <div class="title">Result of DELETE Outlet </div>
    <table>
    <th>oIdentifier</th>
            <th>oEstablishmentYear</th>
            <th>oSize</th>
            <th>oLocationType</th>
            <th>oType</th>
            <th>oYearsEstablished</th>
        <?php
            header('Content-Type: text/html; charset=UTF-8');
            $mysqli = mysqli_connect("localhost", "team21", "team21", "team21");
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_error($mysqli));
                exit();
            } else {
                $sql = "SELECT * FROM outlet WHERE oIdentifier='".$_POST["oIdentifier"]."';";
                $ret = mysqli_query($mysqli, $sql);
                $exist = mysqli_num_rows($ret);
                if($exist<=0){
                    echo "<tr><td></td><td> The oIdentifier you entered does not exist. </td></tr>";
                            exit(0);
                } else {
                    while ($newArray = mysqli_fetch_array($ret, MYSQLI_ASSOC)) {
                        $oIdentifier=$newArray['oIdentifier'];
                        $oEstablishmentYear=$newArray['oEstablishmentYear'];
                        $oSize=$newArray['oSize'];
                        $oLocationType=$newArray['oLocationType'];
                        $oType=$newArray['oType'];
                        $YearsEstablished = 2022-$oEstablishmentYear;

                       
                        echo "<tr><td>".$oIdentifier."</td><td>".$oEstablishmentYear."</td> <td>".$oSize."</td> <td>".$oLocationType."</td><td>".$oType."</td><td>".$YearsEstablished."</td></tr>
                        <tr><td>.</td><td>.</td> <td>.</td> <td>.</td><td>.</td><td>.</td></tr></table></br>";
                    }
                    echo "<div class='show'> Before</div>
                    <table>
                    <th>oIdentifier</th>
                    <th>oEstablishmentYear</th>
                    <th>oSize</th>
                    <th>oLocationType</th>
                    <th>oType</th>
                    <th>oYearsEstablished</th>";
                    $sql = "DELETE FROM outlet WHERE oIdentifier='".$_POST["oIdentifier"]."';";
                    $res = mysqli_query($mysqli, $sql);
                    if ($res == TRUE) {
                        $sql = "SELECT * from outlet where oIdentifier = '".$_POST["oIdentifier"]."';";
                        $res = mysqli_query($mysqli, $sql);
                        if ($res) {
                            $exist = mysqli_num_rows($res);
                            if ($exist <= 0) {
                                echo "<tr><td></td><td></td><td></td><td> deleted </td></tr>";
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
    </table></br></br>
    <div class="show">After</div>


</body>

</html>