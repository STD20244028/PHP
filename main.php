<?php session_start(); ?>
<! DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メインページ</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php' ?>
<h2>ようこそ<?= $_SESSION['dname']?>さん</h2>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=gakusei;charset=utf8','gakuseki','20050602');
foreach ($pdo->query('select * from products') as $row){
?>
	<tr>
	<td><?= $row['p_id'] ?></td>
	<td><a href="detail.php?id=<?= $row['p_id']?>"><?= $row['p_name']?></a></td>
	<td><?= $row['p_price']?></td>
	</tr>
<?php
}
?>
</table>
<a href="logout.php" >ログアウト</a>
</body>
</html>
