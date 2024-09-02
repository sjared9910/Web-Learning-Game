<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Database Backend View Questions</title>
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
                <li><a href="db_delq.php">Delete Question</a></li>
                <li><a href="#">View Questions</a></li>
            </ul>
        </nav>
        <h2>View Questions Within a Subject</h2>
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
            $sql="SELECT SubjectName FROM Subjects";
            $results = sqlsrv_query($conn,$sql);
                    
            $row = sqlsrv_num_rows($results);
            while($row = sqlsrv_fetch_array($results))
            {
    
                $location = $row['SubjectName'];
                $find = "SELECT SubjectID FROM Subjects WHERE SubjectName='$location'";
                $tmp = sqlsrv_query($conn,$find);
                $tmp = sqlsrv_fetch_array($tmp);
                $tmp = array_reverse($tmp);
                $index = array_pop($tmp);

                $temp = "SELECT Question, Answer FROM Questions WHERE SubjectID='$index'";
                $table = sqlsrv_query($conn,$temp);
                
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card-header">
                                <h3>Subject: <?php echo $row['SubjectName']; ?></h3>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td> Questions </td>
                                        <td> Answers </td>
                                    </tr>
                                    <tr>
                                    <?php
                                    while($row2 = sqlsrv_fetch_array($table))
                                    {
                                    ?>
                                        <td><?php echo $row2['Question']; ?></td>
                                        <td><?php echo $row2['Answer']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            
                echo "<br><br>";
            }
        ?>
    </body>
</html>