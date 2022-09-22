<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前"><br>
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    
    <form action="" method="post">
        <br>
        <input type="num" name="delete" placeholder="削除対象番号">
        <input type="submit" name="submit" value="削除">
    </form>
    
    <?php
    
    //1.削除フォーム//
    //削除フォームが空の時は書き込まない//
    if (!empty($_POST['delete'])) {
        //データを読み込んで変数に代入//
        $delete = $_POST['delete'];
        //ファイル作成//
        $filename = "mission_3-3.txt";
        //配列変数に代入//
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        //ファイルを一度空にして開く//
        $fp = fopen($filename,"w");
        //行数分ループさせる//
        for ($i = 0; $i < count($lines) ; $i++){ 
          //区切り文字「<>」で分割する//
            $line = explode("<>", $lines[$i]);
            $postnum = $line[0];
          //投稿番号と削除対象番号を比較し、等しくない場合はファイルに追記する//
            if ($postnum != $delete) {
                fwrite($fp, $lines[$i].PHP_EOL);
            }
        }
        //ファイルを閉じる//
        fclose($fp);
    }
    
    //2.投稿フォーム//
    //名前とコメントどちらかが空だったら書き込まない//
    if (!empty($_POST['name']) && !empty($_POST['str'])){
        //データと日付を取得して変数に代入する//
	    $name = ($_POST['name']);
	    $str = ($_POST['str']);
        $date = date('Y/m/d H:i:s');
        //ファイル作成//
        $filename = "mission_3-3.txt";
        
        //投稿番号の作成//
        if (file_exists($filename)) {
            $num = count(file($filename))+1;
            } else {
            $num = 1;
        }
        //変数を結合して一つの変数にする//
	    $comment = $num."<>".$name."<>".$str."<>".$date;
        //ファイルを開いて追記し、閉じる//
	    $fp = fopen($filename,"a"); 
	    fwrite($fp, $comment.PHP_EOL); 
	    fclose($fp);
	    
	    //配列変数に代入し、<>で区切ってさらに配列変数に代入して表示する//
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