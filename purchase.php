<?php session_start(); ?>
<! DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>注文手続き</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php' ?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=gakusei;charset=utf8','gakuseki','20050602');
$sql1 = $pdo -> prepare("INSERT INTO orders values(null,?,?,?,?,?,?,0)");
$sql1 -> execute([$_SESSION['id'],$_POST['postcode'],$_POST['address'],$_POST['name'],$_POST['phone'],$_POST['pay']]);
$oid = $pdo ->lastInsertId('o_id');
?>
<br>
購入が完了しました。<br>
注文番号：<?= $oid ?><br>
<?php
$sql2 = $pdo -> prepare("INSERT INTO details values(?,?,?,0)");
foreach ($_SESSION['cart'] as $key => $value){
    $sql2 -> execute([$oid,$key,$value]);
}
unset($_SESSION['cart']);
?><br>
<a href="main.php">メインへ戻る</a>
</body>
</html>
