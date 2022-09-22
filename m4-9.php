<?php

    //DB接続設定//
    $dsn = 'mysql:dbname=tb240303db;host=localhost';
    $user = 'tb-240303';
    $password = 'KfBE7N7V6m';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     // 【！この SQLは tbtest テーブルを削除します！】
        $sql = 'DROP TABLE boardE';
        $stmt = $pdo->query($sql);
?>