<?php session_start(); ?>
<! DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カート</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php';
$pdo = new PDO('mysql:host=localhost;dbname=gakusei;charset=utf8','gakuseki','20050602');
$sql = $pdo->prepare('select * from products where p_id=?');
$sum = 0;

if($_SESSION['cart'][$_POST['pid']] == null){
    $_SESSION['cart'][$_POST['pid']] = $_POST['count'];
}else{
	foreach ($_SESSION['cart'] as $key => $value){
		$sql->execute([$key]);
		if($_SESSION['cart'][$key] != $_POST['cnt'] && $_POST['rid'] == key){
		    $_SESSION['cart'][$key] = $_POST['cnt'];
		}else{
		    $_SESSION['cart'][$key] += $_POST['count'];
		}
	}
}
?>
<h1>カートの内容一覧</h1>
<p>カートの内容一覧です。</p>
<p>購入数を変更する場合は値を変更してください。</a>
<table border="1">
<tr><th>商品ID</th><th>商品名</th><th>価格</th><th>購入数</th><th>小計</th></tr>
<form action="cart.php" method="post">
<?php
foreach ($_SESSION['cart'] as $key => $value){
	$sql->execute([$key]);
	foreach($sql as $row){
		?>
		<tr>
		<td><?= $key ?></td>
		<td><?= $row['p_name'] ?></td>
		<td><?= $row['p_price'] ?></td>
		<td><input type="text" name ="cnt" value=<?= $value ?>>
		    <input type="hidden" name="rid" value=<?=$key?>>
		</td><td><?= $value * $row['p_price'] ?></td>
		</tr>
		<?php $sum = $sum + $value * $row['p_price']; ?>
		<?php
	}
}
?>
<tr><td colspan="4">合計</td>
<td><?= $sum ?></td>
</table>
<input type="submit" value="更新">
</form>
<br>
<a href="main.php">メインメニューに戻る</a><br>
<a href="order.php">購入手続き</a><br>
<a href="#" onclick="history.back(); return false;">戻る</a><br>
</body>
</html>

