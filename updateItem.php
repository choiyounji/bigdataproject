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
        <a href="update.html">
        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="30px" height="30px" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M112 160l-64 64 64 64"/>
            <path d="M64 224h294c58.76 0 106 49.33 106 108v20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
        </svg>
            BACK
        </a>
    </header>
        <div class="title">Result of Update Item </div>

        
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
                    $sql = "SELECT * FROM itemInfo WHERE iIdentifier='".$_POST['iIdentifier']."';";
$ret = mysqli_query($mysqli, $sql);
$exist = mysqli_num_rows($ret);
if($exist<=0){
   echo "<tr><td></td><td> The iIdentifier you entered does not exist. </td></tr>";
  exit(0);
}else{
    while($newArray=mysqli_fetch_array($ret, MYSQLI_ASSOC)){
        $iIdentifier=$newArray['iIdentifier'];
        $iWeight=$newArray['iWeight'];
        $iFatContent=$newArray['iFatContent'];
        $iType=$newArray['iType'];
        echo "<tr><td>".$iIdentifier."</td><td>".$iWeight."</td> <td>".$iFatContent."</td> <td>".$iType."</td></tr>
        <tr><td>.</td><td>.</td><td>.</td><td>.</td></tr></table></br> ";
    }
    echo "<div class='show'> Before</div>
    <table>
        <th>iIdentifier</th>
        <th>iWeight</th>
        <th>iFatContent</th>
        <th>iType</th>";
                    $sql = "UPDATE itemInfo SET iWeight='".$_POST["iWeight"]."',iFatContent='".$_POST["iFatContent"]."',iType ='".$_POST["iType"]."' WHERE iIdentifier='".$_POST["iIdentifier"]."';";
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
                     
                                echo "<tr><td>".$iIdentifier."</td><td>".$iWeight."</td> <td>".$iFatContent."</td> <td>".$iType."</td></tr>";
                            }
                           }
                            else{
                                printf("Could not retrieve records : %s\n", mysqli_error($mysqli));
                            }
                        
                    }
                    else{
                        printf("Could not update record : %s\n", mysqli_error($mysqli));
                    }
                    mysqli_free_result($ret);
                    mysqli_free_result($res);
                    mysqli_close($mysqli);
                
}}
            ?>
        </table></br></br>
        <div class="show">After</div>

 
    </body>
</html>