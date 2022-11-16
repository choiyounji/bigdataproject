<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
    <header>
      <a href="select.php">← HOME</a>
    </header>
        <div class="title">Insert Item Sales Result </div>
        <table>
            <th>iIdentifier</th>
            <th>oIdentifier</th>
            <th>iOutletSales</th>
            <th>iVisibility</th>
            <th>iMrp</th>
            <?php
                header('Content-Type: text/html; charset=UTF-8');
                $mysqli=mysqli_connect("localhost","team21","team21","team21");
                if(mysqli_connect_errno()){
                    printf("Connect failed: %s\n", mysqli_error($mysqli));
                    exit();
                }
                else{
                    $sql = "SELECT iIdentifier FROM itemInfo WHERE iIdentifier='".$_POST['iIdentifier']."';";
                    $ret = mysqli_query($mysqli, $sql);
                    $exist = mysqli_num_rows($ret);
                    if($exist>0){
                        echo "<tr><td></td><td> iIdentifier is duplicated. </td></tr>";
                    exit(0);
                    }
                    $sql = "INSERT into itemInfo (iIdentifier,iWeight,iFatContent,iType) values ('".$_POST["iIdentifier"]."','".$_POST["iWeight"]."','".$_POST["iFatContent"]."','".$_POST["iType"]."');";
                    $res=mysqli_query($mysqli,$sql);
                    if($res==TRUE){
                        $sql = "SELECT * from ItemInfo where iIdentifier = '".$_POST["iIdentifier"]."';";
                        $res = mysqli_query($mysqli, $sql);
                        if($res){
                            while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $iIdentifier=$newArray['iIdentifier'];
                                $iWeight=$newArray['iWeight'];
                                $iFatContent=$newArray['iFatContent'];
                                $iType=$newArray['iType'];
                                echo "<tr><td></td><td> Insert Success</td></tr>";
                                echo "<tr><td>".$iIdentifier."</td><td>".$iWeight."</td> <td>".$iFatContent."</td> <td>".$iType."</td></tr>";
                            }
                           }
                            else{
                                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                            }
                        
                    }
                    else{
                        printf("Could not insert record : %s\n", mysqli_error($mysqli));
                    }
                    mysqli_free_result($ret);
                    mysqli_free_result($res);
                    mysqli_close($mysqli);
                }
            ?>
        </table>
 
    </body>
</html>