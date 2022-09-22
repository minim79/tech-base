<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
    
     <form action="" method="post">
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    
    <?php
    if (!empty($_POST['name']) && !empty($_POST['str'])){
    
	    $name = ($_POST['name']);
	    $str = ($_POST['str']);
        $date = date('Y/m/d H:i:s');
        $filename = "mission_3-2.txt";

        if (file_exists($filename)) {
            $num = count(file($filename))+1;
            } else {
            $num = 1;
        }
	    $comment = $num."<>".$name."<>".$str."<>".$date;

	    $fp = fopen($filename,"a"); 
	    fwrite($fp, $comment.PHP_EOL); 
	    fclose($fp);
	    
	    
	     if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                $items = explode("<>", $line);
                foreach($items as $item) {
                    echo $item ."<br>";
                    }
                }
	     }
        
    }
?>

</body> 
</html>