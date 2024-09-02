<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Database Backend New Question</title>
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
                <li><a href="#">New Question</a></li>
                <li><a href="db_dels.php">Delete Subject</a></li>
                <li><a href="db_delq.php">Delete Question</a></li>
                <li><a href="db_view.php">View Questions</a></li>
            </ul>
        </nav>
        <form action="functions.php" method="post">
            <h2>Create a New Question</h2>
            <input type="hidden" name="action" value="newquestion"/>
            Question: <input type="text" name="question"><br>
            Answer: <input type="text" name="answer"><br>
            Subject: <select name="subjectname">
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
    </body>
</html>