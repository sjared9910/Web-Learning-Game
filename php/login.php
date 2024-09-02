<?php
session_start();
$name = "";
$email = "";
$username = "";
$password = "";

$serverName = "";    //input server name here
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
        case 'signup':
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "INSERT INTO GameUser (Fullname, Email, Username, Password) VALUES ('$name', '$email','$username','$password')";
            $results = sqlsrv_query($conn,$sql);

            include 'Sign_Up_Success.html';
            break;

        case 'loginform':
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM GameUser WHERE Username = '$username' AND Password = '$password'";
            $results = sqlsrv_query($conn,$sql, array(), array("Scrollable" => 'static'));
            
            if(sqlsrv_num_rows($results) != 0)
            {
                $_SESSION['username'] = $username;
                include 'index.html';
            }
            else 
            {
                echo '<script>alert("Username or password incorrect")</script>';
                include 'Login_Page.html';
            }
            break;
    }
}
?>