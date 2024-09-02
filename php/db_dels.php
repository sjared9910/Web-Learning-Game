<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Database Backend Home Page</title>
        <link href="../css/db_style.css" rel="stylesheet" />
    </head>
    <body>
        <header id="homepage">
            <h1>Web Game Database Backend</h1>
        </header>
        <nav>
            <ul>
                <li><a href="../db_home.html">Home</a></li>
                <li><a href="../db_news.html">New Subject</a></li>
                <li><a href="db_newq.php">New Question</a></li>
                <li><a href="#">Delete Subject</a></li>
                <li><a href="db_delq.php">Delete Question</a></li>
                <li><a href="db_view.php">View Questions</a></li>
            </ul>
        </nav>
        <h2>Delete Subject</h2>
        <form action="functions.php" method="post">
            <input type="hidden" name="action" value="delsubject"/>
            Choose which subject to delete: <select name="subjectname">
                <?php
                    $serverName = "";	//input server name here
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
                    $sql="SELECT SubjectName FROM Subjects";
                    $results = sqlsrv_query($conn,$sql);
                    
                    $row = sqlsrv_num_rows($results);
                    while($row = sqlsrv_fetch_array($results))
                    {
                        echo "<option value='". $row['SubjectName'] ."'>" .$row['SubjectName'] ."</option>";
                    }
                ?>
            </select>
            <br><br>
            <button>Send</button>
        </form>
        <br><br>
        <p>*Note: This will delete all the questions within the subject.</p>
    </body>
</html>