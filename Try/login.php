<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturifiko</title>
    <style>
        *{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #608BC1;
        }

        form{
            background: #133E87;
            width: 350px;
            height: 580px;
            padding: 75px 50px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            text-align: center;
            margin-bottom: 45px;
            color: white;
            font-size: 40px;
        }

        .textbox {
            border-bottom: 2px solid white;
            position: relative;
            margin: 35px 0;
        }

        .textbox input{
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: white;
            height: 30px;
            font-size: 20px;
        }

        .loginbtn{
            height: 45px;
            width: 100%;
            border: none;
            outline: none;
            background: #608BC1;
            background-size: 200%;
            color: white;
            font-size: 16px;
        }

        .loginbtn:hover {
            background-position: right;
            font-size: 17px;
        }

        .signup {
            color: white;
            margin-top: 45px;
            text-align: center;
        }

        .signup a{
            color: black;

        }
    </style>
</head>
<body>
    <form method="post" action="login.php">
        <h1>Login</h1>
        <div class="textbox">
            <input type="text" placeholder="Username" name="username">
        </div>
        <div class="textbox">
            <input type="text" placeholder="Password" name="password">
        </div>
        <input type="submit" value="Login" class="loginbtn" name="login_Btn">
        <div class="signup">
            Don't have an account?
            </br>
            <a href="#">Sign up</a>
        </div>
    </form>
</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "");
if(isset($_POST['login_Btn'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql= "SELECT login.logindetails WHERE username = '$username";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $resultPassword = $row["password"];
        if($password == $resultPassword){
            header ('Location:index,html');
        }else{
            echo "<script>
                alert('Login unsuccessful');
            </script>";
        }
    }
}
?>
