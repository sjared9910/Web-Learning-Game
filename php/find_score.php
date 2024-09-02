<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $serverName = "";   //input server name here
    $connectionOptions = array(
        "Database" => "WebGame",
        "Uid" => "",
        "PWD" => ""
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {

        $sql = "SELECT UserID FROM GameUser WHERE Username = ?";
        $params = array($username);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $row = sqlsrv_fetch_array($stmt);
            $userId = $row['UserID'];

            $sql = "SELECT TOP 1 Grade FROM GameHistory WHERE UserID = ? ORDER BY SaveDate DESC";
            $params = array($userId);
            $stmt = sqlsrv_query($conn, $sql, $params);

            if($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                $row = sqlsrv_fetch_array($stmt);
                $grade = $row['Grade'];

                echo $grade;
            }
        }
    }

    sqlsrv_close($conn);
} else {
    echo "No username provided.";
}
?>
