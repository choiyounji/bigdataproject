<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <div class="title">Result of DELETE Item Sales </div>
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
                        <tr><td>.</td> <td>.</td> <td>.</td><td>.</td><td>.</td></tr></table></br>";
                    }
                    echo "<div class='show'> Before</div>
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
    </table></br></br>
    <div class="show">After</div>


</body>

</html>
