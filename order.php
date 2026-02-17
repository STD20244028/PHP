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
<?php
$pdo = new PDO('mysql:host=localhost;dbname=r2a12521;charset=utf8','r2a12521','20050602');
$sql = $pdo->prepare('select * from products where p_id=?');
require 'header.php'; 
?>
<p>配送先を入力してください</p>
<form action="check.php" method="POST">
<table>
    <tr><th>氏名</th><th><input type="text" name="name" maxlength="20"></th></tr>
    <tr><th>郵便番号</th><th><input type="text" name="postcode"></th></tr>
    <tr><th>住所</th><th><input type="text" name="address" maxlength="40"></th></tr>
    <tr><th>電話番号</th><th><input type="text" name="phone"></th></tr>
    <tr><th>支払方法</th><th><input type="radio" name="pay" value="1" checked>代引き
                             <input type="radio" name="pay" value="2">振込</th></tr>
</table>
<input type="submit" value="確認へ">
<h1>カートの内容一覧</h1>
<p>カートの内容一覧です。</p>

<table border="1">
<tr><th>商品ID</th><th>商品名</th><th>価格</th><th>購入数</th><th>小計</th></tr>
<?php 
$sum = 0;
foreach ($_SESSION['cart'] as $key => $value){
	$sql->execute([$key]);
	foreach($sql as $row){
		?>
		<tr>
		<td><?= $key ?></td>
		<td><?= $row['p_name'] ?></td>
		<td><?= $row['p_price'] ?></td>
		<td><?= $value ?></td>
		<td><?= $value * $row['p_price'] ?></td>
		</tr>
		<?php $sum = $sum + $value * $row['p_price'] ?>
		<?php
	}
}
?>
<tr><td colspan="4">合計</td>
<td><?= $sum ?></td>
</table>

<br>
<a href="main.php">メインメニューに戻る</a><br>
<a href="#" onclick="history.back(); return false;">戻る</a><br>
</body>
</html>
