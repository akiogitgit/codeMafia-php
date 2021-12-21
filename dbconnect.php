<?php
function dbconnect()
{
    try {
        $user = 'test_user';
        $pwd = 'pwd';
        $host = 'localhost';
        $dbName = 'pollapp';
        $dsn = "mysql:host={$host};port=8889;dbname={$dbName};";
        $db = new PDO($dsn, $user, $pwd);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        print('DB接続エラー:' . $e->getMessage());
    }
    if (!$db) {
        die($db->error);
    }
    return $db;
}
