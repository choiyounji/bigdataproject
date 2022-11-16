<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
        <style>
            .tableHeader {
                margin: 0.5% 2.1% 0%;
            }
            .tableContainer {
                display: flex;
                flex-direction: column;
                align:left;

            }
        </style>
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
        <div class="title">Result of Update Item </div>

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
                            echo "<tr><td></td><td> The iIdentifier you entered does not exist. </td></tr>";
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
                            }
                            else{
                                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                            }
                    
                        }
                        else{
                            printf("Could not update record : %s\n", mysqli_error($mysqli));
                        }
                        mysqli_free_result($update_res);
                        mysqli_free_result($after_res);
                        mysqli_close($mysqli);
                    }
                ?>
            </table>
        </div>
    </body>
</html>