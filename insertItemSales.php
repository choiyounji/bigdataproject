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
            <a href="insert.html">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M112 160l-64 64 64 64"/>
                <path d="M64 224h294c58.76 0 106 49.33 106 108v20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
                BACK
            </a>
        </header>
        <div class="title">Result of Insert Item Sales</div>
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
                        $sql = "SELECT * FROM itemSales WHERE iIdentifier='".$_POST['iIdentifier']."' AND oIdentifier='".$_POST['oIdentifier']."';";
                        $sql_itemInfo = "SELECT * FROM itemInfo WHERE iIdentifier='".$_POST['iIdentifier']."';";
                        $sql_outlet = "SELECT * FROM outlet WHERE oIdentifier='".$_POST['oIdentifier']."';";
                        $res = mysqli_query($mysqli, $sql);
                        $res_itemInfo = mysqli_query($mysqli, $sql_itemInfo);
                        $res_outlet = mysqli_query($mysqli, $sql_outlet);

                        $exist = mysqli_num_rows($res);
                        if($exist>0 || mysqli_num_rows($res_itemInfo) > 0 || mysqli_num_rows($res_outlet) > 0 ){
                            echo "<tr><td></td><td> duplicated. </td></tr>";
                            exit(0);
                        }
                        mysqli_begin_transaction($mysqli);
                        try{
                            mysqli_query($mysqli, "INSERT into itemInfo (iIdentifier,iWeight,iFatContent,iType) values ('".$_POST["iIdentifier"]."',".$_POST["iWeight"].",'".$_POST["iFatContent"]."','".$_POST["iType"]."');");
                            $YearsEstablished = 2022-$_POST["oEstablishmentYear"];
                            mysqli_query($mysqli, "INSERT into outlet (oIdentifier,oEstablishmentYear,oSize,oLocationType,oType,oYearsEstablished) values ('".$_POST["oIdentifier"]."',".$_POST["oEstablishmentYear"].",'".$_POST["oSize"]."','".$_POST["oLocationType"]."','".$_POST["oType"]."',".$YearsEstablished.");");
                            mysqli_query($mysqli, "INSERT into itemSales (iIdentifier,oIdentifier,iOutletSales,iVisibility,iMrp) values ('".$_POST["iIdentifier"]."','".$_POST["oIdentifier"]."',".$_POST["iOutletSales"].", ".$_POST["iVisibility"].", ".$_POST["iMrp"].");");
                            mysqli_commit($mysqli);
                        
            
        
                            $sql = "SELECT * FROM itemSales WHERE iIdentifier='".$_POST['iIdentifier']."' AND oIdentifier='".$_POST['oIdentifier']."';";
                            $res = mysqli_query($mysqli, $sql);
                            if($res){
                                while($newArray=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                    $iIdentifier=$newArray['iIdentifier'];
                                    $oIdentifier=$newArray['oIdentifier'];
                                    $iOutletSales=$newArray['iOutletSales'];
                                    $iVisibility=$newArray['iVisibility'];
                                    $iMrp=$newArray['iMrp'];
                                    echo "<tr><td></td><td> Insert Success</td></tr>";
                                    echo "<tr><td>".$iIdentifier."</td><td>".$oIdentifier."</td> <td>".$iOutletSales."</td> <td>".$iVisibility."</td><td>".$iMrp."</td> </tr>";
                                }
                               }
                                else{
                                    printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                                }
                            
                            }  catch(mysqli_sql_exception $exception){
                                mysqli_rollback($mysqli);
                                echo "<tr><td></td><td> Syntax ERROR </td></tr>";
                            }
        
                  
                        mysqli_free_result($res);
                        mysqli_close($mysqli);
                    }

                ?>
            </table>
    </body>
</html>