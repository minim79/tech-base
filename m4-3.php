<?php
    //DB接続設定//
    $dsn = 'mysql:dbname=tb240303db;host=localhost';
    $user = 'tb-240303';
    $password = 'KfBE7N7V6m';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //DBのテーブル一覧を表示//
    $sql ='SHOW TABLES';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";
?>