<?php
$serverName = "";   //input server name here
$connectionOptions = array(
    "Database" => "WebGame",
    "Uid" => "",
    "PWD" => ""
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT SubjectID, SubjectName FROM Subjects";
$results = sqlsrv_query($conn, $sql);

$subjects = array();
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
    $subjects[] = $row;
}

echo json_encode(array("subjects" => $subjects));

sqlsrv_free_stmt($results);
sqlsrv_close($conn);
?>
