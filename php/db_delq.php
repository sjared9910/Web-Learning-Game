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
                <li><a href="db_dels.php">Delete Subject</a></li>
                <li><a href="#">Delete Question</a></li>
                <li><a href="db_view.php">View Questions</a></li>
            </ul>
        </nav>
        <h2>Delete Question</h2>
        <form action="functions.php" method="post">
            <input type="hidden" name="action" value="delquestion"/>
            Choose which question to delete: <select name="questionname">
                <?php
                    $serverName = "";  //input server name here
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
                    $sql="SELECT Question FROM Questions";
                    $results = sqlsrv_query($conn,$sql);
                    
                    $row = sqlsrv_num_rows($results);
                    while($row = sqlsrv_fetch_array($results))
                    {
                        echo "<option value='". $row['Question'] ."'>" .$row['Question'] ."</option>";
                    }
                ?>
            </select>
            <br><br>
            <button>Send</button>
        </form>
        <br><br>
    </body>
</html>