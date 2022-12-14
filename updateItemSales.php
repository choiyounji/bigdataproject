<!-- 정연희,최윤지 -->
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
            <a href="update.html">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M112 160l-64 64 64 64"/>
                <path d="M64 224h294c58.76 0 106 49.33 106 108v20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
                BACK
            </a>
        </header>
        <div class="title">Result of Update Item Sales</div>
        <div class="tableContainer">
            <h2 class="tableHeader">Before</h2>
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
                        $before_sql = "SELECT * FROM itemSales WHERE iIdentifier='".$_POST['iIdentifier']."' AND oIdentifier='".$_POST['oIdentifier']."';";
                        $before_res = mysqli_query($mysqli, $before_sql);
                        $exist = mysqli_num_rows($before_res);
                        if($exist<=0){
                            echo "<tr><td></td><td> The item sales you entered does not exist. </td></tr>";
                            exit(0);
                        }
                        else{
                            while($newArray=mysqli_fetch_array($before_res, MYSQLI_ASSOC)){
                                $iIdentifier=$newArray['iIdentifier'];
                                $oIdentifier=$newArray['oIdentifier'];
                                $iOutletSales=$newArray['iOutletSales'];
                                $iVisibility=$newArray['iVisibility'];
                                $iMrp=$newArray['iMrp'];
                                echo "<tr><td>".$iIdentifier."</td><td>".$oIdentifier."</td> <td>".$iOutletSales."</td> <td>".$iVisibility."</td><td>".$iMrp."</td> </tr>";
                            }
                        }
                    }
                    mysqli_free_result($before_res);
                    mysqli_close($mysqli);
                ?>
            </table>
            <h2 class='tableHeader'>After</h2>
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
                        $update_sql = "UPDATE itemSales 
                                        SET iOutletSales=".$_POST["iOutletSales"].", iVisibility=".$_POST["iVisibility"].", iMrp=".$_POST["iMrp"]." 
                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                        $update_res=mysqli_query($mysqli,$update_sql);
                        if($update_res){
                            $after_sql =  "SELECT * FROM itemSales WHERE iIdentifier='".$_POST['iIdentifier']."' AND oIdentifier='".$_POST['oIdentifier']."';";
                            $after_res = mysqli_query($mysqli, $after_sql);
                            if($after_res){
                                while($newArray=mysqli_fetch_array($after_res, MYSQLI_ASSOC)){
                                    $iIdentifier=$newArray['iIdentifier'];
                                    $oIdentifier=$newArray['oIdentifier'];
                                    $iOutletSales=$newArray['iOutletSales'];
                                    $iVisibility=$newArray['iVisibility'];
                                    $iMrp=$newArray['iMrp'];
                                    echo "<tr><td>".$iIdentifier."</td><td>".$oIdentifier."</td> <td>".$iOutletSales."</td> <td>".$iVisibility."</td><td>".$iMrp."</td> </tr>";
                                }

                                $update_fatSales_sql = "UPDATE fatSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_fatSales_res = mysqli_query($mysqli, $update_fatSales_sql);
                                if(!$update_fatSales_res){
                                    printf("Could not update fatSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_visibilitySales_sql = "UPDATE visibilitySales 
                                                        SET iOutletSales=".$_POST["iOutletSales"].", iVisibility=".$_POST["iVisibility"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_visibilitySales_res = mysqli_query($mysqli, $update_visibilitySales_sql);
                                if(!$update_visibilitySales_res){
                                    printf("Could not update visibilitySales : %s\n", mysqli_error($mysqli));
                                }

                                $update_typeSales_sql = "UPDATE typeSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_visibilitySales_res= mysqli_query($mysqli, $update_typeSales_sql);
                                if(!$update_visibilitySales_res){
                                    printf("Could not update typeSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_typeMrpSales_sql = "UPDATE typeMrpSales 
                                                        SET iMrp=".$_POST["iMrp"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_typeMrpSales_res= mysqli_query($mysqli, $update_typeMrpSales_sql);
                                if(!$update_typeMrpSales_res){
                                    printf("Could not update typeMrpSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_outletSizeSales_sql = "UPDATE outletSizeSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_outletSizeSales_res= mysqli_query($mysqli, $update_outletSizeSales_sql);
                                if(!$update_outletSizeSales_res){
                                    printf("Could not update outletSizeSales : %s\n", mysqli_error($mysqli));
                                }
                                
                                $update_locationTypeSales_sql = "UPDATE locationTypeSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_locationTypeSales_res= mysqli_query($mysqli, $update_locationTypeSales_sql);
                                if(!$update_locationTypeSales_res){
                                    printf("Could not update locationTypeSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_yearsEstablishedSales_sql = "UPDATE yearsEstablishedSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_yearsEstablishedSales_res= mysqli_query($mysqli, $update_yearsEstablishedSales_sql);
                                if(!$update_yearsEstablishedSales_res){
                                    printf("Could not update yearsEstablishedSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_typeFatSales_sql = "UPDATE typeFatSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_typeFatSales_res = mysqli_query($mysqli, $update_typeFatSales_sql);
                                if(!$update_typeFatSales_res){
                                    printf("Could not update typeFatSales : %s\n", mysqli_error($mysqli));
                                }

                                $update_outletTypeLocationSales_sql = "UPDATE outletTypeLocationSales 
                                                        SET iOutletSales=".$_POST["iOutletSales"]."
                                                        WHERE iIdentifier='".$_POST["iIdentifier"]."'AND oIdentifier='".$_POST['oIdentifier']."';";
                                $update_outletTypeLocationSales_res = mysqli_query($mysqli, $update_outletTypeLocationSales_sql);
                                if(!$update_outletTypeLocationSales_res){
                                    printf("Could not update outletTypeLocationSales : %s\n", mysqli_error($mysqli));
                                }
                            }
                            else{
                                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                            }
                        }
                        else{
                            printf("Could not update record : %s\n", mysqli_error($mysqli));
                        }
                      
                        mysqli_free_result($after_res);
                        mysqli_close($mysqli);
                    }
                ?>
            </table>
        </div>
    </body>
</html>