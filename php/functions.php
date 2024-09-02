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
if (isset($_POST['action']))
{
    switch($_POST['action'])
    {
        case 'newsubject':
            $Name = $_POST['subject'];
            $sql = "INSERT INTO Subjects (SubjectName) VALUES ('$Name')";
            $results = sqlsrv_query($conn,$sql);
            if($results)
                echo '<script>alert("Subject successfully entered")</script>';
            else echo '<script>alert("Error")</script>';
            include 'db_news.html';
            break;
        case 'newquestion':
            $question = $_POST['question'];
            $answer = $_POST['answer'];
            $subject = $_POST['subjectname'];

            $find = "SELECT SubjectID FROM Subjects WHERE SubjectName='$subject'";
            $tmp = sqlsrv_query($conn,$find);
            $tmp = sqlsrv_fetch_array($tmp);
            $tmp = array_reverse($tmp);
            $index = array_pop($tmp);

            $sql = "INSERT INTO Questions (SubjectID, Question, Answer) VALUES ('$index', '$question', '$answer')";
            $results = sqlsrv_query($conn,$sql);

            if($results)
                echo '<script>alert("Subject successfully entered")</script>';
            else echo '<script>alert("Error")</script>';
            include 'db_newq.php';
            break;
        case 'delsubject':
            $Name = $_POST['subjectname'];
            $sql = "SELECT SubjectID FROM Subjects WHERE SubjectName='$Name'";
            $tmp = sqlsrv_query($conn,$sql);
            $tmp = sqlsrv_fetch_array($tmp);
            $tmp = array_reverse($tmp);
            $index = array_pop($tmp);

            $sql = "DELETE FROM Questions WHERE SubjectID='$index'";
            $del1 = sqlsrv_query($conn,$sql);
            $sql = "DELETE FROM Subjects WHERE SubjectID='$index'";
            $del2 = sqlsrv_query($conn,$sql);

            if($del1 AND $del2)
                echo '<script>alert("Subject successfully deleted")</script>';
            else echo '<script>alert("Error")</script>';
            include 'db_dels.php';
            break;
        case 'delquestion':
            $Name = $_POST['questionname'];
            $sql = "DELETE FROM Questions WHERE Question='$Name'";
            $results = sqlsrv_query($conn,$sql);
            if($results)
                echo '<script>alert("Subject successfully deleted")</script>';
            else echo '<script>alert("Error")</script>';
            include 'db_delq.php';
            break;
        case 'other':
            echo '<script>alert("Other Error")</script>';
            break;
    }
}
?>
