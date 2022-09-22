<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-1</title>
</head>
<body>
    
    <form action="" method="post">
        <input type="text" name="text" value="コメント">
        <input type="submit" name="submit">
    </form>
    
    <?php
    $str = $_POST["text"];
    echo $str . "を受け付けました";
    ?>
    
 </body> 
 </html>