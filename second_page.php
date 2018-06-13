<?php
     try{
        $pdo = new PDO('mysql:host=localhost; dbname=eshop; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();

        if($_SESSION['name'] == "admin"){
            $product = $_POST['product'];
            $price = $_POST['price'];
            $category = $_POST['category'];
    
            if($product != NULL && $price != NULL && $category != NULL){
                $sql1 = "INSERT INTO `goods`(`product`, `category`, `price`) VALUES ('$product', '$category', '$price');";
                $result1 = $pdo->query($sql1);
                $result1->setFetchMode(PDO::FETCH_ASSOC);
                $result1 = $result1->fetchAll();
            }
        }
        if($_SESSION['name'] != "admin"){
            $sql1 = "SELECT * FROM `goods`;";
            $result1 = $pdo->query($sql1);
            $result1->setFetchMode(PDO::FETCH_ASSOC);
            $result1 = $result1->fetchAll();

            if(isset($_POST['delete'])){
                foreach ($_COOKIE as $i => $value){
                    if($i != "PHPSESSID"){
                        setcookie($i,$value,time() + 0);
                    }
                }
            }
        }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Goods</title>
</head>
<body>
    <form method="POST">
        <?php if($_SESSION['name'] != "admin"): ?>
            <div align="center">
                <p><strong>Product</strong></p>
            
                <table border="2">
                    <tr>
                        <td>Product</td>
                        <td>Price</td>
                        <td></td>
                    </tr>

                    <?php foreach($result1 as $row): ?>
                        <tr>
                            <td><p><?php echo $row['product'] ?> </p></td>
                            <td><p><?php echo $row['price'] ?> </p></td>
                            <td><p><a href='delete.php?id=<?php echo $row['id'] ?>'> ADD</a> </p></td>
                        </tr>
                    <?php endforeach ?>

                </table>
            </div>
            <div align="center">
                <p><a href='third_page.php'>Go to shoping</a></p>
            </div>
            <div align="center">
                <input type="submit" name="delete" value="Delete shoping">
            </div>
        <?php endif ?>
            
        <?php if($_SESSION['name'] == "admin"): ?>
            <p align="center"><strong>Add product</strong></p>
            <br>

            <div align="center">
                <select name="category">
                    <option value="1">Telephone</option>
                    <option value="2">PC</option>
                </select>
            </div>
            <br>

            <div align="center">
                <input name="product" placeholder="Enter product name: "</input>
            </div>
            <br>

            <div align="center">
                <input name="price" placeholder="Enter price: "</input>
            </div>
            <br>

            <div align="center">
                <input type="submit" name="submit" value="Submit">
            </div>            
        <?php endif ?>
    </form>
</body>
</html>