<?php
$serverName = "";		//input server name here
$connectionOptions = array(
    "Database" => "WebGame",
    "Uid" => "",
    "PWD" => ""
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

// Retrieve subjectIds from the request parameters
$subjectIds = explode(',', $_GET['subjectIds']);

// Prepare SQL query with parameterized query to prevent SQL injection
// Assuming you want to fetch questions for multiple subjects
$sql = "SELECT Questions.Question, Questions.Answer 
        FROM Questions 
        INNER JOIN Subjects ON Questions.SubjectID = Subjects.SubjectID
        WHERE Questions.SubjectID IN (".implode(',', array_fill(0, count($subjectIds), '?')).")";
$params = $subjectIds;
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

// Execute the query with the provided subjectIds
$results = sqlsrv_query($conn, $sql, $params, $options);

$questions = array();
if ($results !== false) {
    // Fetch questions and add them to the array
    while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
        $questions[] = $row;
    }
}

// Encode questions array as JSON and echo the response
echo json_encode(array("questions" => $questions));

// Free statement and close connection
sqlsrv_free_stmt($results);
sqlsrv_close($conn);
?>
