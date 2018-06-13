<?php
ob_start();
$id = $_GET['id'];
if(isset($_COOKIE[$id])){
    $q=$_COOKIE[$id] + 1;
    setcookie($id, $q);
}
else{
    $q=1;
    setcookie($id, $q);
}
var_dump($_COOKIE[$id]);
header("Location: second_page.php");
?>
<!DOCTYPE html>
<html>
</html>