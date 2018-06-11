<?php
ob_start();
var_dump($_GET);
$id = $_GET['id'];
//die;
//посмтотреть ид = если есть +1 = если нету добавить = добавить в куки
setcookie('id1', $id - количество);
//header location second_page
?>
<!DOCTYPE html>
<html>
</html>