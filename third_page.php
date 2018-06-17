<?php
    session_start();
    try{
        $pdo = new PDO('mysql:host=localhost; dbname=eshop; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $quantity = array();
        $allOrders = array();
        $j = 0; 
        foreach ($_COOKIE as $i => $value){
            if($i != "PHPSESSID"){
                $sql1 = "SELECT * FROM `goods` WHERE `id`='$i';";
                $result1 = $pdo->query($sql1);
                $result1->setFetchMode(PDO::FETCH_ASSOC);
                $result1 = $result1->fetchAll();

                $allOrders[] = $result1;
                $quantity[] = $value;
            }
        }

        //var_dump($_COOKIE);
        if(isset($_POST['buy'])){

            //var_dump($_SESSION);
            $user_id = $_SESSION['id'][0]['id'];
            $phone_number = $_POST['phone_number'];
            $comment = $_POST['comment'];

            $sql2 = "INSERT INTO `orders`(`user_id`, `phone_number`, `comment`) VALUES ('$user_id', '$phone_number', '$comment')";
            $result2 = $pdo->query($sql2);

            $sql3 = "SELECT `id` FROM `orders` WHERE `user_id`=$user_id ORDER BY `id` DESC";
            $result3 = $pdo->query($sql3);
            $result3->setFetchMode(PDO::FETCH_ASSOC);
            $result3 = $result3->fetch();

            $order_id = $result3['id'];

            foreach($_COOKIE as $i => $value){
                if($i != "PHPSESSID"){
                    $sql5 = "INSERT INTO `orders_in_detail` (`order_id`, `goods_id`, `quantity`) VALUES ('$order_id', $i, '$value')";
                    $result5 = $pdo->query($sql5);
                }
            }

            header("Location: fourth_page.php");
        }  
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Third page</title>
</head>
<body>
    <form method="POST">
        <div align="center">
            <p><strong>Your order(s)</strong></p>
        </div>
        <div align="center">
            <table border="2">
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                </tr>

                <?php foreach($allOrders as $row): ?>
                    <tr>
                        <td><?php echo $row[0]['product']; ?></td>
                        <td><?php echo $row[0]['price']; ?></td>
                        <td><?php 
                            echo $quantity[$j];
                            $sum += $row[0]['price']*$quantity[$j]; 
                            $j++;
                            ?></td>
                    </tr>
                <?php endforeach ?>
                <td colspan="3" align="center">
                    <strong><?php echo $sum ?></strong>
                </td>
            </table>
        </div>
        <div align="center">
            <br>
            <input name="phone_number" placeholder="Enter your phone number"></input>
        </div>
        <div align="center">
            <br>
            <input name="comment" placeholder="Enter your comment"></input>
        </div>
        <div align="center">
            <br>
            <input type="submit" name="buy" value="BUY!"/>
        </div>

    </form>
</body>
</html>