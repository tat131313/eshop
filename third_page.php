<?php
//var_dump($_COOKIE);

foreach ($_COOKIE as $i => $value){
    if($i != "PHPSESSID"){
        var_dump($i);
        echo "<br>";
        var_dump($value);
        echo "<br>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Third page</title>
</head>
<body>
</body>
</html>