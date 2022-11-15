<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
        <div class="title">Insert Outlet Result </div>
        <table>
            <th>oIdentifier</th>
            <th>oEstablishmentYear</th>
            <th>oSize</th>
            <th>oLocationType</th>
            <th>oType</th>
            <th>oYearsEstablished</th>

            <?php
                header('Content-Type: text/html; charset=UTF-8');
                $mysqli=mysqli_connect("localhost","team21","team21","team21");
                if(mysqli_connect_errno()){
                    printf("Connect failed: %s\n", mysqli_error($mysqli));
                    exit();
                }
                else{
                    $sql = "SELECT oIdentifier FROM outlet WHERE oIdentifier='".$_POST["oIdentifier"]."';";
                    $ret = mysqli_query($mysqli, $sql);
                    $exist = mysqli_num_rows($ret);
                    if($exist>0){
                        echo "<tr><td></td><td> oIdentifier is duplicated. </td></tr>";
                                exit(0);
                    }
                    $YearsEstablished = 2022-$_POST["oEstablishmentYear"];
                    $sql = "INSERT into outlet (oIdentifier,
                   oEstablishmentYear,
                    oSize,
                    oLocationType,
                   oType,
                    oYearsEstablished) values ('".$_POST["oIdentifier"]."','".$_POST["oEstablishmentYear"]."','".$_POST["oSize"]."','".$_POST["oLocationType"]."','".$_POST["oType"]."','".$YearsEstablished."');";
                    $res=mysqli_query($mysqli,$sql);
                    if($res==TRUE){
                        $sql = "SELECT * from outlet where oIdentifier = '".$_POST["oIdentifier"]."';";
                        $res = mysqli_query($mysqli, $sql);
                        if($res){
                            while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $oIdentifier=$newArray['oIdentifier'];
                                $oEstablishmentYear=$newArray['oEstablishmentYear'];
                                $oSize=$newArray['oSize'];
                                $oLocationType=$newArray['oLocationType'];
                                $oType=$newArray['oType'];

                                echo "<tr><td></td><td> Insert Success</td></tr>";
                                echo "<tr><td>".$oIdentifier."</td><td>".$oEstablishmentYear."</td> <td>".$oSize."</td> <td>".$oLocationType."</td><td>".$oType."</td><td>".$YearsEstablished."</td></tr>";
                            }
                           }
                            else{
                                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                            }
                        
                    }
                    else{
                        printf("Could not insert record : %s\n", mysqli_error($mysqli));
                    }
                    mysqli_free_result($res);
                    mysqli_close($mysqli);
                }
            ?>
        </table>
 
    </body>
</html>