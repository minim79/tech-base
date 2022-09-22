<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    
    <?php
    
    //テーマ表示//
    echo "掲示板のテーマ：犬派？猫派？";
    
    //DB接続設定//
    $dsn = 'mysql:dbname=tb240303db;host=localhost';
    $user = 'tb-240303';
    $password = 'KfBE7N7V6m';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //DB内にテーブル作成//
     $sql = "CREATE TABLE IF NOT EXISTS boardE"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "postpass TEXT,"
    . "date TEXT"
    .");";
    $stmt = $pdo->query($sql);
    
     //作成したテーブルの構成詳細を確認
    //$sql ='SHOW CREATE TABLE boardE';
    //$result = $pdo -> query($sql);
    //foreach ($result as $row){
    //    echo $row[1];
    //}
    //echo "<hr>";
    
    //1.投稿//
    //名前とコメントとパスワード、どれかが空だったら書き込まない//
    if (!empty($_POST['name']) && !empty($_POST['str']) && !empty($_POST['postpass'])){
        //編集か新規投稿か判断//
        if(empty($_POST['editnum'])){
            //投稿//
            $sql = $pdo -> 
                prepare("INSERT INTO boardE (name, comment, postpass, date) VALUES (:name, :comment, :postpass, :date)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':postpass', $postpass, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $name = ($_POST['name']);
            $comment = ($_POST['str']);
            $postpass = ($_POST['postpass']);
            $date = date('Y/m/d H:i:s');
            $sql -> execute();
        
        } else {
            
            //2.編集//
            //編集実行//
            //データを読み込んで変数に代入//
            $edit = $_POST["editnum"];
            $name = ($_POST['name']);
            $comment = ($_POST['str']);
        
            $sql = 'SELECT * FROM boardE';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            //行数分ループさせる//
            foreach ($results as $row){
                //idが一致した投稿を編集する//
                $sql = 'UPDATE boardE SET name=:name,comment=:comment WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':id', $edit, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }
    
    //編集選択//
    //編集フォームが空の時は書き込まない//
    if (!empty($_POST["edit"]) && !empty($_POST["editpass"])) {
        //データを読み込んで変数に代入//
        $edit = $_POST["edit"];
        $editpass = $_POST['editpass'];
        
        $sql = 'SELECT * FROM boardE';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        
        foreach ($results as $row){
            if ($edit == $row['id'] && $editpass == $row['postpass']) {
            $postnum_e = $row['id'];
	        $editname = $row['name'];
	        $editcomment = $row['comment'];
            } 
        }
    }
    
    //3.削除//
    if (!empty($_POST['delete']) && !empty($_POST["deletepass"])){
        //データを読み込んで変数に代入//
        $delete = $_POST['delete'];
        $deletepass = $_POST["deletepass"];
        
        $sql = 'SELECT * FROM boardE';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        
        foreach ($results as $row){
            if($deletepass == $row['postpass']){
            $sql = 'delete from boardE where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $delete, PDO::PARAM_INT);
            $stmt->execute();
            }
        }
    }
    
    ?>
    
     <!--投稿フォームの作成-->
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" 
                value="<?php if(!empty($editname)) {echo $editname;} ?>"><br>
        <input type="text" name="str" placeholder="コメント"
                value="<?php if(!empty($editcomment)) {echo $editcomment;} ?>"><br>
        <input type="hidden" name="editnum"
                value="<?php if(!empty($postnum_e)) {echo $postnum_e;} ?>">
        <input type="text" name="postpass" placeholder = "パスワード">
        <input type="submit" name="submit">
    </form>
    
    <!--削除フォームの作成-->
    <form action="" method="post">
        <br>
        <input type="num" name="delete" placeholder="削除対象番号"><br>
        <input type="text" name="deletepass" placeholder = "パスワード">
        <input type="submit" name="submit" value="削除">
    </form>
    
    <!--編集フォームの作成-->
    <form action="" method="post">
        <br>
        <input type="num" name="edit" placeholder="編集対象番号"><br>
        <input type="text" name="editpass" placeholder = "パスワード">
        <input type="submit" name="submit" value="編集">
    </form>

<?php
    //抽出して表示//
    $sql = 'SELECT * FROM boardE';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    foreach ($results as $row){
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['date'].'<br>';
        echo "<hr>";
    }
?>
    
</body>