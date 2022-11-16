<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <div class="title">Result of DELETE Weight </div>
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
                $sql = "SELECT * FROM itemInfo WHERE iWeight=" . $_POST['iWeight'] . ";";
                $ret = mysqli_query($mysqli, $sql);
                $exist = mysqli_num_rows($ret);
                if ($exist <= 0) {
                    echo "<tr><td></td><td> The Weight you entered does not exist. </td></tr>";
                    exit(0);
                } else {
                    while ($newArray = mysqli_fetch_array($ret, MYSQLI_ASSOC)) {
                        $iIdentifier = $newArray['iIdentifier'];
                        $iWeight = $newArray['iWeight'];
                        $iFatContent = $newArray['iFatContent'];
                        $iType = $newArray['iType'];
                        echo "<tr><td>" . $iIdentifier . "</td><td>" . $iWeight . "</td> <td>" . $iFatContent . "</td> <td>" . $iType . "</td></tr>";
                    }
                    echo "<tr><td>.</td><td>.</td><td>.</td><td>.</td></tr></table></br><div class='show'> Before</div>
    <table>
        <th>iIdentifier</th>
        <th>iWeight</th>
        <th>iFatContent</th>
        <th>iType</th>";
                    $sql = "DELETE FROM itemInfo  WHERE iWeight=" . $_POST['iWeight'] . ";";
                    $res = mysqli_query($mysqli, $sql);
                    if ($res == TRUE) {
                        $sql = "SELECT * from ItemInfo WHERE iWeight=" . $_POST['iWeight'] . ";";
                        $res = mysqli_query($mysqli, $sql);
                        if ($res) {
                            $exist = mysqli_num_rows($res);
                            if ($exist <= 0) {
                                echo "<tr><td></td><td>deleted</td><td> </td></tr>";
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