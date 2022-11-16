<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="result.css">
    </head>
    <body>
    <header>
      <a href="select.html">← HOME</a>
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