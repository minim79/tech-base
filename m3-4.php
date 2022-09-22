<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4</title>
</head>
<body>
    
    <?php
    
    //1.投稿フォーム//
    //投稿//
    //名前とコメントどちらかが空だったら書き込まない//
    if (!empty($_POST['name']) && !empty($_POST['str'])){
        //データと日付を取得して変数に代入する//
	    $name = ($_POST['name']);
	    $str = ($_POST['str']);
        $date = date('Y/m/d H:i:s');
        //ファイル作成//
        $filename = "mission_3-4.txt";
        
        //編集か新規投稿歌判断//
        if (empty($_POST['editnum'])){
        
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
    }
    
    //2.編集フォーム//
    //編集選択(1~6)//
    //編集フォームが空の時は書き込まない//
    if (!empty($_POST["edit"])) {
        //データを読み込んで変数に代入//
        $edit = $_POST["edit"];
        //ファイル作成//
        $filename = "mission_3-4.txt";
        //配列変数に代入//
        $editCon = file($filename,FILE_IGNORE_NEW_LINES);
        //行数分ループさせる//
        foreach ($editCon as $line) {
          //区切り文字「<>」で分割する//
            $editdata = explode("<>", $line);
          //投稿番号と削除対象番号を比較し、等しい場合はその投稿の「名前」と「コメント」を取得//
            if ($edit == $editdata[0]) {
                $postnum_e = $editdata[0];
	            $editname = $editdata[1];
	            $editstr = $editdata[2];
            }
        }
    }
    //編集実行(7~8)//
    if(!empty($_POST['editnum'])){
         //データを読み込んで変数に代入//
        $editnum = $_POST['editnum'];
        //ファイル作成//
        $filename = "mission_3-4.txt";
         //配列変数に代入//
        $editcon = file($filename,FILE_IGNORE_NEW_LINES);
        //ファイルを一度空にして開く//
        $fp = fopen($filename,"w");
        //行数分ループさせる//
        foreach ($editcon as $line){
          //区切り文字「<>」で分割する//
            $data = explode("<>", $line);
          //投稿番号と編集対象番号を比較し、等しい場合はファイルに追記、等しくない場合はそのまま書き込む//
            if ($data[0] == $editnum) {
                fwrite($fp, $editnum . "<>" . $name . "<>" . $str . "<>" . $date . PHP_EOL);
            } else {
                fwrite($fp , $line . PHP_EOL);
            }
        }
        //ファイルを閉じる//
        fclose($fp);
    }
    
    //表示させる//
    $filename = "mission3-4.txt";
    if(file_exists($filename)){
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            $item = explode("<>", $line);
            echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . "<br>";
            
        }
    }
    
    //3.削除フォーム//
    //削除フォームが空の時は書き込まない//
    if (!empty($_POST["delete"])) {
        //データを読み込んで変数に代入//
        $delete = $_POST["delete"];
        //ファイル作成//
        $filename = "mission_3-4.txt";
        //配列変数に代入//
        $deleteCon = file($filename,FILE_IGNORE_NEW_LINES);
        //ファイルを一度空にして開く//
        $fp = fopen($filename,"w");
        //行数分ループさせる//
        for ($i = 0; $i < count($deleteCon) ; $i++){ 
          //区切り文字「<>」で分割する//
            $line = explode("<>", $deleteCon[$i]);
            $postnum = $line[0];
          //投稿番号と削除対象番号を比較し、等しくない場合はファイルに追記する//
            if ($postnum != $delete) {
                fwrite($fp , $deleteCon[$i] . PHP_EOL);
            }
        }
        //ファイルを閉じる//
        fclose($fp);
    }
    
    

    ?>

    <!--投稿フォームの作成-->
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" 
                value="<?php if(!empty($editname)) {echo $editname;} ?>"><br>
        <input type="text" name="str" placeholder="コメント"
                value="<?php if(!empty($editstr)) {echo $editstr;} ?>">
        <input type="hidden" name="editnum"
                value="<?php if(!empty($postnum_e)) {echo $postnum_e;} ?>">
        <input type="submit" name="submit">
    </form>
    
    <!--削除フォームの作成-->
    <form action="" method="post">
        <br>
        <input type="num" name="delete" placeholder="削除対象番号">
        <input type="submit" name="submit" value="削除">
    </form>
    
    <!--編集フォームの作成-->
    <form action="" method="post">
        <br>
        <input type="num" name="edit" placeholder="編集対象番号">
        <input type="submit" name="submit" value="編集">
    </form>
    
   <?php
   
    //表示させる//
    $filename = "mission3-4.txt";
    if(file_exists($filename)){
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            $item = explode("<>", $line);
            echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . "<br>";
        }
    }
                
    ?>
    
</body> 
</html>