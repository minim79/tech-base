<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-4</title>
</head>
<body>
    
    <form action="" method="post">
        <input type="text" name="text" value="おめでとう！by（メンバー名）">
        <input type="submit" name="submit">
    </form>
    
   
    <?php
    
    if (!empty($_POST["text"])) {
        $str = $_POST["text"];
        $filename = "mission_2-4.txt";
        $fp = fopen($filename, "a");
        fwrite($fp , $str . PHP_EOL);
        fclose($fp);
    }
        $filename = "mission_2-4.txt";
        if (file_exists($filename)) {
            $lines = file($filename);
            foreach ($lines as $line){
            echo $line . "<br>";
            }
        }
    ?>
    
 </body> 
 </html>