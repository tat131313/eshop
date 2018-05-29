<?php

    try{
        $pdo = new PDO('mysql:host=localhost; dbname=eshop; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];

        if(isset($_POST['submit'])){
            header('Location: second_page.php');
        }
        
        $sql1 = "SELECT * FROM `users` WHERE `name` LIKE '$name';";
        $result1 = $pdo->query($sql1);
        $result1->setFetchMode(PDO::FETCH_ASSOC);
        $result1 = $result1->fetchAll();
        //var_dump($result1);

        if($result1 == false){
            $sql2 = "INSERT INTO `users`(`name`) VALUES ('$name');";
            $result2 = $pdo->query($sql2);
            $result2->setFetchMode(PDO::FETCH_ASSOC);
            $result2 = $result2->fetchAll();
        }

        
        $sql3 = "SELECT `id` FROM `users` WHERE `name` LIKE '$name';";
        $id = $pdo->query($sql3);
        $id = $id->fetchAll();

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        //var_dump($_SESSION);
        //echo "<br>";
        //var_dump($_COOKIE);

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>E-shop</title>
    </head>
    <body>
        <form method="POST">
            <div align="center">
                <input name="name" placeholder="Enter your name: "></input> 
            </div>

            <div align="center">
                <input type="submit" name="submit" value="Submit"/>
            </div>
        </form>
        
    </body>
</html>
    
