<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="text" value="コメント">
        <input type="submit" name="submit">
    </form>
    
    
    <?php
    
    if (!empty($_POST["text"])) {
        $str = $_POST["text"];
        $filename = "mission_2-3.txt";
        $fp = fopen($filename, "a");
        fwrite($fp , $str . PHP_EOL);
        fclose($fp);
    }
    
    
    ?>
 </body> 
 </html>