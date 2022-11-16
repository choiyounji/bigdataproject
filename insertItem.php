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
        <div class="title">Insert Item Result </div>
        <table>
            <th>iIdentifier</th>
            <th>iWeight</th>
            <th>iFatContent</th>
            <th>iType</th>
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