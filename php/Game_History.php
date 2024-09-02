<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="db_style.css" rel="stylesheet" />
    <title>Game History</title>
</head>
    <body>
        <?php session_start(); ?>
        <h3>Game History for: <?php echo $_SESSION['username'];?></h3>
        <div class="game-history">
            <?php
            $serverName = ""; //input server name here
            $connectionOptions = [
                "Database"=>"WebGame",
                "Uid"=>"",
                "PWD"=>""
            ];
            $conn = sqlsrv_connect($serverName, $connectionOptions);
            if($conn == false)
            {
              die(print_r(sqlsrv_errors(), true));
            }
            $user = $_SESSION['username'];
            $sql = "SELECT UserID FROM GameUser WHERE Username = '$user'";
            $tmp = sqlsrv_query($conn,$sql);
            $tmp = sqlsrv_fetch_array($tmp);
            $tmp = array_reverse($tmp);
            $index = array_pop($tmp);
 
            $sql2 = "SELECT Grade, SaveDate FROM GameHistory WHERE UserID = '$index'";
            $table = sqlsrv_query($conn,$sql2);
        
            ?>
            <div class="container">
                <div class="card-header">
                    <h3>Find Word Score</h3>
                </div>
                <table class="table">
                    <tr>
                        <td> Grade </td>
                        <td> Save Date </td>
                    </tr>
                    <tr>
                        <?php
                        while($row2 = sqlsrv_fetch_array($table))
                        {
                        ?>
                            <td><?php echo $row2['Grade']; ?></td>
                            <td><?php echo $row2['SaveDate']->format('m/d/Y'); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                </table>
            </div>
            <?php  
                echo "<br><br>";
            ?>
        <div>
    </body>
</html>
