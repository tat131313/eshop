<?php
    session_start();
    if(isset($_POST['submit'])){
        foreach ($_COOKIE as $i => $value){
            if($i != "PHPSESSID"){
                setcookie($i,$value,time() + 0);
            }
        }
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fourth page</title>
</head>
<body>
    <form method="POST">
        <div align="center">
            <p><strong>Thank you for order(s)!</strong></p>
        </div>

        <div align="center">
            <a href="second_page.php">Return on e-shop</a>
        </div>

        <div align="center">
            <br>
            <input type="submit" name="submit" value="Return on main page"/>
        </div>
    </form>
</body>
</html>