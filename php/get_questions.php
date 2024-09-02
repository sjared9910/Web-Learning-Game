<?php
$serverName = ""; //input server name here
$connectionOptions = [
    "Database"=>"WebGame",
    "Uid"=>"", 
    "PWD"=>"" 
];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

// Query to fetch questions and their correct answers
$sql = "SELECT Questions.Question, Questions.Answer FROM Questions JOIN Subjects ON Questions.SubjectID = Subjects.SubjectID";
$results = sqlsrv_query($conn, $sql);

if ($results === false) {
    die(print_r(sqlsrv_errors(), true));
}

$questions = [];
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
    // Store each question and its correct answer in an array
    $questions[] = [
        'question' => $row['Question'],
        'answer' => $row['Answer']
    ];
}


sqlsrv_close($conn);

echo json_encode($questions);
?>
